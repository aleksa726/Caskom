<?php
namespace App\Libraries;

/* Sava Gavrić 0359/18 */

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use App\Models\KorisnikModel;
use App\Models\ModeratorModel;
use App\Models\RazgovorModel;
use App\Models\PorukaModel;
use App\Models\OpsluzioModel;

/**
 * Chat - implementacija interfejsa za otvaranje i zatvaranje konekcije
 * i prijem i slanje poruka.
 * 
 * @version 1.0
 */
class Chat implements MessageComponentInterface {    
    /**
     * @var mixed[] $clients - niz trenutno aktivnih klijenata servera 
     */
    protected $clients;

    /**
     * @var int MOD_TYPE - kod moderatora
     */
    private const MOD_TYPE = 0;
    /**
     * @var int MOD_TYPE - kod korisnika
     */
    private const USER_TYPE = 1;
    
    /**
     * __construct
     * Konstruktorski metod klase.
     * @return void
     */
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }
    
    /**
     * onOpen
     * Poziva se prilikom otvaranja nove konekcije sa klijentom i
     * inicijalizuje objekat klijenta podacima o odgovarajućem
     * korisniku/modratoru iz baze.
     * @param  mixed $conn - konekcija koja se otvara
     * @return void
     */
    public function onOpen(ConnectionInterface $conn) {
        $uriQuery = $conn->httpRequest->getUri()->getQuery();
        $param0 = explode('&', $uriQuery)[0];
        $param0 = explode('=', $param0)[1];
        $param1 = explode('&', $uriQuery)[1];
        $param1 = explode('=', $param1)[1];

        if ($param1 == self::USER_TYPE) {
            $korisnikModel = new KorisnikModel();
            $korisnik = $korisnikModel->find($param0);
            $conn->user = $korisnik;

            $this->clients->attach($conn);
        }
        else if ($param1 == self::MOD_TYPE) {
            $moderatorModel = new ModeratorModel();
            $moderator = $moderatorModel->find($param0);
            $conn->user = $moderator;

            $this->clients->attach($conn);
        }

        echo "New connection! ({$conn->resourceId})\n";
    }
    
    /**
     * onMessage
     * Poziva se prilikom pristizanja poruke poslate od strane 
     * nekog od klijenata i obavlja beleženje potrebnih podataka
     * u bazu i prosleđivanja poruke onome kome je upućena.
     * @param  mixed $from - konekcija sa koje stiže poruka
     * @param  string $msg - sadržaj poruke
     * @return void
     */
    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $package = json_decode($msg);
        $idKli = $package[0];
        $clientType = $package[1];
        $message = $package[2];
        $trgtIdRa = $package[3];

        $razgovorModel = new RazgovorModel();
        $porukaModel = new PorukaModel();
        if ($clientType == self::USER_TYPE) {
            if ($razgovorModel->dohvatiRazgovorKorisnika($idKli) == null) {
                $razgovorModel->napraviRazgovorKorisnika($idKli);
            }
            $idRa = $razgovorModel->dohvatiIdRazgovoraKorisnika($idKli);
            $porukaModel->dodajPoruku($idRa, $idKli, $clientType, $message); 
            foreach ($this->clients as $client) { 
                if (isset($client->user->idM) && $razgovorModel->imajuRazgovor($from->user->idK, $client->user->idM, $idRa)) {
                    $data = [
                        'method' => "MSG",
                        'idRa' => $idRa,
                        'message' => $message
                    ];
                    $client->send(json_encode($data));
                    break;
                }
            }
        }
        else if ($clientType == self::MOD_TYPE) {
            if ($message == "GET") {
                if ($trgtIdRa == null) {
                    $idKPreuzet = $razgovorModel->preuzmiRazgovor($from->user->idM);
                    if ($idKPreuzet != null) {
                        $idRa = $razgovorModel->dohvatiIdRazgovora($idKPreuzet, $from->user->idM);
                        $poruke = $porukaModel->dohvatiPorukeAutora($idRa, $idKPreuzet, true);
                        $messages = array();
                        foreach ($poruke as $poruka) {
                            array_push($messages, ['tip_autora' => $poruka->tip_autora, 'message' => $poruka->tekst]);
                        }
                        $data = [
                            'method' => "GET",
                            'idRa' => $idRa,
                            'messages' => $messages
                        ];
                        $from->send(json_encode($data));
                    }
                }
                else {
                    $poruke = $porukaModel->dohvatiPorukeRazgovora($trgtIdRa);
                    $messages = array();
                    foreach ($poruke as $poruka) {
                        array_push($messages, ['tip_autora' => $poruka->tip_autora, 'message' => $poruka->tekst]);
                    }
                    $data = [
                        'method' => "GET",
                        'idRa' => $trgtIdRa,
                        'messages' => $messages
                    ];
                    $from->send(json_encode($data));
                }
                
            }
            else if ($message == "END") {
                $porukaModel->obrisiPorukeRazgovora($trgtIdRa);
                $opsluzioModel = new OpsluzioModel();
                $opsluzioModel->zabeleziOpsluzivanje($from->user->idM);
                foreach ($this->clients as $client) {
                    if (isset($client->user->idK) && $razgovorModel->imajuRazgovor($client->user->idK, $from->user->idM, $trgtIdRa)) {
                        $data = [
                            'method' => "END"
                        ];
                        $client->send(json_encode($data));
                        break;
                    }
                }
                $razgovorModel->obrisiRazgovor($trgtIdRa);
            }
            else {
                $porukaModel->dodajPoruku($trgtIdRa, $idKli, $clientType, $message);
                foreach ($this->clients as $client) {
                    if (isset($client->user->idK) && $razgovorModel->imajuRazgovor($client->user->idK, $from->user->idM, $trgtIdRa)) {
                        $data = [
                            'method' => "MSG",
                            'message' => $message
                        ];
                        $client->send(json_encode($data));
                        break;
                    }
                } 
            }
        }

    }
    
    /**
     * onClose
     * Poziva se prilikom zatvaranja konekcije i uklanja
     * objekat klijenta iz niza clients.
     * @param  mixed $conn - konekcija koja se zatvara
     * @return void
     */
    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }
    
    /**
     * onError
     * Poziva se prilikom nastanka greške na konekciji i zatvara je.
     * @param  mixed $conn - konekcija na kojoj je nastala greška
     * @param  exception $e - izuzetak
     * @return void
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

}
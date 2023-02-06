<?php namespace App\Controllers;

/* Sava Gavrić 0359/18 */

use App\Models\ModeratorModel;
use App\Models\UplatnicaModel;
use App\Models\KorisnikModel;
use App\Models\RecenzijaModel;
use App\Models\GlasanjeModel;
use App\Models\GlasaoModel;
use App\Models\OglasModel;
use App\Models\RazgovorModel;
use App\Models\PorukaModel;

use CodeIgniter\I18n\Time;

/**
 * Moderator - klasa za obradu i prikaz moderatorovih podataka.
 * 
 * @version 1.0
 */
class Moderator extends BaseController {
    /**
     * @var int PRETPLATA - kod pretplate
     */
    public const PRETPLATA = 1;
    /**
     * @var int PODIZANJE - kod podizanja
     */
    public const PODIZANJE = 2;
        
    /**
     * index
     * Prikazuje početnu stranicu.
     * @return void
     */
    public function index() {
        return view('stranice/moderator/index');
    }
 
    /**
     * provera_pretplate
     * Prikazuje View provera i prosleđuje mu podatke o datoj uplatnici pretplate.
     * @return void
     */
    public function provera_pretplate() {
        $uplatnicaModel = new UplatnicaModel();
        $uplatnica = $uplatnicaModel->dohvatiUplatnicuZaProveru(self::PRETPLATA);
        $korisnikModel = new KorisnikModel(); 
        $korisnik = null;
        if (isset($uplatnica)) $korisnik = $korisnikModel->dohvatiKorisnika($uplatnica->idK);
        return view('stranice/moderator/provera', ['tip' => self::PRETPLATA, 'uplatnica'=>$uplatnica, 'korisnik' => $korisnik]);
    }

    /**
     * provera_podizanja
     * Prikazuje View provera i prosleđuje mu podatke o datoj uplatnici podizanja.
     * @return void
     */
    public function provera_podizanja() {
        $uplatnicaModel = new UplatnicaModel();
        $uplatnica = $uplatnicaModel->dohvatiUplatnicuZaProveru(self::PODIZANJE);
        $korisnikModel = new KorisnikModel(); 
        $korisnik = null;
        if (isset($uplatnica)) $korisnik = $korisnikModel->dohvatiKorisnika($uplatnica->idK);
        return view('stranice/moderator/provera', ['tip' => self::PODIZANJE, 'uplatnica' => $uplatnica, 'korisnik' => $korisnik]);
    }
    
    /**
     * provera_odluka
     * Prima od moderatora odluku odobravanja date uplatnice i
     * šalje mu sledeću uplatnicu za proveru ukoliko je ima.
     * @return void
     */
    public function provera_odluka() {
        $idU = isset($_POST['idU'])? $_POST['idU'] : null;
        $tip = isset($_POST['tip'])? $_POST['tip'] : null;
        $odluka = isset($_POST['odluka'])? $_POST['odluka'] : null;

        if ($odluka == "true") $odluka = true;
        else if ($odluka == "false") $odluka = false;

        $idM = $this->session->get('moderator')->idM;

        $uplatnicaModel = new UplatnicaModel();
        $uplatnicaModel->azurirajUplatnicuProvera($idU, $idM, $odluka);
        if ($tip == self::PRETPLATA) {
            $korisnikModel = new KorisnikModel();
            $idK = $uplatnicaModel->dohvatiKorisnika($idU);
            $korisnikModel->azurirajKorisnikaProvera($idK, $odluka, $idM);
        }
        else if ($tip == self::PODIZANJE) {
            $oglasModel = new OglasModel();
            $idO = $uplatnicaModel->dohvatiOglas($idU);
            $oglasModel->azurirajOglasProvera($idO, $odluka, $idM); 
        }

        $uplatnica = $uplatnicaModel->dohvatiUplatnicuZaProveru($tip);
        if (!isset($uplatnica)) {
            echo json_encode(null);
            return;
        }

        $korisnikModel = new KorisnikModel(); 
        $korisnik = $korisnikModel->dohvatiKorisnika($uplatnica->idK);

        $uplatnica = json_decode(json_encode($uplatnica), true); 
        $uplatnica = array_merge($uplatnica, ['idK' => $korisnik->idK]);
        $uplatnica = array_merge($uplatnica, ['korisnicko_ime' => $korisnik->korisnicko_ime]);
        $uplatnica = array_merge($uplatnica, ['ime' => $korisnik->ime]);

        echo json_encode($uplatnica);
    }        
        
    /**
     * autorizacija
     * Prikazuje View autorizacija i prosleđuje mu podatke o datoj kompaniji.
     * @return void
     */
    public function autorizacija() {
        $korisnikModel = new KorisnikModel();
        $kompanija = $korisnikModel->dohvatiKompanijuZaAutorizaciju();
        return view('stranice/moderator/autorizacija', ['kompanija' => $kompanija]);
    }
    
    /**
     * autorizacija_odluka
     * Prima od moderatora odluku o autorizaciji date kompanije i
     * šalje mu sledeću kompaniju za proveru ukoliko je ima.
     * @return void
     */
    public function autorizacija_odluka() {
        $idK = isset($_POST['idK'])? $_POST['idK'] : null;
        $odluka = isset($_POST['odluka'])? $_POST['odluka'] : null;

        if ($odluka == "true") $odluka = true;
        else if ($odluka == "false") $odluka = false;

        $korisnikModel = new KorisnikModel();
        $korisnikModel->azurirajKorisnikaAutorizacija($idK, $odluka, $this->session->get('moderator')->idM);

        $kompanija = $korisnikModel->dohvatiKompanijuZaAutorizaciju();
        if (!isset($kompanija)) {
            echo json_encode(null);
            return;
        }
        echo json_encode($kompanija);
    }
    
    /**
     * inspekcija
     * Prikazuje View inspekcija i prosleđuje mu podatke o datom nalogu.
     * @return void
     */
    public function inspekcija() {
        // dohvatanje svih spornih naloga
        $recenzijaModel = new RecenzijaModel();
        $naloziInspekcija = $recenzijaModel->dohvatiNalogeZaInspekciju($this->session->get('moderator')->idM);
        // prikazivanje naloga
        return view('stranice/moderator/inspekcija', ['naloziInspekcija' => $naloziInspekcija]);
    }

    /**
     * inspekcija_odluka
     * Beleži odluku o mogućem izbacivanju naloga u bazi i poziva akciju za ponovni prikaz inspekcije.
     * @param  int $idK - id naloga
     * @param  string $odluka - odluka o izbacivanju
     * @return void
     */
    public function inspekcija_odluka($idK, $odluka) {
        $idM = $this->session->get('moderator')->idM;
        $glasanjeModel = new GlasanjeModel();
        // belezenje odluke
        if ($odluka == 'da') $glasanjeModel->zabeleziOdluku($idK, $idM, true); // ukini
        else if ($odluka == 'ne') $glasanjeModel->zabeleziOdluku($idK, $idM, false); // nemoj ukinuti
        // belezenje glasanja
        $glasaoModel = new GlasaoModel();
        $glasaoModel->zabeleziGlasanje($idM);
        return $this->inspekcija();
    }
     
    /**
     * tehnicka_podrska
     * Prikazuje View tehnička podrška i prosleđuje mu podatke o aktivnim razgovorima.
     * @return void
     */
    public function tehnicka_podrska() {
        $razgovorModel = new RazgovorModel();
        $idRaSvi = $razgovorModel->dohvatiIdSvihRazgovoraModeratora($this->session->get('moderator')->idM);
        $poslednjePoruke = null;
        $porukePoslednjeg = null;
        if (!empty($idRaSvi)) {
            $porukaModel = new PorukaModel();
            $poslednjePoruke = $porukaModel->dohvatiPoslednjePoruke($idRaSvi);
            $porukePoslednjeg = $porukaModel->dohvatiPorukeRazgovora($idRaSvi[count($idRaSvi) - 1]);
        }
        $brojNepreuzetih = $razgovorModel->dohvatiBrojNepreuzetihRazgovora();
        return view('stranice/moderator/tehnicka_podrska', ['poslednjePoruke' => $poslednjePoruke, 'porukePoslednjeg' => $porukePoslednjeg, 'brojNepreuzetih' => $brojNepreuzetih]);
    }

    /**
     * pregled_profila
     * Prikazuje View pregleda profila datog naloga.
     * @param  int $idK - id naloga
     * @param  int $pageNum - broj trenutne strane recenzija datog naloga
     * @return void
     */
    public function pregled_profila($idK, $pageNum = 0) {
        $recenzijaModel = new RecenzijaModel();
        $recenzije = $recenzijaModel->dohvatiRecenzijeSaAutorima($idK, $pageNum);
        $prosek = $recenzijaModel->dohvatiProsecnuOcenu($idK);
        $prosek = number_format((float)$prosek, 1, '.', ''); // formatiranje na jednu decimalu
        $brojRecenzija = $recenzijaModel->dohvatiBrojRecenzija($idK);
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->dohvatiKorisnika($idK);
        return view('stranice/moderator/pregled_profila', ['recenzije' => $recenzije, 'korisnik' => $korisnik, 'prosek' => $prosek, 'brojRecenzija' => $brojRecenzija, 'pageNum' => $pageNum]);
    }

}

<?php
namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;
use App\Models\ModeratorModel;
use App\Models\KorisnikModel;

/**
 * GlasanjeModel - klasa za CRUD pristup tabeli 'glasanje'
 * 
 * @version 1.0
 */
class GlasanjeModel extends Model
{    
    /**
     * @var string $table tabela baze
     */
    protected $table = 'glasanje';    
    /**
     * @var bool $useAutoIncrement auto-increment
     */
    protected $useAutoIncrement = true;    
    /**
     * @var string $returnType povratni tip upita
     */
    protected $returnType = 'object';    
    /**
     * @var array $allowedFields dozvoljena polja za promenu
     */
    protected $allowedFields = ['idK', 'idM', 'odluka'];

    /**
     * @var int VOTE_THRESHOLD - procenat glasova za ukidanje potrebnih da se nalog ukine
     */
    private const VOTE_THRESHOLD = 0.7;
    /**
     * @var int MIN_MODERATOR_PERCENT - za kraj glasanja potrebno je da glasa 51% ili vise moderatora
     */
    private const MIN_MODERATOR_PERCENT = 0.51;
    

    /**
     * zabeleziOdluku
     * Belezi odluku u tabeli 'glasanje'.
     * @param  int $idK - id korisnika
     * @param  int $idM - id moderatora
     * @param  bool $odluka - odluka
     * @return void
     */
    public function zabeleziOdluku($idK, $idM, $odluka) {
        $this->insert(['idK' => $idK, 'idM' => $idM, 'odluka' => $odluka]);
        if ($this->moguceZavrsitiGlasanje($idK)) $this->zavrsiGlasanje($idK);
    }

        
    /**
     * moguceZavrsitiGlasanje
     * Proverava da li je dovoljno moderatora glasalo.
     * @param  int $idK - id korisnika
     * @return bool - true ukoliko je moguće; false ukoliko nije
     */
    private function moguceZavrsitiGlasanje($idK) {
        $moderatorModel = new ModeratorModel();
        $modCount = $moderatorModel->countAll();
        if (count($this->where(['idK'=> $idK])->get()->getResult()) >= self::MIN_MODERATOR_PERCENT * $modCount) return true;
        return false;
    }

        
    /**
     * zavrsiGlasanje
     * Ažurira tabele 'glasanje' i 'korisnik'.
     * @param  int $idK - id korisnika
     * @return void
     */
    private function zavrsiGlasanje($idK) {
        $forCount = count($this->where(['idK'=> $idK, 'odluka' => true])->get()->getResult());
        $againstCount = count($this->where(['idK' => $idK, 'odluka' => false])->get()->getResult());
        $this->obrisiGlasove($idK);
        if ($forCount >= self::VOTE_THRESHOLD * ($forCount + $againstCount)) $this->banujKorisnika($idK);
        else $this->pomilujKorisnika($idK);
    }

      
    /**
     * obrisiGlasove
     * Briše sve redove iz tabele 'glasanje' za datog korisnika.  
     * @param  int $idK - id korisnika
     * @return void
     */
    private function obrisiGlasove($idK) {
        $this->where('idK', $idK)->delete();
    } 

        
    /**
     * banujKorisnika
     * Banuje datog korisnika.
     * @param  int $idK - id korisnika
     * @return void
     */
    private function banujKorisnika($idK) {
        $korisnikModel = new KorisnikModel();
        $korisnikModel->where('idK', $idK)->set([
            'banovan' => true
        ])->update();
    }

        
    /**
     * pomilujKorisnika
     * Postavlja 'imunitet' bit.
     * @param  int $idK - id korisnika
     * @return void
     */
    private function pomilujKorisnika($idK) {
        $korisnikModel = new KorisnikModel();
        $korisnikModel->where('idK', $idK)->set([
            'imunitet' => true
        ])->update();
    }

}
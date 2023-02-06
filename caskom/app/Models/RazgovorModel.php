<?php
namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;

use App\Models\PorukaModel;

/**
 * RazgovorModel - klasa za CRUD pristup tabeli 'razgovor'
 * 
 * @version 1.0
 */
class RazgovorModel extends Model
{
    /**
     * @var string $table tabela baze
     */
    protected $table = 'razgovor';
    /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idRa';
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
    protected $allowedFields = ['idK', 'idM'];
    
    /**
     * dohvatiRazgovorKorisnika
     * Dohvata razgovor datog korisnika.
     * @param  int $idK - id korisnika
     * @return mixed[] - red iz tabele 'razgovor'
     */
    public function dohvatiRazgovorKorisnika($idK) {
        return $this->where('idK', $idK)->get()->getResult(); 
    }
    
    /**
     * napraviRazgovorKorisnika
     * Pravi novi razgovor za datog korisnika.
     * @param  int $idK - id korisnika
     * @return void
     */
    public function napraviRazgovorKorisnika($idK) {
        $this->save(['idK' => $idK]);
    }
    
    /**
     * dohvatiIdRazgovoraKorisnika
     * Dohvata id razgovora za datog korisnika.
     * @param  int $idK -id korisnika
     * @return int - idRa razgovora datog korisnika
     */
    public function dohvatiIdRazgovoraKorisnika($idK) {
        $rows = $this->where('idK', $idK)->get()->getResult();
        if ($rows == null) return null;
        if (count($rows) != 1) return null;
        return $rows[0]->idRa;
    }
    
    /**
     * dohvatiIdSvihRazgovoraModeratora
     * Dohvata id-eve svih razgovora datog moderatora.
     * @param  int $idM - id moderatora
     * @return int[] - niz idRa svih razgovora datog moderatora
     */
    public function dohvatiIdSvihRazgovoraModeratora($idM) {
        $rows = $this->where('idM', $idM)->get()->getResult();
        $ret = array();
        foreach ($rows as $row) {
            array_push($ret, $row->idRa);
        }
        return $ret;
    }
    
    /**
     * dohvatiIdRazgovora
     * Dohvata id razgovora datih korisnika i moderatora.
     * @param  int $idK - id korisnika
     * @param  int $idM - id moderatora
     * @return int - idRa razgovora datih korisnika i moderatora.
     */
    public function dohvatiIdRazgovora($idK, $idM) {
        return $this->where(['idK' => $idK, 'idM' => $idM])->get()->getResult()[0]->idRa;
    }
    
    /**
     * dohvatiBrojNepreuzetihRazgovora
     * Dohvata broj nepreuzetih razgovora.
     * @return int - broj nepreuzetih razgovora
     */
    public function dohvatiBrojNepreuzetihRazgovora() {
        return count($this->where('idM IS NULL')->get()->getResult());
    }
    
    /**
     * preuzmiRazgovor
     * Preuzima slobodan razgovor za datog moderatora.
     * @param  int $idM - id moderatora
     * @return int - idK korisnika čiji je razgovor preuzet
     * @return null - nema nijednog slobodnog razgovora
     */
    public function preuzmiRazgovor($idM) {
        $openConvos = $this->where('idM IS NULL')->get()->getResult();
        if (empty($openConvos)) return null;
        $firstOpen = $openConvos[0];
        $this->where('idK', $firstOpen->idK)->set(['idM' => $idM])->update();
        return $firstOpen->idK;
    }
    
    /**
     * imajuRazgovor
     * Proverava da li dati korisnik i moderator imaju razgovor sa datim id-em
     * @param  int $idK - id korisnika
     * @param  int $idM - id moderatora
     * @param  int $idRa - id razgovora
     * @return bool - true ukoliko imaju; u suprotnom false
     */
    public function imajuRazgovor($idK, $idM, $idRa) {
        if (count($this->where(['idRa' => $idRa, 'idK' => $idK, 'idM' => $idM])->get()->getResult()) == 1) return true;
        return false;
    }
    
    /**
     * obrisiRazgovor
     * Briše razgovor sa datim id-em
     * @param  int $idRa - id razgovora
     * @return void
     */
    public function obrisiRazgovor($idRa) {
        $this->where('idRa', $idRa)->delete();
    }

}
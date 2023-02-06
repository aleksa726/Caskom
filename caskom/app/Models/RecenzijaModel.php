<?php

namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;
use App\Models\GlasanjeModel;

/**
 * RecenzijaModel - klasa za CRUD pristup tabeli 'recenzija'
 * 
 * @version 1.0
 */
class RecenzijaModel extends Model
{
    /* public function __construct() {
        parent::__construct();
    } */
    
    /**
     * @var string $table tabela baze
     */
    protected $table = 'recenzija';
    /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idRe';
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
    protected $allowedFields = ['idK_ko', 'idK_kome', 'ocena', 'tekst', 'vreme_postavljanja'];

    /**
     * @var int MIN_AVG - minimalna dopustiva prosečna ocena naloga
     */
    private const MIN_AVG = 3.0;
    /**
     * @var int REVIEWS_PER_PAGE - broj recenzija za prikazivanje po strani
     */
    private const REVIEWS_PER_PAGE = 4;

        
    /**
     * dohvatiRecenzije
     * Dohvata sve recenzije za datog korisnika.
     * @param  int $idK - id korisnika
     * @return mixed[] - niz recenzija za datog korisnika
     */
    public function dohvatiRecenzije($idK){
         return $this->where('idK_kome', $idK)->findAll();
    }
  
    /**
     * dohvatiNalogeZaInspekciju
     * Dohvata one naloge čija je prosečna ocena niža od minimalne dopustive, a da im nije postavljen bit imuniteta
     * i da za njih već nije glasao trenutni moderator.
     * @param  int $idM - id moderatora
     * @return mixed[] - niz korisničkih naloga za inspekciju
     */
    public function dohvatiNalogeZaInspekciju($idM) {
        $query = $this->select('idK')->join('korisnik', 'recenzija.idK_kome = korisnik.idK')->select('korisnicko_ime')->selectAvg('ocena')->where('imunitet', false)->where('banovan', false)->groupBy('idK_kome')->having('ocena <', self::MIN_AVG)->orderBy('ocena ASC')->get()->getResult();
        $query = array_filter($query, function($row, $index) use ($idM) {
            $glasanjeModel = new GlasanjeModel();
            if (empty($glasanjeModel->where(['idK' => $row->idK, 'idM' => $idM])->get()->getResult())) return true;
            return false;
        }, ARRAY_FILTER_USE_BOTH);
        return $query;
    } 
    
    /**
     * dohvatiRecenzijeSaAutorima
     * Dohvata recenzije datog korisnika zajedno sa korisničkim imenima njihovih autora.
     * @param  int $idK - id korisnika
     * @param  int $pageNum - broj stranice
     * @return mixed[] - niz recenzija datog korisnika i imena njihovih autora
     */
    public function dohvatiRecenzijeSaAutorima($idK, $pageNum) {
        return $this->select('recenzija.*')->select('korisnik.korisnicko_ime')->join('korisnik', 'recenzija.idK_ko = korisnik.idK')->where('idK_kome', $idK)->limit(self::REVIEWS_PER_PAGE, $pageNum * self::REVIEWS_PER_PAGE)->get()->getResult();
    }
  
    /**
     * dohvatiProsecnuOcenu
     * Dohvata prosečnu ocenu recenzija za datog korisnika
     * @param  int $idK - id korisnika
     * @return float - prosečna ocena recenzija
     */
    public function dohvatiProsecnuOcenu($idK) {
        return $this->where('idK_kome', $idK)->selectAvg('ocena')->get()->getResult()[0]->ocena;
    }
    
    /**
     * dohvatiBrojRecenzija
     * Dohvata broj recenzija za datog korisnika.
     * @param  int $idK - id korisnika
     * @return int - broj recenzija za datog korisnika
     */
    public function dohvatiBrojRecenzija($idK) {
        return $this->where('idK_kome', $idK)->selectCount('ocena')->get()->getResult()[0]->ocena;
    }
    
}
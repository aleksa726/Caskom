<?php
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
/*Aleksa Vukovic 18/0354*/

/**
 * ModeratorModel - klasa za CRUD pristup tabeli 'korisnik'
 * 
 * @version 1.0
 */


class KorisnikModel extends Model
{    
    /**
     * @var string $table tabela baze
     */
    protected $table      = 'korisnik';    
     /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idK';    
    /**
     * @var bool $useAutoIncrement auto-increment
     */
    protected $useAutoIncrement = true;    
    /**
     * @var string $returnType povratni tip upita
     */
    protected $returnType     = 'object';    
    /**
     * @var array $allowedFields dozvoljena polja za promenu
     */
    protected $allowedFields = ['korisnicko_ime', 'ime', 'e_mail', 'lozinka', 'imunitet', 'telefon', 'vidljiv_telefon', 'apr', 'banovan', 'pretplacen', 'odobren', 'idM','vreme_odluke'];

        
    /**
     * dohvatiKorisnika - vraca korisnika sa zadatim identifikatorom
     *
     * @param  int $id - zadati identifikator korisnika
     * @return object
     */
    public function dohvatiKorisnika($id) {
        return $this->find($id);
    }

            
    /**
     * dohvatiKompanijuZaAutorizaciju
     * Dohvata sledeću kompaniju za autorizaciju.
     * @return mixed - podaci o kompaniji
     */
    public function dohvatiKompanijuZaAutorizaciju(){
        $where_conds = array('apr !=' => NULL, 'odobren' => NULL);
        return $this->where($where_conds)->first();
    }

     
     /**
      * pretraga - pretrazuje bazu po zadatom tekstu i vraca odgovarajuce korisnike
      *
      * @param  mixed $tekst - zadati tekst po kom se pretrazuje
      * @return object[]
      */
     public function pretraga($tekst){
        return $this->like('korisnicko_ime', $tekst)->findAll();
    }

        
    /**
     * azurirajKorisnikaAutorizacija
     * Ažurira kompaniju sa odlukom o autorizaciji.
     * @param  int $idK - id kompanije
     * @param  bool $odluka - odluka
     * @param  int $idM - id moderatora
     * @return void
     */
    public function azurirajKorisnikaAutorizacija($idK, $odluka, $idM) {
        $this->where('idK', $idK)->set([
            'odobren' => $odluka,
            'idM' => $idM,
            'vreme_odluke' => new Time('now', 'Europe/Belgrade', 'en_US')
        ])->update();
    }

    /**
     * azurirajKorisnikaProvera
     * Ažurira korisnika sa odlukom o odobrenju pretplate.
     * @param  int $idK - id korisnika
     * @param  bool $odluka - odluka o odobrenju
     * @return void
     */
    public function azurirajKorisnikaProvera($idK, $odluka) {
        $this->where('idK', $idK)->set([
            'pretplacen' => $odluka
        ])->update();
    }
    
    /**
     * proveriImunitet
     * Vraća vrednost kolone "imunitet" datog korisnika
     * @param  int $idK
     * @return bool - vrednost kolone "imunitet"
     */
    public function proveriImunitet($idK) {
        $korisnik = $this->where('idK', $idK)->get()->getResult();
        return $korisnik->imunitet;
    }
    
    /**
     * postaviImunitet
     * Postavlja vrednost kolone "imunitet" korisnika na datu vrednost
     * @param  int $idK
     * @param  int $imunitet
     * @return void
     */
    public function postaviImunitet($idK, $imunitet) {
        $this->where('idK', $idK)->set([
            'imunitet' => $imunitet
        ])->update();
    }

}
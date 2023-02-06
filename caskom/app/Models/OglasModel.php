<?php
namespace App\Models;
use CodeIgniter\Model;
/*Aleksa Vukovic 18/0354*/

/**
 * ModeratorModel - klasa za CRUD pristup tabeli 'oglas'
 * 
 * @version 1.0
 */
class OglasModel extends Model
{    
    /**
     * @var string $table tabela baze
     */
    protected $table      = 'oglas';    
    /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idO';    
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
    protected $allowedFields = ['idK', 'naslov', 'cena', 'opis', 'brend', 'model',
            'stanje', 'velicina_kucista', 'materijal_kucista', 'materijal_narukvice', 'mehanizam', 'dostupan', 'boostovan'];

        
    /**
     * dohvatiOglase - vraca niz oglasa koji odgovaraju zadatom korisniku
     *
     * @param  mixed $idKor - identifikator zadatog krisnika
     * @return object[]
     */
    public function dohvatiOglase($idKor){
        return $this->where("idK", $idKor)->findAll();
    }
        
    /**
     * dohvatiBoostovane - vraca sve istaknute oglase
     *
     * @return object[]
     */
    public function dohvatiBoostovane(){
        return $this->where("boostovan", 1)->findAll();
    }
        
    /**
     * dohvatiObicne - vraca sve neistaknute oglase
     *
     * @return object[]
     */
    public function dohvatiObicne(){
        return $this->where("boostovan", 0)->findAll();
    }
        
    /**
     * dohvatiOglaseID - vraca oglas prema zadatom identifikatoru oglasa
     *
     * @param  int $idO - identifikator oglasa koji se dohvata
     * @return object
     */
    public function dohvatiOglaseID($idO){
        return $this->where("idO", $idO)->findAll();
    }
        
    /**
     * pretraga - pretrazuje bazu po zadatom tekstu i vraca odgovarajuce oglase
     *
     * @param  mixed $tekst - zadati tekst po kom se pretrazuje
     * @return object[]
     */
    public function pretraga($tekst){
        return $this->like('naslov', $tekst)->findAll();
    }
        
    /**
     * izvrsiUpit - izvrsava zadati upit i vraca rezultat
     *
     * @param  string $upit - upit po kom se pretrazuje baza
     * @return object[]
     */
    public function izvrsiUpit($upit){
        $query = $this->query($upit);
        return $query->result();
    }
        
    /**
     * filterBrend - vraca oglase koji odgovaraju zadatom brendu
     *
     * @param  string $brend - zadati brend po kom se pretrazuje
     * @return object[]
     */
    public function filterBrend($brend){
        return $this->like('brend', $brend)->findAll();
    }    
    /**
     * filterModel - vraca oglase koji odgovaraju zadatom modelu
     *
     * @param  string $model - zadati model po kom se pretrazuje
     * @return object[]
     */
    public function filterModel($model){
        return $this->like('model', $model)->findAll();
    }    
    /**
     * filterStanje - vraca oglase koji odgovaraju zadatom stanju
     *
     * @param  string $stanje - zadato stanje po kom se pretrazuje
     * @return object[]
     */
    public function filterStanje($stanje){
        return $this->like('stanje', $stanje)->findAll();
    }    
    /**
     * filterMaterijalKucista - vraca oglase koji odgovaraju zadatom materijalu kucista
     *
     * @param  string $materijalKucista - zadati materijal kucista po kom se pretrazuje
     * @return object[]
     */
    public function filterMaterijalKucista($materijalKucista){
        return $this->like('materijal_kucista', $materijalKucista)->findAll();
    }    
    /**
     * filterMaterijalNarukvice - vraca oglase koji odgovaraju zadatom materijalu narukvice
     *
     * @param  string $materijalNarukvice - zadati materijal narukvice po kom se pretrazuje
     * @return object[]
     */
    public function filterMaterijalNarukvice($materijalNarukvice){
        return $this->like('materijal_narukvice', $materijalNarukvice)->findAll();
    }    
    /**
     * filterMaehanizam - vraca oglase koji odgovaraju zadatom mehanizmu
     *
     * @param  string $mehanizam - zadati mehanizam po kom se pretrazuje 
     * @return object[]
     */
    public function filterMaehanizam($mehanizam){
        return $this->like('mehanizam', $mehanizam)->findAll();
    }
        
    /**
     * dohvatiOglasePoStranici - vraca oglase validnih kupaca koji se prikazuju na datoj stranici
     *
     * @param  int $pageNum - trenutna stranica
     * @return object[]
     */
    public function dohvatiOglasePoStranici($pageNum) {
        return $this->select('oglas.*')->join('korisnik', 'oglas.idK = korisnik.idK')->where('banovan', false)->where('pretplacen',true)->orderBy('boostovan', 'DESC')->limit(16, ($pageNum-1) * 16)->get()->getResult();
    }
    
    /**
     * azurirajOglasProvera
     * Ažurira oglas sa odlukom o odobrenju isticanja.
     * @param  int $idO - id oglasa
     * @param  bool $odluka - odluka o odobrenju
     * @return void
     */
    public function azurirajOglasProvera($idO, $odluka) {
        $this->where('idO', $idO)->set([
            'boostovan' => $odluka
        ])->update();
    }

}
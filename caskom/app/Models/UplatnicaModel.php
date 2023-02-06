<?php

namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;

use CodeIgniter\I18n\Time;

/**
 * UplatnicaModel - klasa za CRUD pristup tabeli 'uplatnica'
 * 
 * @version 1.0
 */
class UplatnicaModel extends Model
{
    /**
     * @var string $table tabela baze
     */
    protected $table = 'uplatnica';
    /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idU';
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
    protected $allowedFields = ['vreme_slanja', 'trajanje', 'idK', 'idO', 'idM', 'odluka', 'vreme_odluke', 'slika'];

    /**
     * @var int PRETPLATA - kod pretplate
     */
    public const PRETPLATA = 1;
    /**
     * @var int PRETPLATA - kod podizanja
     */
    public const PODIZANJE = 2;

  
    /**
     * dohvatiUplatnicuZaProveru
     * Dohvata za proveru narednu uplatnicu datog tipa.
     * @param  int $tip - tip uplatnice
     * @return mixed[] - uplatnica za proveru
     * @return null - nema uplatnice za proveru
     */
    public function dohvatiUplatnicuZaProveru($tip){
        if ($tip == self::PRETPLATA) {
            return $this->where(['odluka' => NULL, 'idO' => NULL])->first();
        }
        else if ($tip == self::PODIZANJE) {
            return $this->where(['odluka' => NULL, 'idO !=' => NULL])->first();
        }
        else return null;
    }
    
    // vraca sve uplatnice za datog korisnika    
    /**
     * pretraziUplatnice
     * Vrača sve uplatnice datog korisnika
     * @param  int $idK - id korisnika
     * @return mixed[] - uplatnice datog korisnika
     */
    public function pretraziUplatnice($idK){
        return $this->where('idK', $idK)->findAll();
    }
      
    /**
     * azurirajUplatnicuProvera
     * Ažurira uplatnice sa podacima vezanim za odluku provere.
     * @param  int $idU - id uplatnice
     * @param  int $idM - id moderatora
     * @param  bool $odluka - odluka
     * @return void
     */
    public function azurirajUplatnicuProvera($idU, $idM, $odluka) {
        $this->where('idU', $idU)->set([
            'idM' => $idM, 
            'odluka' => $odluka,
            'vreme_odluke' => new Time('now', 'Europe/Belgrade', 'en_US')
        ])->update();
    }
    
    /**
     * dohvatiKorisnika
     * Dohvata korisnika koji je postavio datu uplatnicu.
     * @param  int $idU - id uplatnice
     * @return int - id korisnika
     */
    public function dohvatiKorisnika($idU) {
        return $this->find($idU)->idK;
    }
    
    /**
     * dohvatiOglas
     * Dohvata oglas za koji je podneta data uplatnica.
     * @param  int $idU - id uplatnice
     * @return int - id oglasa
     */
    public function dohvatiOglas($idU) {
        return $this->find($idU)->idO;
    }
    
}
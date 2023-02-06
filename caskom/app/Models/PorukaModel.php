<?php
namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;

use CodeIgniter\I18n\Time;

/**
 * PorukaModel - klasa za CRUD pristup tabeli 'poruka'
 * 
 * @version 1.0
 */
class PorukaModel extends Model
{
    /**
     * @var string $table tabela baze
     */
    protected $table      = 'poruka';
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
    protected $allowedFields = ['idRa', 'idA', 'tip_autora', 'tekst', 'vreme'];
    
    /**
     * dodajPoruku
     * Dodaje poruku sa datim vrednostima kolona.
     * @param  int $idRa - id razgovora
     * @param  int $idA - id autora
     * @param  bool $authorType - tip autora
     * @param  string $message - sadržaj poruke
     * @return void
     */
    public function dodajPoruku($idRa, $idA, $authorType, $message) {
        $this->save([
            'idRa' => $idRa,
            'idA' => $idA,
            'tip_autora' => (bool)$authorType,
            'tekst' => $message,
            'vreme' => new Time('now', 'Europe/Belgrade', 'en_US')
        ]);
    }
    
    /**
     * dohvatiPoslednjuPoruku
     * Dohvata poslednju poruku iz datog razgovora.
     * @param  int $idRa - id razgovora
     * @return string - poslednja poruka iz datog razgovora
     * @return null - nema nijedne poruke u dazom razgovoru
     */
    public function dohvatiPoslednjuPoruku($idRa) {
        $poruke = $this->where('idRa', $idRa)->get()->getResult();
        if (empty($poruke)) return null;
        return $poruke[count($poruke) - 1]->tekst;
    }
    
    /**
     * dohvatiPoslednjePoruke
     * Dohvata poslednje poruke za date razgovore.
     * @param  int[] $idRaArray
     * @return string[] - poslednje poruke iz datih razgovora
     * @return null - ulazni niz je prazan ili neki od razgovora
     * nema nijednu poruku 
     */
    public function dohvatiPoslednjePoruke($idRaArray) {
        $ret = array();
        if (empty($idRaArray)) return null;
        foreach ($idRaArray as $idRa) {
            $query = $this->where('idRa', $idRa)->get()->getResult();
            if (empty($query)) return null;
            array_push($ret, $query[count($query) - 1]);
        }
        return $ret;
    }
    
    /**
     * dohvatiPorukeAutora
     * Dohvata sve poruke datog autora iz datog razgovora. 
     * @param  int $idRa - id razgovora
     * @param  int $idA - id autora
     * @param  bool $tip_autora -tip autora
     * @return string[] - poruke datog autora
     */
    public function dohvatiPorukeAutora($idRa, $idA, $tip_autora) {
        return $this->where(['idRa' => $idRa, 'idA' => $idA, 'tip_autora' => $tip_autora])->get()->getResult();
    }
    
    /**
     * dohvatiPorukeRazgovora
     * Dohvata poruke datog razgovora.
     * @param  int $idRa - id razgovora
     * @return string[] - poruke datog razgovora
     */
    public function dohvatiPorukeRazgovora($idRa) {
        return $this->where('idRa', $idRa)->get()->getResult();
    }
    
    /**
     * obrisiPorukeRazgovora
     * Briše poruke datog razgovora.
     * @param  int $idRa - id razgovora
     * @return void
     */
    public function obrisiPorukeRazgovora($idRa) {
        $this->where('idRa', $idRa)->delete();
    }

}
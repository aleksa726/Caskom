<?php
namespace App\Models;
use CodeIgniter\Model;
/*Aleksa Vukovic 18/0354*/

/**
 * ModeratorModel - klasa za CRUD pristup tabeli 'lista_zelja'
 * 
 * @version 1.0
 */
class ListaZeljaModel extends Model
{    
     /**
     * @var string $table tabela baze
     */
    protected $table      = 'lista_zelja';    
    /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idK, idO';    
    /**
     * @var bool $useAutoIncrement auto-increment
     */
    protected $useAutoIncrement = true; /* valjda da? */    
    /**
     * @var string $returnType povratni tip upita
     */
    protected $returnType     = 'object';    
    /**
     * @var array $allowedFields dozvoljena polja za promenu
     */
    protected $allowedFields = ['idK', 'idO'];
    
    /**
     * dohvatiOglaseIzListe - vraca sve oglase iz liste zelja za zadatog korisnika
     *
     * @param  mixed $idKorisnik - identifikator zadatog korisnika
     * @return object[]
     */
    public function dohvatiOglaseIzListe($idKorisnik){
         return $this->where('idK', $idKorisnik)->findAll();
    }
    
}
<?php
namespace App\Models;
use CodeIgniter\Model;

/*Aleksa Vukovic 18/0354*/


/**
 * FotografijaModel - klasa za CRUD pristup tabeli 'slika_oglas'
 * 
 * @version 1.0
 */
class FotografijaModel extends Model
{    
    /**
     * @var string $table tabela baze
     */
    protected $table      = 'slika_oglas';    
    /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idS';    
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
    protected $allowedFields = ['idO', 'putanja'];
    
    /**
     * dohvatiPoIdO - vraca fotografije sa zadatim identifikatorom oglasa kome pripada
     *
     * @param  int $idO - id oglasa kome pripadaju fotografije
     * @return object[]
     */
    public function dohvatiPoIdO($idO){
        return $this->where("idO", $idO)->find();
    }
}
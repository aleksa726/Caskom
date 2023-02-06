<?php
namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;

/**
 * ModeratorModel - klasa za CRUD pristup tabeli 'moderator'
 * 
 * @version 1.0
 */
class ModeratorModel extends Model
{
    /**
     * @var string $table tabela baze
     */
    protected $table = 'moderator';
    /**
     * @var string $primaryKey primarni ključ
     */
    protected $primaryKey = 'idM';
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
    protected $allowedFields = ['idM', 'ime', 'e_mail', 'korisnicko_ime', 'lozinka', 'obrisan'];

}
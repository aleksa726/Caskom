<?php
namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;

use CodeIgniter\I18n\Time;

/**
 * GlasaoModel - klasa za CRUD pristup tabeli 'glasao'
 * 
 * @version 1.0
 */
class GlasaoModel extends Model
{
    /**
     * @var string $table tabela baze
     */
    protected $table = 'glasao';
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
    protected $allowedFields = ['idM', 'vreme_glasanja'];

        
    /**
     * zabeleziGlasanje
     * Beleži glasanje u tabeli 'glasao'.
     * @param  int $idM - id moderatora
     * @return void
     */
    public function zabeleziGlasanje($idM) {
        $this->insert(['idM' => $idM, 'vreme_glasanja' => new Time('now', 'Europe/Belgrade', 'en_US')]);
    }

}
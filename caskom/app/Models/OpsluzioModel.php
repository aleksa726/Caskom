<?php
namespace App\Models;

/* Sava Gavrić 0359/18 */

use CodeIgniter\Model;

use CodeIgniter\I18n\Time;

/**
 * OpsluzioModel - klasa za CRUD pristup tabeli 'opsluzio'
 * 
 * @version 1.0
 */
class OpsluzioModel extends Model
{
    /**
     * @var string $table tabela baze
     */
    protected $table = 'opsluzio';
    /**
     * @var string $returnType povratni tip upita
     */
    protected $returnType = 'object';
    /**
     * @var array $allowedFields dozvoljena polja za promenu
     */
    protected $allowedFields = ['idM', 'vreme_kraja'];
    
    /**
     * zabeleziOpsluzivanje
     * Beleži opsluživanje datog moderatora.
     * @param  int $idM - id moderatora
     * @return void
     */
    public function zabeleziOpsluzivanje($idM) {
        $this->save([
            'idM' => $idM,
            'vreme_kraja' => new Time('now', 'Europe/Belgrade', 'en_US')
        ]);
    }

}
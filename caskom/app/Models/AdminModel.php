<?php

namespace App\Models;
/*Milica Milanovic 2018/0601 */
use CodeIgniter\Model;
/**
 * AdminModel - klasa za CRUD pristup tabeli 'admin'
 * 
 * @version 1.0
 */
class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'e_mail';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $allowedFields = ['ime', 'korisnicko_ime', 'lozinka'];

}
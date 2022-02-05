<?php

namespace App\Models;

use CodeIgniter\Model;

class Tokens extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'token';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['email', 'token'];
}

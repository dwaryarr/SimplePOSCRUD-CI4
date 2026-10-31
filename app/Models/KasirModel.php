<?php

namespace App\Models;

use CodeIgniter\Model;

class KasirModel extends Model
{
    protected $table            = 'kasir';
    protected $primaryKey       = 'id_kasir';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'nama_kasir',
        'username',
        'no_hp'
    ];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsumenModel extends Model
{
    protected $table            = 'konsumen';
    protected $primaryKey       = 'id_konsumen';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'nama_konsumen',
        'alamat',
        'no_hp'
    ];
}

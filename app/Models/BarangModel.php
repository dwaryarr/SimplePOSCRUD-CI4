<?php

namespace App\Models;

use CodeIgniter\Model;



class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'kode_brg';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'kode_brg',
        'nama_barang',
        'jenis',
        'harga_beli',
        'total_beli',
        'kode_konsumen'
    ];
}

<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }


    public function index()
    {
        $db = \Config\Database::connect();

        $data['title'] = 'Master Barang & Dashboard';

        $data['jml_barang'] = $db->table('barang')->countAllResults();
        $data['jml_konsumen'] = $db->table('konsumen')->countAllResults();
        $data['jml_kasir'] = $db->table('kasir')->countAllResults();

        $omzet = $db->table('transaksi')
            ->selectSum('total_bayar')
            ->get()->getRowArray();

        $data['total_omzet'] = $omzet['total_bayar'] ?? 0;

        $data['barang'] = $db->table('barang')->get()->getResultArray();

        $data['chart_barang'] = $db->query("
        SELECT b.nama_barang, COALESCE(SUM(t.jumlah), 0) AS total_terjual
        FROM barang b
        LEFT JOIN transaksi t ON b.kode_brg = t.kode_brg
        GROUP BY b.kode_brg, b.nama_barang
        ORDER BY total_terjual DESC
        LIMIT 5
    ")->getResultArray();

        $data['chart_kasir'] = $db->query("
        SELECT ks.nama_kasir, COUNT(t.id_transaksi) AS total_trx
        FROM kasir ks
        LEFT JOIN transaksi t ON ks.id_kasir = t.id_kasir
        GROUP BY ks.id_kasir, ks.nama_kasir
        ORDER BY total_trx DESC
    ")->getResultArray();

        return view('barang/index', $data);
    }


    public function tambah()
    {
        return view('barang/tambah', [
            'title' => 'Input Data Barang',
            'validation' => \Config\Services::validation()
        ]);
    }

    public function simpan()
    {
        $rules = [
            'kode_brg' => 'required|max_length[20]|is_unique[barang.kode_brg]',
            'nama_barang' => 'required|max_length[100]',
            'jenis' => 'required|max_length[50]',
            'harga_beli' => 'required|integer',
            'total_beli' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->barangModel->insert([
            'kode_brg' => $this->request->getPost('kode_brg'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jenis' => $this->request->getPost('jenis'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'total_beli' => $this->request->getPost('total_beli')
        ]);

        return redirect()->to('/barang')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit($kode)
    {
        $barang = $this->barangModel->find($kode);

        if (!$barang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('barang/edit', [
            'title' => 'Edit Data Barang',
            'barang' => $barang,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($kode)
    {
        $barang = $this->barangModel->find($kode);

        if (!$barang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_barang' => 'required|max_length[100]',
            'jenis' => 'required|max_length[50]',
            'harga_beli' => 'required|integer',
            'total_beli' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->barangModel->update($kode, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jenis' => $this->request->getPost('jenis'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'total_beli' => $this->request->getPost('total_beli')
        ]);

        return redirect()->to('/barang')
            ->with('success', 'Data barang berhasil diperbarui.');
    }


    public function hapus($kode)
    {
        $barang = $this->barangModel->find($kode);

        if (!$barang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->barangModel
            ->where('kode_brg', $kode)
            ->delete();

        return redirect()->to('/barang')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}

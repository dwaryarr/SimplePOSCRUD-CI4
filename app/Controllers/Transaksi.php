<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\BarangModel;
use App\Models\KonsumenModel;
use App\Models\KasirModel;

class Transaksi extends BaseController
{
    protected $transaksi;
    protected $barang;
    protected $konsumen;
    protected $kasir;

    public function __construct()
    {
        $this->transaksi = new TransaksiModel();
        $this->barang = new BarangModel();
        $this->konsumen = new KonsumenModel();
        $this->kasir = new KasirModel();
    }

    public function index()
    {
        $data['title'] = 'Data Transaksi';
        $data['transaksi'] = $this->transaksi
            ->select('transaksi.*, konsumen.nama_konsumen, kasir.nama_kasir, barang.nama_barang')
            ->join('konsumen', 'konsumen.id_konsumen = transaksi.id_konsumen')
            ->join('kasir', 'kasir.id_kasir = transaksi.id_kasir', 'left')
            ->join('barang', 'barang.kode_brg = transaksi.kode_brg')
            ->findAll();

        return view('transaksi/index', $data);
    }

    public function tambah()
    {
        return view('transaksi/tambah', [
            'title' => 'Input Transaksi Penjualan',
            'konsumen' => $this->konsumen->orderBy('nama_konsumen', 'ASC')->findAll(),
            'kasir' => $this->kasir->orderBy('nama_kasir', 'ASC')->findAll(),
            'barang' => $this->barang->orderBy('nama_barang', 'ASC')->findAll()
        ]);
    }

    public function simpan()
    {
        return $this->prosesSimpan();
    }

    public function edit($id)
    {
        $data['item'] = $this->transaksi->find($id);
        $data['title'] = 'Edit Transaksi ' . 'TRX-' . sprintf('%03d', $id);

        if (!$data['item']) {
            return redirect()->to('/transaksi');
        }

        $data['konsumen'] = $this->konsumen->findAll();
        $data['kasir'] = $this->kasir->findAll();
        $data['barang'] = $this->barang->findAll();

        return view('transaksi/edit', $data);
    }

    public function update($id)
    {
        return $this->prosesSimpan($id);
    }

    private function prosesSimpan($id = null)
    {
        $db = \Config\Database::connect();

        $kode = $this->request->getPost('kode_brg');
        $jumlah = (int) $this->request->getPost('jumlah');
        $idKonsumen = $this->request->getPost('id_konsumen');
        $idKasir = $this->request->getPost('id_kasir') ?: null;

        $barangBaru = $this->barang->find($kode);
        $konsumen = $this->konsumen->find($idKonsumen);
        $kasir = $idKasir ? $this->kasir->find($idKasir) : true;

        if (!$barangBaru || !$konsumen || !$kasir || $jumlah < 1) {
            return redirect()->back()->withInput()
                ->with('error', 'Data transaksi tidak valid.');
        }

        $transaksiLama = null;

        if ($id) {
            $transaksiLama = $this->transaksi->find($id);

            if (!$transaksiLama) {
                return redirect()->to('/transaksi');
            }
        }

        // Hitung stok yang tersedia
        $stokTersedia = (int) $barangBaru['total_beli'];

        if ($transaksiLama && $transaksiLama['kode_brg'] == $kode) {
            $stokTersedia += (int) $transaksiLama['jumlah'];
        }

        if ($jumlah > $stokTersedia) {
            return redirect()->back()->withInput()
                ->with('error', 'Stok barang tidak mencukupi.');
        }

        $data = [
            'id_konsumen' => $idKonsumen,
            'id_kasir' => $idKasir,
            'kode_brg' => $kode,
            'jumlah' => $jumlah,
            'harga' => $barangBaru['harga_beli'],
            'total_bayar' => $jumlah * $barangBaru['harga_beli']
        ];

        $db->transBegin();

        if ($transaksiLama) {
            // Kembalikan stok barang lama
            $db->table('barang')
                ->where('kode_brg', $transaksiLama['kode_brg'])
                ->set('total_beli', 'total_beli + ' . (int) $transaksiLama['jumlah'], false)
                ->update();
        }

        // Kurangi stok barang baru
        $db->table('barang')
            ->where('kode_brg', $kode)
            ->set('total_beli', 'total_beli - ' . $jumlah, false)
            ->update();

        if ($id) {
            $this->transaksi->where('id_transaksi', $id)->set($data)->update();
        } else {
            $this->transaksi->insert($data);
        }

        if ($db->transStatus() === false) {
            $db->transRollback();

            return redirect()->back()->withInput()
                ->with('error', 'Transaksi gagal diproses.');
        }

        $db->transCommit();

        return redirect()->to('/transaksi')->with(
            'success',
            $id ? 'Transaksi berhasil diperbarui.' : 'Transaksi berhasil disimpan.'
        );
    }

    public function struk($id)
    {
        $data['item'] = $this->transaksi
            ->select('transaksi.*,
                  konsumen.nama_konsumen, konsumen.alamat, konsumen.no_hp,
                  kasir.nama_kasir,
                  barang.nama_barang')
            ->join('konsumen', 'konsumen.id_konsumen = transaksi.id_konsumen')
            ->join('kasir', 'kasir.id_kasir = transaksi.id_kasir', 'left')
            ->join('barang', 'barang.kode_brg = transaksi.kode_brg')
            ->where('transaksi.id_transaksi', $id)
            ->first();

        if (!$data['item']) {
            return redirect()->to('/transaksi')
                ->with('error', 'Data struk tidak ditemukan.');
        }

        $data['title'] = 'Struk ' . 'TRX-' . sprintf('%03d', $id);

        return view('transaksi/struk', $data);
    }

    public function hapus($id)
    {
        $db = \Config\Database::connect();

        $item = $this->transaksi->find($id);

        if (!$item) {
            return redirect()->to('/transaksi');
        }

        $db->transBegin();

        // Kembalikan stok barang
        $db->table('barang')
            ->where('kode_brg', $item['kode_brg'])
            ->set('total_beli', 'total_beli + ' . (int) $item['jumlah'], false)
            ->update();

        // Hapus transaksi
        $this->transaksi->where('id_transaksi', $id)->delete();

        if ($db->transStatus() === false) {
            $db->transRollback();

            return redirect()->to('/transaksi')
                ->with('error', 'Transaksi gagal dihapus.');
        }

        $db->transCommit();

        return redirect()->to('/transaksi')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}

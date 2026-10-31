<?php

namespace App\Controllers;

use App\Models\KasirModel;

class Kasir extends BaseController
{
    protected $kasirModel;

    public function __construct()
    {
        $this->kasirModel = new KasirModel();
    }

    public function index()
    {
        return view('kasir/index', [
            'title' => 'Master Kasir',
            'kasir' => $this->kasirModel->findAll()
        ]);
    }

    public function tambah()
    {
        return view('kasir/tambah', [
            'title' => 'Input Data Kasir'
        ]);
    }

    public function simpan()
    {
        $rules = [
            'nama_kasir' => 'required|max_length[100]',
            'username' => 'required|max_length[50]|is_unique[kasir.username]',
            'no_hp' => 'required|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->kasirModel->insert([
            'nama_kasir' => $this->request->getPost('nama_kasir'),
            'username' => $this->request->getPost('username'),
            'no_hp' => $this->request->getPost('no_hp')
        ]);

        return redirect()->to('/kasir')
            ->with('success', 'Data kasir berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kasir = $this->kasirModel->find($id);

        if (!$kasir) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('kasir/edit', [
            'title' => 'Edit Data Kasir',
            'kasir' => $kasir
        ]);
    }

    public function update($id)
    {
        $kasir = $this->kasirModel->find($id);

        if (!$kasir) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_kasir' => 'required|max_length[100]',
            'username' => "required|max_length[50]|is_unique[kasir.username,id_kasir,$id]",
            'no_hp' => 'required|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->kasirModel
            ->where('id_kasir', $id)
            ->set([
                'nama_kasir' => $this->request->getPost('nama_kasir'),
                'username' => $this->request->getPost('username'),
                'no_hp' => $this->request->getPost('no_hp')
            ])
            ->update();

        return redirect()->to('/kasir')
            ->with('success', 'Data kasir berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $kasir = $this->kasirModel->find($id);

        if (!$kasir) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->kasirModel
            ->where('id_kasir', $id)
            ->delete();

        return redirect()->to('/kasir')
            ->with('success', 'Data kasir berhasil dihapus.');
    }
}

<?php

namespace App\Controllers;

use App\Models\KonsumenModel;

class Konsumen extends BaseController
{
    protected $konsumenModel;

    public function __construct()
    {
        $this->konsumenModel = new KonsumenModel();
    }

    public function index()
    {
        $data['title'] = 'Master Konsumen';
        $data['konsumen'] = $this->konsumenModel
            ->orderBy('id_konsumen', 'ASC')
            ->findAll();

        return view('konsumen/index', $data);
    }


    public function tambah()
    {
        return view('konsumen/tambah', [
            'title' => 'Input Data Konsumen'
        ]);
    }

    public function simpan()
    {
        $rules = [
            'nama_konsumen' => 'required|max_length[100]',
            'alamat' => 'permit_empty|max_length[200]',
            'no_hp' => 'permit_empty|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->konsumenModel->insert([
            'nama_konsumen' => $this->request->getPost('nama_konsumen'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp')
        ]);

        return redirect()->to('/konsumen')
            ->with('success', 'Data konsumen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $konsumen = $this->konsumenModel->find($id);

        if (!$konsumen) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('konsumen/edit', [
            'title' => 'Edit Data Konsumen',
            'konsumen' => $konsumen
        ]);
    }

    public function update($id)
    {
        $konsumen = $this->konsumenModel->find($id);

        if (!$konsumen) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'nama_konsumen' => 'required|max_length[100]',
            'alamat' => 'permit_empty|max_length[200]',
            'no_hp' => 'permit_empty|max_length[20]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->konsumenModel
            ->where('id_konsumen', $id)
            ->set([
                'nama_konsumen' => $this->request->getPost('nama_konsumen'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('no_hp')
            ])
            ->update();

        return redirect()->to('/konsumen')
            ->with('success', 'Data konsumen berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $konsumen = $this->konsumenModel->find($id);

        if (!$konsumen) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->konsumenModel
            ->where('id_konsumen', $id)
            ->delete();

        return redirect()->to('/konsumen')
            ->with('success', 'Data konsumen berhasil dihapus.');
    }
}

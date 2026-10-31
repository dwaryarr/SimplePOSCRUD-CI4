<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		try {
			$db = \Config\Database::connect();
			$db->initialize();

			echo 'Koneksi database berhasil!';
		} catch (\Exception $e) {
			echo 'Koneksi database gagal: ' . $e->getMessage();
		}
	}

	//--------------------------------------------------------------------

}

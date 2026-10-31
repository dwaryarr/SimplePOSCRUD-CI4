# Deploy Lokal dengan XAMPP / Laragon

1. Salin folder proyek ke `C:\xampp\htdocs\indomaret_ci4` atau `C:\laragon\www\indomaret_ci4`.
2. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
3. Buka `http://localhost/phpmyadmin`, lalu impor file SQL berurutan:
   `barang.sql`, `konsumen.sql`, `kasir.sql`, dan `transaksi.sql` dari folder `sql`.
   File SQL akan membuat database bernama `indomaret_ci4`.
4. Salin file `env` menjadi `.env`, lalu pastikan pengaturan berikut aktif dan sesuai:
   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost/indomaret_ci4/public/'
   database.default.hostname = localhost
   database.default.database = indomaret_ci4
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   ```
5. Buka aplikasi di `http://localhost/indomaret_ci4/public/`.

> Catatan: impor ulang file SQL akan menghapus dan membuat ulang tabel terkait beserta datanya.

## Requirements

- XAMPP or Laragon (PHP 7.3 atau lebih tinggi + MySQL)

## Fitur

- CRUD (Create, Read, Update, Delete) untuk:
  - Barang
    - Stok
  - Konsumen
  - Kasir
  - Transaksi
    - Cetak Struk

###

# Simple CRUD POS System CodeIgniter 4 (4.0.0)

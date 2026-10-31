<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Barang::index');
$routes->get('barang', 'Barang::index');
$routes->get('barang/tambah', 'Barang::tambah');
$routes->post('barang/simpan', 'Barang::simpan');
$routes->get('barang/edit/(:segment)', 'Barang::edit/$1');
$routes->post('barang/update/(:segment)', 'Barang::update/$1');
$routes->get('barang/hapus/(:segment)', 'Barang::hapus/$1');

$routes->get('konsumen', 'Konsumen::index');
$routes->get('konsumen/tambah', 'Konsumen::tambah');
$routes->post('konsumen/simpan', 'Konsumen::simpan');
$routes->get('konsumen/edit/(:num)', 'Konsumen::edit/$1');
$routes->post('konsumen/update/(:num)', 'Konsumen::update/$1');
$routes->get('konsumen/hapus/(:num)', 'Konsumen::hapus/$1');

$routes->get('kasir', 'Kasir::index');
$routes->get('kasir/tambah', 'Kasir::tambah');
$routes->post('kasir/simpan', 'Kasir::simpan');
$routes->get('kasir/edit/(:num)', 'Kasir::edit/$1');
$routes->post('kasir/update/(:num)', 'Kasir::update/$1');
$routes->get('kasir/hapus/(:num)', 'Kasir::hapus/$1');

$routes->get('transaksi', 'Transaksi::index');
$routes->get('transaksi/tambah', 'Transaksi::tambah');
$routes->post('transaksi/simpan', 'Transaksi::simpan');
$routes->get('transaksi/edit/(:num)', 'Transaksi::edit/$1');
$routes->post('transaksi/update/(:num)', 'Transaksi::update/$1');
$routes->get('transaksi/struk/(:num)', 'Transaksi::struk/$1');
$routes->get('transaksi/hapus/(:num)', 'Transaksi::hapus/$1');



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Route Fitur Tambah (Create)
$routes->post('home/tambah', 'Home::tambah');
$routes->post('tambah', 'Home::tambah');

// Route Fitur Hapus (Delete)
$routes->get('home/hapus/(:segment)', 'Home::hapus/$1');
$routes->get('hapus/(:segment)', 'Home::hapus/$1');

// Route Fitur Edit Modal (Update)
$routes->post('home/edit/(:segment)', 'Home::edit/$1');
$routes->post('edit/(:segment)', 'Home::edit/$1');

// Route Fitur Edit Langsung di Tabel (Inline Edit)
$routes->post('home/updateInline', 'Home::updateInline');
$routes->post('updateInline', 'Home::updateInline');

// Route Ekspor Data CSV
$routes->get('home/export', 'Home::export');
$routes->get('export', 'Home::export');
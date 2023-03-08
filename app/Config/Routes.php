<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/petugas', 'PetugasController::index');
$routes->get('/fpetugas', 'PetugasController::create');
$routes->add('/spetugas', 'PetugasController::save');
$routes->add('/petugas/edit/(:segment)','PetugasController::edit/$1');
$routes->get('/petugas/delete/(:segment)','PetugasController::delete/$1');

$routes->get('/masyarakat', 'MasyarakatController::index');
$routes->get('/fmasyarakat', 'MasyarakatController::create');
$routes->add('/masyarakat', 'MasyarakatController::save');
$routes->add('/masyarakat/edit/(:segment)', 'MasyarakatController::edit/$1');
$routes->get('/masyarakat/delete/(:segment)', 'MasyarakatController::delete/$1');

$routes->get('/login', 'loginController::index');
$routes->get('/register', 'loginController::register');
$routes->post('/saveregister','loginController::saveRegister');
$routes->post('/login', 'loginController::login');
$routes->get('/logout', 'loginController::logout');

$routes->get('/pengaduan','PengaduanController::index');
$routes->add('/spengaduan', 'PengaduanController::save');
$routes->add('/pengaduan/edit/(:segment)','PengaduanController::edit/$1');
$routes->get('/pengaduan/delete/(:segment)', 'PengaduanController::delete/$1');
$routes->post('/tambahpengaduan', 'PengaduanController::save');

$routes->get('/tanggapan','TanggapanController::index');
$routes->add('/stanggapan', 'TanggapanController::save');
$routes->add('/tanggapan/edit/(:segment)','TanggapanController::edit/$1');
$routes->get('/tanggapan/delete/(:segment)', 'TanggapanController::delete/$1');

$routes->get('/profil', 'LoginController::lihatProfil');
$routes->post('/editprofil', 'LoginController::editProfil');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

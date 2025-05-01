<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_auth';

//Auth
$route['auth'] = 'C_auth';
$route['login'] = 'C_auth';
$route['auth/(:any)'] = 'C_auth/$1';

//App
$route['app'] = 'C_app';
$route['app/(:any)'] = 'C_app/$1';
$route['app/(:any)/(:any)'] = 'C_app/$1/$2';

//Kategori
$route['kategori'] = 'C_app/kategori';
$route['kategori/(:any)'] = 'C_app/kategori/$1';
$route['kategori/(:any)/(:any)'] = 'C_app/kategori/$1/$2';

//Laporan
$route['laporan'] = 'C_laporan';
$route['laporan/(:any)'] = 'C_laporan/$1';
$route['laporan/(:any)/(:any)'] = 'C_laporan/$1/$2';
$route['laporan/(:any)/(:any)/(:any)'] = 'C_laporan/$1/$2/$3';
$route['laporan/(:any)/(:any)/(:any)/(:any)'] = 'C_laporan/$1/$2/$3/$4';


//Pengeluaran
$route['pengeluaran'] = 'C_pengeluaran';
$route['pengeluaran/(:any)'] = 'C_pengeluaran/$1';
$route['pengeluaran/(:any)/(:any)'] = 'C_pengeluaran/$1/$2';

//Dashboard
$route['dashboard'] = 'C_dashboard';

//User
$route['user'] = 'C_user';
$route['user/(:any)'] = 'C_user/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

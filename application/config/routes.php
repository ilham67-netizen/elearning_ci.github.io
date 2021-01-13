<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['mahasiswa/add'] = "mahasiswa/add";
$route['mahasiswa/edit/(:num)'] = "mahasiswa/edit/$1";
$route['mahasiswa/delete/(:num)/(:any)'] = "mahasiswa/delete/$1";

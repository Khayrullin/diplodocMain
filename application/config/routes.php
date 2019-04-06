<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['api/authentication/login'] = 'api/authentication/login';
$route['api/authentication/registration'] = 'api/authentication/registration';
$route['api/authentication/user/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/authentication/user/id/$1/format/$3$4';
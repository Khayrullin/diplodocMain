<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'auth';


/**
 * Define API Routes
 */
$route['api/simple'] = 'api/user_api/simple_api';
$route['api/limit'] = 'api/user_api/api_limit';
$route['api/key'] = 'api/user_api/api_key';
$route['api/login'] = 'api/user_api/login';
$route['api/test'] = 'api/user_api/view';
$route['api/view'] = 'api/mobile_api/get_data';
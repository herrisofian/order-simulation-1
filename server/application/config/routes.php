<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['API'] = 'Rest_server';

// USER API ROUTES
$route['api/user/login'] = 'users/Users/user_login';
$route['api/user/get'] = 'users/Users/user_fetch';
// DRIVER API ROUTES
$route['api/driver/login'] = 'drivers/Drivers/driver_login';

// ITEM API ROUTES
$route['api/products/get'] = 'products/Products/index';

// ORDER API ROUTES
$route['api/orders/post'] = 'orders/Orders/order';
$route['api/ordershistory/post'] = 'orders/Orders/order_history';
$route['api/driver/take_orders'] = 'orders/Orders/driver_take_orders';
$route['api/driver/orders_history'] = 'orders/Orders/orders_driver';
$route['api/driver/orders_delivery'] = 'orders/Orders/driver_delivery';
$route['api/driver/orders_delivered'] = 'orders/Orders/driver_delivered';

// NEW ORDERS DRIVER 
$route['api/driver/orders'] = 'drivers/Drivers/driver_orders';


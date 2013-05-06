<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";
$route['process_signin'] = "signin/process_signin";
$route['signin'] = "signin/signin";
$route['invalid_email_password'] = "signin/invalid_email_password";
$route['process_register'] = "register/process_register";
$route['register'] = "register/register";
$route['registration_complete'] = "register/registration_complete";
$route['registration_email_taken'] = "register/registration_email_taken";
$route['dashboard'] = "dashboard/dashboard";
$route['process_message'] = "users/process_message";
$route['process_comment'] = "users/process_comment";
$route['users/new'] = "users/new_user";
$route['edit_user'] = "users/edit_user";
$route['logout'] = "dashboard/logout";
$route['404_override'] = '';
$route['update_description'] = "users/update_description";



/* End of file routes.php */
/* Location: ./application/config/routes.php */
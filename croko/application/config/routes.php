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


$route['404_override'] = '';
$route['admin'] = "users/login";


if ($this->config->item('homepage')) $route['default_controller'] = "pages/index/" . $this->config->item('homepage')  ;
else $route['default_controller'] = "pages/home";




$route['fbook/(:any)'] = 'fbook';
$route['users/([\w_-]+)'] = 'users/$1'; 

$route['cart'] = 'cart/index';
$route['cart/(:any)'] = 'cart/$1/$2';

$route['gallery'] = 'galleries/all';
$route['gallery/:any'] = 'galleries/show';

 
// new gallery routing for better seo ( 404 error works!)

$route['galleries/(:any)'] = 'galleries/$1/$2/$3';
$route['portfolio'] = 'galleries/all';
$route['portfolio/:any'] = 'galleries/show';
$route['admin/ajax/(:any)'] = 'ajax/$1/$2/$3';
$route['admin/news/(:any)'] = 'news/$1/$2/$3';
$route['admin/services/(:any)'] = 'services/$1/$2/$3';			
$route['admin/(:any)'] = 'admin/$1/$2/$3';
$route['articles/catgallery/(:any)'] = "articles/catgallery/$1";	
$route['articles'] = "articles/all";
$route['articles/category/(:any)'] = "articles/category/$1";
$route['articles/gallery/(:any)'] = "articles/gallery/$1";
$route['articles/search'] = "articles/search";
$route['articles/:any'] = "articles";
$route['search/:any'] = "search";
$route['squeeze/:any'] = "squeeze";
$route['(:any)'] = "pages";
$route['thanks'] = "pages/thanks";


// special handler to robots.txt inside the CMS. 

$route['robots.txt'] = "services/robots";		












/* End of file routes.php */
/* Location: ./application/config/routes.php */
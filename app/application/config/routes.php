<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'home/index';
$route['404_override']         = 'home/page_404';
$route['404']                  = 'home/page_404';
$route['maintenance']          = 'home/maintenance';
$route['translate_uri_dashes'] = false;
$route['image']                = 'admin/storage/image';

//ADMIn routes
$route['admin']                = 'admin/home/index';
$route['admin/storage/upload'] = 'admin/storage/upload';
$route['admin/storage/(:any)'] = 'admin/storage';
$route['admin/storage']        = 'admin/storage/cmd';
$route['admin/files']          = 'admin/storage/manager';

//-----------------challenge-------------------

$route['admin/challenge']               = 'admin/challenge/index';
$route['admin/challenge/create']        = 'admin/challenge/create';
$route['admin/challenge/edit/(:num)']   = 'admin/challenge/edit';
$route['admin/challenge/delete/(:num)'] = 'admin/challenge/delete';

$route['admin/hint/(:num)']               = 'admin/challenge/hint_index';
$route['admin/hint/(:num)/create']        = 'admin/challenge/hint_create';
$route['admin/hint/(:num)/edit/(:num)']   = 'admin/challenge/hint_edit';
$route['admin/hint/(:num)/delete/(:num)'] = 'admin/challenge/hint_delete';

$route['admin/category']               = 'admin/challenge/cate_index';
$route['admin/category/edit']          = 'admin/challenge/cate_edit';
$route['admin/category/edit/(:num)']   = 'admin/challenge/cate_edit';
$route['admin/category/delete/(:num)'] = 'admin/challenge/cate_delete';

//----------------webmaster-------------------
$route['admin/webmaster']                     = 'admin/webmaster/index';
$route['admin/webmaster/sitec']               = 'admin/webmaster/site_list';
$route['admin/webmaster/sitec/create']        = 'admin/webmaster/site_create';
$route['admin/webmaster/sitec/edit/(:num)']   = 'admin/webmaster/site_edit';
$route['admin/webmaster/sitec/delete/(:num)'] = 'admin/webmaster/site_delete';

//----------------Websettings------------------
$route['admin/websettings']                                = 'admin/websettings/index';
$route['admin/websettings/menus']                          = 'admin/websettings/menus_list';
$route['admin/websettings/menus_edit/(:num)']              = 'admin/websettings/menus_edit';
$route['admin/websettings/menus_delete/(:num)']            = 'admin/websettings/menus_delete';
$route['admin/websettings/menus/sub/(:num)']               = 'admin/websettings/submenu';
$route['admin/websettings/menus/sub/(:num)/edit/(:num)']   = 'admin/websettings/submenu_edit';
$route['admin/websettings/menus/sub/(:num)/delete/(:num)'] = 'admin/websettings/submenu_delete';

//-----------------Users Manager-----------------
$route['admin/users']               = 'admin/users/index';
$route['admin/users/create']        = 'admin/users/create';
$route['admin/users/edit/(:num)']   = 'admin/users/users_edit';
$route['admin/users/delete/(:num)'] = 'admin/users/users_delete';

//------------------Site Page--------------------
$route['admin/pages']               = 'admin/pages/index';
$route['admin/pages/create']        = 'admin/pages/create';
$route['admin/pages/edit/(:num)']   = 'admin/pages/edit';
$route['admin/pages/delete/(:num)'] = 'admin/pages/delete';

$route['admin/themes']            = 'admin/themes/index';
$route['admin/themes/set/(:any)'] = 'admin/themes/set_theme';
$route['admin/themes/custom']     = 'admin/themes/custom';

$route['admin/icons'] = 'admin/home/icons';

$route['auth/login']    = 'auth/login';
$route['auth/register'] = 'auth/register';
$route['auth/logout']   = 'auth/logout';
$route['verify']        = 'auth/verify';
$route['verify/(:any)'] = 'auth/token';
$route['forgot']        = 'auth/forgot';
$route['forgot/(:any)'] = 'auth/token';
$route['banned']        = 'auth/banned';

$route['users']                     = 'users/index';
$route['users/settings']            = 'users/settings';
$route['users/(:any)']              = 'users/get_users';
$route['users/settings']            = 'users/settings';
$route['users/ajax/getmyprofile']   = 'users/profile_header';
$route['users/ajax/changepassword'] = 'users/change_password';
$route['users/ajax/changeusername'] = 'users/change_username';
$route['users/ajax/changeemail']    = 'users/change_email';
$route['users/ajax/changeavatar']   = 'users/change_avatar';
$route['users/ajax/uploadavatar']   = 'users/upload_avatar';

$route['home']                            = 'home/index';
$route['challenge']                       = 'challenge/index';
$route['challenge/ajax/getdetail/(:any)'] = 'challenge/get_detail';
$route['challenge/ajax/getchall']         = 'challenge/get_chall';
$route['challenge/ajax/flagsubmit']       = 'challenge/flag_submit';
$route['challenge/ajax/gethint/(:num)']   = 'challenge/get_hint';
$route['challenge/usehint/(:num)']        = 'challenge/use_hint';

$route['rankboard'] = 'rankboard/index';

$route['(:any)'] = 'home/page';
<?php


// tes test


if (is_admin())
{
	add_action('admin_menu', array('MenuController', 'menu'));
	
}
/*
class Mio
{
	public static $current_user;
}

Mio::$current_user = MioUser::validate($_COOKIE['mio-auth']);

if (is_admin())
{
	add_action('admin_menu', array('MenuController', 'menu'));
	
}
else
*/
/*if ($_GET['m'] == 'fairhaven')
{
	$controller = ucwords($_GET['c']) . 'Controller';	
	call_user_func($controller . '::' . $_GET['a']);

}*/
/*
elseif (strpos($_SERVER['REQUEST_URI'], '/profile/') === 0 && !Mio::$current_user)
{
	echo "<script>document.location = '/';</script>";
}

if ($_COOKIE['mio-auth'] && Mio::$current_user)
{
	define('MIO_LOGGED_IN', 1);
}
else
{
	define('MIO_LOGGED_IN', 0);
}


// CronController::cron_init();

*/


?>
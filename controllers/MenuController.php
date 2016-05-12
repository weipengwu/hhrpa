<?php

class MenuController 
{
	public static function index()
	{

	}

	public static function menu()
	{
 		add_menu_page('HHRPA Menu', 'HHRPA Membership', 'administrator', 'hhrpa-main_menu', 'dispatch', ''); 

 		add_submenu_page('hhrpa-main_menu', 'HHRPA Members', 'Members', 'administrator', 'hhrpa-members', array('MemberController', 'index'));
 		add_submenu_page('hhrpa-main_menu', 'HHRPA Organizations', 'Organizations', 'administrator', 'hhrpa-organizations', array('OrgController', 'index'));


 		add_submenu_page('hhrpa-members', 'HHRPA Members Details', '', 'administrator', 'hhrpa-members-details', array('MemberController', 'details'));
 		add_submenu_page('hhrpa-members', 'HHRPA Members Details', '', 'administrator', 'hhrpa-members-update', array('MemberController', 'update'));
 		add_submenu_page('hhrpa-members', 'HHRPA Members Details', '', 'administrator', 'hhrpa-members-delete', array('MemberController', 'delete'));


 		add_submenu_page('hhrpa-orgaizations', 'HHRPA Organizations Details', '', 'administrator', 'hhrpa-organizations-details', array('OrgController', 'details'));
 		add_submenu_page('hhrpa-orgaizations', 'HHRPA Organizations Details', '', 'administrator', 'hhrpa-organizations-update', array('OrgController', 'update'));
 		add_submenu_page('hhrpa-orgaizations', 'HHRPA Organizations Details', '', 'administrator', 'hhrpa-organizations-delete', array('OrgController', 'delete'));


	}
}


?>
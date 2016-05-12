<?php

class MemberController 
{
	public static function index()
	{	
		$members = HHRPAMembers::find_all(array(), null, 'first_name ASC');
		
		require_once(PLUGIN_ROOT . '/views/members/index.php');
	}	

    public static function details()
    {   
        if (isset($_GET['id']))
            $members = HHRPAMembers::find(array(), array('id' => $_GET['id']));
        else
            $members = new HHRPAMembers();
        
        require_once(PLUGIN_ROOT . '/views/members/details.php');   
    }
    
	public static function update()
	{	

		if ($_POST['id'] != '')
			$members = HHRPAMembers::find(array(), array('id' => $_POST['id']));

		else
			$members = new HHRPAMembers();
		if(isset($_POST['member']['password'])&&!empty($_POST['member']['password'])){
			if($_POST['member']['password'] == $_POST['pass_confirm']){
				$members->populate($_POST['member']);
				$members->password = wp_hash_password($_POST['member']['password']);
				$members->save();
				echo '<script>document.location = "admin.php?page=hhrpa-members";</script>';
			}else{
				session_start();
				$_SESSION['error'] = "Please enter the same password in the two password fields.";
				echo '<script>document.location = "admin.php?page=hhrpa-members-details";</script>';
			}
		}else{
			$members->populate($_POST['member']);
			$members->password = $_POST['hide_pass'];
			$members->save();
			echo '<script>document.location = "admin.php?page=hhrpa-members";</script>';
		}
	}

	public static function delete()
	{
		
		$members = HHRPAMembers::find(array(), array('id' => $_GET['id']));
		HHRPAMembers::delete($members);

		echo '<script>document.location = "admin.php?page=hhrpa-members";</script>';
	}

	
}

?>
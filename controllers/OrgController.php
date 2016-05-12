<?php

class OrgController 
{
	public static function index()
	{	
		$organizations = HHRPAOrgs::find_all(array(), null, 'name ASC');
		
		require_once(PLUGIN_ROOT . '/views/org/index.php');
	}	

    public static function details()
    {   
        if (isset($_GET['id']))
            $organizations = HHRPAOrgs::find(array(), array('id' => $_GET['id']));
        else
            $organizations = new HHRPAOrgs();
        
        require_once(PLUGIN_ROOT . '/views/org/details.php');   
    }
    
	public static function update()
	{	

		if ($_POST['id'] != '')
			$organizations = HHRPAOrgs::find(array(), array('id' => $_POST['id']));

		else
			$organizations = new HHRPAOrgs();

		$organizations->populate($_POST['organization']);
		$organizations->save();
		echo '<script>document.location = "admin.php?page=hhrpa-organizations";</script>';
	}

	public static function delete()
	{
		
		$organizations = HHRPAOrgs::find(array(), array('id' => $_GET['id']));
		HHRPAOrgs::delete($organizations);


		echo '<script>document.location = "admin.php?page=hhrpa-organizations";</script>';
	}

	
}

?>
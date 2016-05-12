<?php require(PLUGIN_ROOT . '/views/header.php');?>



<div class="wrap" id="profile-page">
	<div id="icon-users" class="icon32">
		<br>
	</div>
	<h2>HHRPA Member - <?php echo ($members->first_name == "" && $members->last_name == "")? 'Add New Member' : $members->first_name.' '.$members->last_name?></h2>
	<?php 
	session_start();
	$error = $_SESSION['error'];
	if(isset($error)):?>
	<div class="error"><p><strong>ERROR</strong>: <?= $error;?></p></div>
	<?php session_destroy(); endif;?>
	<form action="admin.php?page=hhrpa-members-update" method="post">
		<input id="id" type="hidden" name="id" value="<?= $members->id ?>">
		<div class="formrow">
			<label for="member[username]">Username</label>
			<input type="text" name="member[username]" value="<?php echo  $members->username ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="name">Member Type</label>
			<select name="member[type]">
				<option value="0"> - Select - </option>
				<option value="Full Member"<?php if($members->type == 'Full Member' ) echo ' selected';?>>Full Member</option>
				<option value="Associate Member"<?php if($members->type == 'Associate Member' ) echo ' selected';?>>Associate Member</option>
				<option value="Affiliate Member"<?php if($members->type == 'Affiliate Member' ) echo ' selected';?>>Affiliate Member</option>
				<option value="Board Member"<?php if($members->type == 'Board Member' ) echo ' selected';?>>Board Member</option>
			</select>
		</div>
		<div class="formrow">
			<label for="member[first_name]">First Name</label>
			<input type="text" name="member[first_name]" value="<?php echo  $members->first_name ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[last_name]">Last Name</label>
			<input type="text" name="member[last_name]" value="<?php echo  $members->last_name ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[job_title]">Job Title</label>
			<input type="text" name="member[job_title]" value="<?php echo  $members->job_title ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[email]">Email</label>
			<input type="text" name="member[email]" value="<?php echo  $members->email ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[phone]">Direct Phone</label>
			<input type="text" name="member[phone]" value="<?php echo  $members->phone ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[m_phone]">Mobile Phone</label>
			<input type="text" name="member[m_phone]" value="<?php echo  $members->m_phone ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[fax]">Fax</label>
			<input type="text" name="member[fax]" value="<?php echo  $members->fax ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="name">Organization</label>
			<select name="member[organization]">
				<option value="0"> - Select an Organization - </option>
				<? $organizations = HHRPAOrgs::find_all(array()); ?>
				<? $o = $members->organization; ?>
				<? foreach( $organizations as $organization): ?>
				<option value="<?= $organization->name ?>"<?php if($o == $organization->name ) echo ' selected';?>><?= $organization->name ?></option>
				<? endforeach;?>
			</select>
		</div>
		<div class="formrow">
			<label for="member[linkenin]">Linkenin</label>
			<input type="text" name="member[linkenin]" value="<?php echo  $members->linkenin ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[twitter]">Twitter</label>
			<input type="text" name="member[twitter]" value="<?php echo  $members->twitter ?>" class="regular-text">
		</div>

		<br><br>

		<div class="formrow">
			<label for="member[password]">New Password</label>
			<input type="text" name="member[password]" class="regular-text">
		</div>
		<div class="formrow">
			<label for="member[password_confirm]">New Password Confirm</label>
			<input type="text" name="pass_confirm" class="regular-text">
		</div>
		<div class="formrow">
			<input type="hidden" name="hide_pass" value="<?php echo  $members->password ?>">
		</div>
		<br><br>
		<input type="submit" name="submit" id="submit" class="button-primary" value="<?= $members->id == ''? 'Add member' : 'Update member' ?>">

		<? if( $members->id != '' ): ?>
		<button id="del_btn">Delete This member</button>
		<? endif;?>

	</form>
	
	
	<script>
		jQuery(function($){
			$("#del_btn").on("click",function(event){
			    event.stopPropagation();
			    if(confirm("Are you sure you want to delete this member? This step CANNOT be undone.")) {
			    	this.click;
			    	window.open('admin.php?page=hhrpa-members-delete&id='+$('input#id').val() ,'_self',false);
			    }
			    else
			    {
			        
			    }       
			   event.preventDefault();

			});		

		});
	</script>

</div>

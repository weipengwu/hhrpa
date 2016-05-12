<?php require(PLUGIN_ROOT . '/views/header.php');?>



<div class="wrap" id="profile-page">
	<div id="icon-users" class="icon32">
		<br>
	</div>
	<h2>HHRPA Organization - <?php echo ($organizations->name == "")? 'Add New Organization' : $organizations->name ?></h2>
	<form action="admin.php?page=hhrpa-organizations-update" method="post">
		<input id="id" type="hidden" name="id" value="<?= $organizations->id ?>">
		<div class="formrow">
			<label for="organization[name]">Name</label>
			<input type="text" name="organization[name]" value="<?php echo  $organizations->name ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[email]">Email</label>
			<input type="text" name="organization[email]" value="<?php echo  $organizations->email ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[address1]">Address 1</label>
			<input type="text" name="organization[address1]" value="<?php echo  $organizations->address1 ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[address2]">Address 2</label>
			<input type="text" name="organization[address2]" value="<?php echo  $organizations->address2 ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[city]">City</label>
			<input type="text" name="organization[city]" value="<?php echo  $organizations->city ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[province]">Province</label>
			<?php $p = $organizations->province; ?>
			<select name="organization[province]">
				<option value="0"> -- Select a province -- </option>
				<option value="Alberta"<?php if($p == 'Alberta') echo ' selected';?>>Alberta</option>
				<option value="British Columbia"<?php if($p == 'British Columbia') echo ' selected';?>>British Columbia</option>
				<option value="Manitoba"<?php if($p == 'Manitoba') echo ' selected';?>>Manitoba</option>
				<option value="New Brunswick"<?php if($p == 'New Brunswick') echo ' selected';?>>New Brunswick</option>
				<option value="Newfoundland and Labrador"<?php if($p == 'Newfoundland and Labrador') echo ' selected';?>>Newfoundland and Labrador</option>
				<option value="Nova Scotia"<?php if($p == 'Nova Scotia') echo ' selected';?>>Nova Scotia</option>
				<option value="Ontario"<?php if($p == 'Ontario') echo ' selected';?>>Ontario</option>
				<option value="Prince Edward Island"<?php if($p == 'Prince Edward Island') echo ' selected';?>>Prince Edward Island</option>
				<option value="Quebec"<?php if($p == 'Quebec') echo ' selected';?>>Quebec</option>
				<option value="Saskatchewan"<?php if($p == 'Saskatchewan') echo ' selected';?>>Saskatchewan</option>
			</select>	
		</div>
		<div class="formrow">
			<label for="organization[postal_code]">Postal Code</label>
			<input type="text" name="organization[postal_code]" value="<?php echo  $organizations->postal_code ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[phone]">Phone Number</label>
			<input type="text" name="organization[phone]" value="<?php echo  $organizations->phone ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[fax]">Fax</label>
			<input type="text" name="organization[fax]" value="<?php echo  $organizations->fax ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[website]">Website</label>
			<input type="text" name="organization[website]" value="<?php echo  $organizations->website ?>" class="regular-text">
		</div>
		<div class="formrow">
			<label for="organization[province]">Multiple HR Ttiles</label>
			<?php $m = $organizations->multiple_hr_titles; ?>
			<select name="organization[multiple_hr_titles]">
				<option value="Yes"<?php if($m == 'Yes') echo ' selected';?>>Yes</option>
				<option value="No"<?php if($m == 'No') echo ' selected';?>>No</option>
			</select>	
		</div>

		<br><br>

		<input type="submit" name="submit" id="submit" class="button-primary" value="<?= $organizations->id == ''? 'Add organization' : 'Update organization' ?>">

		<? if( $organizations->id != '' ): ?>
		<button id="del_btn">Delete This organization</button>
		<? endif;?>

	</form>
	
	
	<script>
		jQuery(function($){
			$("#del_btn").on("click",function(event){
			    event.stopPropagation();
			    if(confirm("Are you sure you want to delete this organization? This step CANNOT be undone.")) {
			    	this.click;
			    	window.open('admin.php?page=hhrpa-organizations-delete&id='+$('input#id').val() ,'_self',false);
			    }
			    else
			    {
			        
			    }       
			   event.preventDefault();

			});		

		});
	</script>

</div>

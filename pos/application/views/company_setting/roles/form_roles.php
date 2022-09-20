<?php 
if ($roles_code == "") {
	$roles_code 	= $roles_code;
	$roles_name 	= "";
}else{
	$roles_code 	= $get_roles->roles_code;
	$roles_name 	= $get_roles->roles_name;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Roles Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="roles_code" id="roles_code" class="form-control" value="<?=$roles_code?>">
	        	<input type="text" name="roles_name" id="roles_name" class="form-control" value="<?=$roles_name?>" placeholder="Roles name">
	       	</div>
	   </div>
	</div>
</div>
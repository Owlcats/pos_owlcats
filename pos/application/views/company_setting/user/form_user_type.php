<?php 
if ($type_code == "") {
	$type_code 		= $type_code;
	$type_name 		= "";
}else{
	$type_code 		= $get_user_type->type_code;
	$type_name 		= $get_user_type->type_name;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Type Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="type_code" id="type_code" class="form-control" value="<?=$type_code?>">
	        	<input type="text" name="type_name" id="type_name" class="form-control" value="<?=$type_name?>" placeholder="Type name">
	       	</div>
	   </div>
	</div>
</div>
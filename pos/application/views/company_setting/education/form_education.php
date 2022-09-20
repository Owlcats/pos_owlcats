<?php 
if ($id == "") {
	$id 				= $id;
	$education_code 	= "";
	$education_name 	= "";
	$readonly 			= "";
}else{
	$id 				= $get_education->id;
	$education_code 	= $get_education->education_code;
	$education_name 	= $get_education->education_name;
	$readonly 			= "readonly";
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Education Code</label>
	        <div class="col-md-12">
	        	<input type="text" name="education_code" id="education_code" class="form-control" value="<?=$education_code?>" placeholder="Education Code" <?=$readonly?>>
	        	<input type="hidden" name="id" id="id" class="form-control" value="<?=$id?>">
	       	</div>
	   	</div>
		<div class="form-group">
	        <label class="col-md-4 control-label">Education Name</label>
	        <div class="col-md-12">
	        	<input type="text" name="education_name" id="education_name" class="form-control" value="<?=$education_name?>" placeholder="Education Name">
	       	</div>
	   </div>
	</div>
</div>
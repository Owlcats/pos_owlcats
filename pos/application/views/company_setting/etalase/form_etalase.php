<?php 
if ($id == "") {
	$id 			= $id;
	$etalase_name 	= "";
}else{
	$id 			= $get_etalase->id;
	$etalase_name 	= $get_etalase->etalase_name;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Etalase Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="id" id="id" class="form-control" value="<?=$id?>">
	        	<input type="text" name="etalase_name" id="etalase_name" class="form-control" value="<?=$etalase_name?>" placeholder="Etalase Name">
	       	</div>
	   </div>
	</div>
</div>
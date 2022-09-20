<?php 
if ($id == "") {
	$id_type 		= $id;
	$menu_type 		= "";
	$controller 	= "";
}else{
	$id_type 		= $get_module_type->id;
	$menu_type 		= $get_module_type->menu_type;
	$controller 	= $get_module_type->controller;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Type Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="id" id="id" class="form-control" value="<?=$id_type?>">
	        	<input type="text" name="menu_type" id="menu_type" class="form-control" value="<?=$menu_type?>" placeholder="Type name">
	       	</div>
	   </div>
	   <div class="form-group">
	        <label class="col-md-4 control-label">Controllers</label>
	        <div class="col-md-12">
	        	<input type="text" name="controller" id="controller" class="form-control" value="<?=$controller?>" placeholder="Controller name">
	       	</div>
	   </div>
	</div>
</div>
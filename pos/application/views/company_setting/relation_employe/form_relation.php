<?php 
if ($relation_code == "") {
	$relation_code 	= $relation_code;
	$relation_name 	= "";
}else{
	$relation_code 	= $get_relation->relation_code;
	$relation_name 	= $get_relation->relation_name;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Relation Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="relation_code" id="relation_code" class="form-control" value="<?=$relation_code?>">
	        	<input type="text" name="relation_name" id="relation_name" class="form-control" value="<?=$relation_name?>" placeholder="Relation Name">
	       	</div>
	   </div>
	</div>
</div>
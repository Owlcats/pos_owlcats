<?php 
if ($menu_code == "") {
	$menu_code 		= $menu_code;
	$menu_name 		= "";
	$menu_type 		= "";
	$menu_level 	= "";
	$menu_parent 	= "";
	$link 			= "";
	$order_cells 	= "";
	$logo 			= "";
}else{
	$menu_code 		= $get_module->menu_code;
	$menu_name 		= $get_module->menu_name;
	$menu_type 		= $get_module->menu_type;
	$menu_level 	= $get_module->menu_level;
	$menu_parent 	= $get_module->menu_parent;
	$link 			= $get_module->link;
	$order_cells 	= $get_module->order_cells;
	$logo 		 	= $get_module->logo;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Menu Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="menu_code" id="menu_code" class="form-control" value="<?=$menu_code?>">
	        	<input type="text" name="menu_name" id="menu_name" class="form-control" value="<?=$menu_name?>" placeholder="Menu Name">
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Menu Parent</label>
	        <div class="col-md-12">
	        	<select class="form-control" id="menu_parent" name="menu_parent">
                    <option value="">Chose One</option>
                    <?php foreach ($get_module_parent as $row) {
                        if ($menu_parent==$row->menu_code) {
                            $select="selected";
                        }else{
                            $select="";
                        }
                        echo "<option $select value='$row->menu_code'>$row->menu_name</option>";
                    } ?>
                </select>
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Menu Type</label>
	        <div class="col-md-12">
	        	<select class="form-control" id="menu_type" name="menu_type">
                    <option value="">Chose One</option>
                    <?php foreach ($get_module_type as $row) {
                        if ($menu_type==$row->id) {
                            $select="selected";
                        }else{
                            $select="";
                        }
                        echo "<option $select value='$row->id'>$row->menu_type</option>";
                    } ?>
                </select>
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Menu Level</label>
	        <div class="col-md-12">
	        	<select class="form-control" id="menu_level" name="menu_level">
                    <option value="">Chose One</option>
                    <?php foreach ($get_company_type as $row) {
                        if ($menu_level==$row->company_type_code) {
                            $select="selected";
                        }else{
                            $select="";
                        }
                        echo "<option $select value='$row->company_type_code'>$row->company_type_name</option>";
                    } ?>
                </select>
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Menu Link</label>
	        <div class="col-md-12">
	        	<input type="text" name="link" id="link" class="form-control" value="<?=$link?>" placeholder="Function controller">
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Order Cells</label>
	        <div class="col-md-12">
	        	<input type="text" name="order_cells" id="order_cells" class="form-control" value="<?=$order_cells?>" placeholder="Order Cells">
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Logo</label>
	        <div class="col-md-12">
	        	<input type="text" name="logo" id="logo" class="form-control" value="<?=$logo?>" placeholder="Logo">
	       	</div>
	   	</div>
	</div>
</div>
<?php 
if ($id == "") {
	$company_code 		= $company_code;
	$social_media_code 	= "";
	$title 				= "";
	$link 				= "";
}else{
	$company_code 		= $get_social_media_company->company_code;
	$social_media_code 	= $get_social_media_company->social_media_code;
	$title 				= $get_social_media_company->title;
	$link 				= $get_social_media_company->link;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Menu Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="id" id="id" class="form-control" value="<?=$id?>">
	        	<input type="hidden" name="company_code" id="company_code" class="form-control" value="<?=$company_code?>">
	        	<select class="form-control" id="social_media_code" name="social_media_code">
                    <option value="">Chose One</option>
                    <?php foreach ($get_social_media as $row) {
                        if ($social_media_code == $row->social_media_code) {
                            $select="selected";
                        }else{
                            $select="";
                        }
                        echo "<option $select value='$row->social_media_code'>$row->social_media_name</option>";
                    } ?>
                </select>
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Social Media Title</label>
	        <div class="col-md-12">
	        	<input type="text" name="title" id="title" class="form-control" value="<?=$title?>" placeholder="Title">
	       	</div>
	   	</div>
	   	<div class="form-group">
	        <label class="col-md-4 control-label">Social Media Link</label>
	        <div class="col-md-12">
	        	<input type="text" name="link" id="link" class="form-control" value="<?=$link?>" placeholder="Link">
	       	</div>
	   	</div>
	</div>
</div>
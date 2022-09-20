<?php 
if ($social_media_code == "") {
	$social_media_code 	= $social_media_code;
	$social_media_name 	= "";
	$social_media_logo 	= "";
}else{
	$social_media_code 	= $get_social_media->social_media_code;
	$social_media_name 	= $get_social_media->social_media_name;
	$social_media_logo 	= $get_social_media->social_media_logo;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Social Media Name</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="social_media_code" id="social_media_code" class="form-control" value="<?=$social_media_code?>">
	        	<input type="text" name="social_media_name" id="social_media_name" class="form-control" value="<?=$social_media_name?>" placeholder="Social Media Name">
	       	</div>
	   </div>
	   <div class="form-group">
	        <label class="col-md-4 control-label">Logo</label>
	        <div class="col-md-12">
	        	<input type="text" name="social_media_logo" id="social_media_logo" class="form-control" value='<?=$social_media_logo?>' placeholder="Social Media Logo">
	       	</div>
	   </div>
	</div>
</div>
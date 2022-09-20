<?php 
if ($status_code == "") {
	$status_code 	= $status_code;
	$keterangan 	= "";
}else{
	$status_code 	= $get_status->status_code;
	$keterangan 	= $get_status->keterangan;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	        <label class="col-md-4 control-label">Keterangan</label>
	        <div class="col-md-12">
	        	<input type="hidden" name="status_code" id="status_code" class="form-control" value="<?=$status_code?>">
	        	<input type="text" name="keterangan" id="keterangan" class="form-control" value="<?=$keterangan?>" placeholder="Keterangan Status">
	       	</div>
	   </div>
	</div>
</div>
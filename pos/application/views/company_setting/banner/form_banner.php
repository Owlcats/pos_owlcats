<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="edit_picture">
			<div class="form-group">
		        <label class="col-md-4 control-label">picture</label>
		        <div class="col-md-12">
		        	<input type="hidden" name="company_code" id="company_code" class="form-control" value="<?=$company_code?>">
		        	<!-- <form enctype="multipart/form-data"> -->
				        <div class="file-loading">
				            <input id="input_pict" type="file" name="picture">
				        </div>
		       	</div>
		   </div>
		</form>
	</div>
</div>
<script>
    $(document).ready(function () {
        $("#input_pict").fileinput({
            'theme': 'explorer-fas'
        });
        $('.fileinput-upload-button').hide();
    });
</script>
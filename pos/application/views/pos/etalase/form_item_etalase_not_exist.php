<div class="col-md-12 content d-flex align-items-center justify-content-center" id="form_new_item">
	<div class="wrapper fadeInDown">
		<div id="formContent">
			<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_add_item">
				<input type="hidden" name="item_code" id="item_code" value="">
				<input type="hidden" name="id_etalase_company" id="id_etalase_company" value="<?=$id_etalase_company?>">
			  	<input type="text" name="item_name" id="item_name" class="text-form fadeIn second" placeholder="Nama item kamu" required="">
			  	<input type="number" name="item_stock" id="item_stock" class="text-form fadeIn second" placeholder="Stock item kamu" required="">
			  	<input type="text" name="sell_price" id="sell_price" class="text-form fadeIn second" placeholder="Harga jual untuk item ini" required="">
			  	<!-- <input type="file" name="item_picture" id="item_picture" class="text-form fadeIn second" placeholder="Gambar item kamu"> -->
			  	<div class="text-form fadeIn second">
			  		<img src="<?=base_url('assets/icons/icon_svg/polaroids.svg')?>" class="img-dash" id="upload-img">
			  		<br/><br/>
			  		<input type="file" name="picture" id="fileupload" class="file_upload">
			  		<label for="fileupload" class="btn btn-warning" id="upload-button"><i class="fas fa-upload"></i> UPLOAD</label>
			  	</div>
				<div id="formFooter">
				  	<a class="footer_form_etalase underlineHover" href="<?php echo base_url('pos/etalase')?>"> << </a>
				  	&nbsp;<span class="footer_form_etalase">|</span>&nbsp;
				  	<a class="footer_form_etalase underlineHover" onclick="save_form_item_etalase();"> >> </a>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#fileupload").change(function(event) {
			var x = URL.createObjectURL(event.target.files[0]);
			$("#upload-img").attr("src",x);
			console.log(event);
		});
	});
</script>
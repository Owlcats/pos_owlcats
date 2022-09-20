<div class="col-md-12 content d-flex align-items-center justify-content-center" id="form_new_item">
	<div class="wrapper fadeInDown">
		<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="form_add_item">
			<div id="form1" class="d-flex align-items-center justify-content-center" style="width: 100%;">
				<div id="formContent">
				  	<select class="fadeIn second select2_single" id="item_code" name="item_code" onchange="form_exist_value();">
	              		<option value="">Pilih salah satu item</option>
	                	<?php foreach ($get_item as $r): ?>
	                    	<option value="<?php echo $r->item_code ?>"><?php echo $r->item_name ?></option>
	                	<?php endforeach; ?>
	            	</select>
					<div id="formFooter">
					  	<a class="footer_form_etalase underlineHover" href="<?php echo base_url('pos/etalase')?>"> << </a>
					  	&nbsp;<span class="footer_form_etalase">|</span>&nbsp;
					  	<a class="footer_form_etalase underlineHover" onclick="next_1();"> >> </a>
					</div>
				</div>
			</div>
			<div id="form2" style="display: none; width: 100%;">
				<div id="formContent2">
					<input type="hidden" name="id_etalase_company" id="id_etalase_company" value="<?=$id_etalase_company?>">
				  	<input type="text" name="item_name" id="item_name" class="text-form fadeIn second" placeholder="Nama item kamu" required="">
				  	<input type="number" name="item_stock" id="item_stock" class="text-form fadeIn second" placeholder="Stock item kamu" required="">
				  	<input type="text" name="sell_price" id="sell_price" class="text-form fadeIn second" placeholder="Harga jual untuk item ini" required="">
				  	<div class="text-form fadeIn second">
				  		<img src="<?=base_url('assets/icons/icon_svg/polaroids.svg')?>" class="img-dash" id="upload-img">
				  		<br/><br/>
				  		<input type="file" name="picture" id="fileupload" class="file_upload">
				  		<label for="fileupload" class="btn btn-warning" id="upload-button" onchange="upload_item_image(event);"><i class="fas fa-upload"></i> UPLOAD</label>
				  	</div>
					<div id="formFooter2">
					  	<a class="footer_form_etalase underlineHover" onclick="prev_1();"> << </a>
					  	&nbsp;<span class="footer_form_etalase">|</span>&nbsp;
					  	<a class="footer_form_etalase underlineHover" onclick="save_form_item_etalase();"> >> </a>
					</div>
				</div>
			</div>
		</form>
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
	function next_1(){
		var item_code	= document.getElementById('item_code').value;

		if (item_code == '') {
			alert('Item harus dipilih salah satunya');
			return;
		}
		$('#form2').addClass('d-flex align-items-center justify-content-center');
		$('#form2').show();
		$('#form1').removeClass('d-flex align-items-center justify-content-center');
		$('#form1').hide();
	}

	function prev_1(){
		$('#form1').addClass('d-flex align-items-center justify-content-center');
		$('#form1').show();
		$('#form2').removeClass('d-flex align-items-center justify-content-center');
		$('#form2').hide();
	}
</script>
<div class="col-md-12 content d-flex align-items-center justify-content-center">
	<div class="wrapper fadeInDown">
		<div id="formContent">
			<form method="POST">
			  	<select class="fadeIn second select2_single" id="etalase_code" name="etalase_code">
              		<option value="">Pilih salah satu etalase</option>
                	<?php foreach ($get_etalase as $r): ?>
                    	<option value="<?php echo $r->etalase_code ?>"><?php echo $r->etalase_name ?></option>
                	<?php endforeach; ?>
            	</select>
			</form>
			<div id="formFooter">
			  	<a class="footer_form_etalase underlineHover" href="<?php echo base_url('pos/etalase')?>"> << </a>
			  	&nbsp;<span class="footer_form_etalase">|</span>&nbsp;
			  	<a class="footer_form_etalase underlineHover" onclick="save_form_etalase_company();"> >> </a>
			</div>

		</div>
	</div>
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>

<script type="text/javascript">
	function save_form_etalase_company() {
		var company_code = "<?=$company->company_code?>";
		var etalase_code = document.getElementById('etalase_code').value;

		if (etalase_code == "") {
			alert("Kamu harus memilih etalase untuk di tambahkan sebagai etalase kamu.");
			return;
		}

		var formData 	 = {
			'company_code' 	: company_code,
			'etalase_code'	: etalase_code
		}

		$.ajax({
            type    : 'POST',
            url     : "<?=base_url('pos/save_form_etalase_company');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
            	// console.log(data);
                obj = JSON.parse(data);
                if (obj.status == 'error') {
                	alert(obj.msg);
                }else{
                	window.location.href = "<?=base_url('pos/etalase');?>";
                }
            }
        });
	}
</script>
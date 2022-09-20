<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('_sitemaster/head'); ?>
		<link href="<?php echo base_url() ?>/assets/customize/css/login-regis.css" rel="stylesheet" type="text/css" />
	</head>
	<body class="login login-body">
		<?php
		    $alert_success = $this->session->flashdata('success');
		    if (isset($alert)) {
		        echo '<div class="alert alert-success">' . $alert . '</div>';
		         $this->session->unset_userdata('success');
		    }
		    $alert = $this->session->flashdata('error');
		    if (isset($alert)) {
		        echo '<div class="alert alert-danger">' . $alert . '</div>';
		         $this->session->unset_userdata('error');
		    }
		?>
		<form class="form-horizontal" method="POST" enctype="multipart/form-data" id="register">
			<div class="wrapper fadeInDown" id="register_1">
				<div id="formContent">
					<div class="fadeIn first">
					  	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png');?>" width="100" />
					</div>
						<div class="form-body">
						<div class="row">
							<div class="col-md-12">
							  	<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control text" name="company_name" id="company_name" placeholder="Nama Perusahaan">
									</div>
								</div>
								<div class="form-group">
				                  	<div class="col-md-12">
				                    	<select class="form-control text" id="provinsi_id" name="provinsi_id" onchange="get_kabupaten();">
				                      		<option value="">Pilih salah satu provinsi</option>
				                        	<?php foreach ($get_provinsi as $r): ?>
                                            	<option value="<?php echo $r->id ?>"><?php echo $r->nama ?></option>
                                        	<?php endforeach; ?>
				                    	</select>
				                  	</div>
				                </div>
				                <div class="form-group">
				                  	<div class="col-md-12">
				                    	<select class="form-control text" id="kabupaten_id" name="kabupaten_id" onchange="get_kecamatan();">
				                      		<option value="">Pilih salah satu kabupaten</option>
				                    	</select>
				                  	</div>
				                </div>
				                <div class="form-group">
				                  	<div class="col-md-12">
				                    	<select class="form-control text" id="kecamatan_id" name="kecamatan_id" onchange="get_kelurahan();">
				                      		<option value="">Pilih salah satu kecamatan</option>
				                    	</select>
				                  	</div>
				                </div>
				                <div class="form-group">
				                  	<div class="col-md-12">
				                    	<select class="form-control text" id="kelurahan_id" name="kelurahan_id">
				                      		<option value="">Pilih salah satu kelurahan</option>
				                    	</select>
				                  	</div>
				                </div>
				                <div class="form-group">
									<div class="col-md-12">
										<textarea class="form-control text" name="alamat" id="alamat" placeholder="Alamat Perusahaan"></textarea>
									</div>
								</div>
				                <div>&nbsp;</div>
						  	</div>
						</div>
					</div>
					<div id="formFooter">
						<a class="login-a underlineHover" href="<?=base_url('user/login')?>">< Back to Login</a>
					  	&nbsp;<span class="login-a">|</span>&nbsp;
					  	<a class="login-a underlineHover" onclick="next_1();">Next ></a>
					</div>
				</div>
			</div>
			<div class="wrapper fadeInDown" id="register_2">
				<div id="formContent">
					<div class="fadeIn first">
					  	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png');?>" width="100" />
					</div>
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
							  	<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control text" name="postal_code" id="postal_code" placeholder="Kode Pos">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control text" name="nomor_telpon" id="nomor_telpon" placeholder="Nomor Telpon (Optional)">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control text" name="nomor_handphone" id="nomor_handphone" placeholder="Nomor Handphone">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control text" name="email" id="email" placeholder="E-Mail">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input type="text" class="form-control text" name="fax" id="fax" placeholder="Fax (Optopnal)">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="formFooter">
					  	<a class="login-a underlineHover" onclick="prev_2();">< Prev</a>
					  	&nbsp;<span class="login-a">|</span>&nbsp;
					  	<a class="login-a underlineHover" onclick="next_2();">Next ></a>
					</div>
				</div>
			</div>
			<div class="wrapper fadeInDown" id="register_3">
				<div id="formContent">
					<div class="fadeIn first">
					  	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png');?>" width="100" />
					</div>
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
							  	<div class="form-group">
									<div class="col-md-12">
										<textarea class="form-control text" name="visi" id="visi" placeholder="Visi (Optional)"></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<textarea class="form-control text" name="misi" id="misi" placeholder="Misi (Optional)"></textarea>
									</div>
								</div>
								<br/>
								<div class="form-group">
									<div class="col-md-12">
										<label>Logo Perusahaan (Optional)</label>
										<input type="file" class="form-control text" name="picture" id="picture" style="color: #cccccc;">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="formFooter">
					  	<a class="login-a underlineHover" onclick="prev_3();">< Prev</a>
					  	&nbsp;<span class="login-a">|</span>&nbsp;
					  	<a class="login-a underlineHover" onclick="register();">Register ></a>
					</div>
				</div>
			</div>
		</form>
	</body>
	<?php $this->load->view('_sitemaster/foot'); ?>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#register_2').hide();
		$('#register_3').hide();
	});

	function next_1(){
		var company_name	= document.getElementById('company_name').value;
		var provinsi_id 	= document.getElementById('provinsi_id').value;
		var kabupaten_id 	= document.getElementById('kabupaten_id').value;
		var kecamatan_id 	= document.getElementById('kecamatan_id').value;
		var kelurahan_id 	= document.getElementById('kelurahan_id').value;
		var alamat 			= document.getElementById('alamat').value;
		if (company_name == '') {
			alert('Nama perusahaan harus di isi');
		} else
		if (provinsi_id == '') {
			alert('provinsi harus di isi');
		} else
		if (kabupaten_id == '') {
			alert('Kabupaten harus di isi');
		} else
		if (kecamatan_id == '') {
			alert('Kecamatan harus di isi');
		} else
		if (kelurahan_id == '') {
			alert('Kelurahan harus di isi');
		} else
		if (alamat == '') {
			alert('Alamat lengkap harus di isi');
		} else {
			$('#register_1').hide();
			$('#register_2').show();
		}
	}

	function prev_2(){
		$('#register_1').show();
		$('#register_2').hide();
	}
	function next_2(){
		var postal_code		= document.getElementById('postal_code').value;
		var nomor_handphone = document.getElementById('nomor_handphone').value;
		var email		 	= document.getElementById('email').value;
		if (postal_code == '') {
			alert('Kode pos harus di isi');
		} else
		if (nomor_handphone == '') {
			alert('Nomor hp harus di isi');
		} else
		if (email == '') {
			alert('E-Mail harus di isi');
		} else {
			$('#register_2').hide();
			$('#register_3').show();
		}
	}

	function prev_3(){
		$('#register_2').show();
		$('#register_3').hide();
	}

	function get_kabupaten(){
		var provinsi_id 	= document.getElementById('provinsi_id').value;

		var formData 		= {
			'provinsi_id' : provinsi_id
		};

		$.ajax({
            url : "<?php echo base_url('user/get_kabupaten');?>",
            method : "POST",
            data : formData,
            async : true,
            dataType : 'json',
            success: function(data){
	            if (provinsi_id == '0') {     
	                var html = '<option value="">Pilih salah satu kabupaten</option>';
	            }else{
	                var html = '<option value="">Pilih salah satu kabupaten</option>';
	                var i;
	                for(i=0; i<data.length; i++){
	                    html += '<option value='+data[i].id+'>'+data[i].nama+'</option>';
	                }
	            };
	            $('#kabupaten_id').html(html);
            }
        });
	}
	function get_kecamatan(){
		var kabupaten_id 	= document.getElementById('kabupaten_id').value;

		var formData 		= {
			'kabupaten_id' : kabupaten_id
		};

		$.ajax({
            url : "<?php echo base_url('user/get_kecamatan');?>",
            method : "POST",
            data : formData,
            async : true,
            dataType : 'json',
            success: function(data){
	            if (kabupaten_id == '0') {     
	                var html = '<option value="">Pilih salah satu kecamatan</option>';
	            }else{
	                var html = '<option value="">Pilih salah satu kecamatan</option>';
	                var i;
	                for(i=0; i<data.length; i++){
	                    html += '<option value='+data[i].id+'>'+data[i].nama+'</option>';
	                }
	            };
	            $('#kecamatan_id').html(html);
            }
        });
	}
	function get_kelurahan(){
		var kecamatan_id 	= document.getElementById('kecamatan_id').value;

		var formData 		= {
			'kecamatan_id' : kecamatan_id
		};

		$.ajax({
            url : "<?php echo base_url('user/get_kelurahan');?>",
            method : "POST",
            data : formData,
            async : true,
            dataType : 'json',
            success: function(data){
	            if (kecamatan_id == '0') {     
	                var html = '<option value="">Pilih salah satu kelurahan</option>';
	            }else{
	                var html = '<option value="">Pilih salah satu kelurahan</option>';
	                var i;
	                for(i=0; i<data.length; i++){
	                    html += '<option value='+data[i].id+'>'+data[i].nama+'</option>';
	                }
	            };
	            $('#kelurahan_id').html(html);
            }
        });
	}
	function register(){

		var form = $('#register')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?=base_url('user/proses_register');?>",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (res) {
            	var obj = JSON.parse(res);
            	if (obj.status == 'sukses') {
            		// alert("<?=base_url('user/send_verifikasi_link/')?>"+obj.random_code);
            		window.location.href = "<?=base_url('user/send_verifikasi_link/')?>"+obj.random_code;
            	}else{
            		alert(obj.msg);
            	}
            }
        });
	}

	// function register(){

	// 	var form = $('#register')[0];
 //        var data = new FormData(form);

 //        $.ajax({
 //            type: "POST",
 //            enctype: 'multipart/form-data',
 //            url: "<?=base_url('user/test');?>",
 //            data: data,
 //            processData: false,
 //            contentType: false,
 //            cache: false,
 //            timeout: 600000,
 //            success: function (res) {
 //            		window.location.href = window.location.href; 
 //            }
 //        });
	// }
</script>
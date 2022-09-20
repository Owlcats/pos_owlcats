<div class="custom_tab_owlcats_outer">
    <!-- <form method="POST" action="<?=base_url('company_setting/proses_edit_company')?>"> -->
    <form method="POST">
	    <div class="row">
	    	<div class="col-md-4">
	        	<div class="member_card_style">
	                <div class="row">
	                    <div class="col-md-12">
					       	<div class="form-group">
						        <label class="col-md-12 control-label">Nama Company</label>
						        <div class="col-md-12">
						        	<input type="hidden" name="company_code" id="company_code" class="form-control" value="<?=$company->company_code?>">
						        	<input type="text" name="company_name" id="company_name" class="form-control" value="<?=$company->company_name?>" placeholder="Company Name">
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Alamat</label>
						        <div class="col-md-12">
						        	<textarea name="alamat" id="alamat" class="form-control"><?=$company->alamat?></textarea>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Provinsi</label>
						        <div class="col-md-12">
						        	<select class="select2_single form-control" id="provinsi_id" name="provinsi_id" onchange="get_kabupaten();">
			                      		<option value="">Pilih salah satu provinsi</option>
			                        	<?php foreach ($get_provinsi as $r): 
			                        		if ($company->provinsi_id==$r->id) {
					                            $select="selected";
					                        }else{
					                            $select="";
					                        }
			                        	?>
	                                    	<option value="<?php echo $r->id ?>" <?=$select?>><?php echo $r->nama ?></option>
	                                	<?php endforeach; ?>
			                    	</select>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Kabupaten</label>
						        <div class="col-md-12">
						        	<select class="select2_single form-control" id="kabupaten_id" name="kabupaten_id" onchange="get_kecamatan();">
			                      		<option value="">Pilih salah satu provinsi telebih dahulu</option>
			                    	</select>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Kecamatan</label>
						        <div class="col-md-12">
						        	<select class="select2_single form-control" id="kecamatan_id" name="kecamatan_id" onchange="get_kelurahan();">
			                      		<option value="">Pilih salah satu kabupaten telebih dahulu</option>
			                    	</select>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Kelurahan</label>
						        <div class="col-md-12">
						        	<select class="select2_single form-control" id="kelurahan_id" name="kelurahan_id">
			                      		<option value="">Pilih salah satu kecamatan telebih dahulu</option>
			                    	</select>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Kode Pos</label>
						        <div class="col-md-12">
						        	<input type="text" name="postal_code" id="postal_code" class="form-control" value="<?=$company->postal_code?>" placeholder="Kode Pos"/>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Nomor Telpon</label>
						        <div class="col-md-12">
						        	<input type="text" name="nomor_telpon" id="nomor_telpon" class="form-control" value="<?=$company->nomor_telpon?>" placeholder="Nomer telpon"/>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Nomor Handphone</label>
						        <div class="col-md-12">
						        	<input type="text" name="nomor_handphone" id="nomor_handphone" class="form-control" value="<?=$company->nomor_handphone?>" placeholder="Nomer handphone"/>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">E-Mail</label>
						        <div class="col-md-12">
						        	<input type="text" name="email" id="email" class="form-control" value="<?=$company->email?>" placeholder="contoh@exp.com"/>
						       	</div>
						    </div>
						    <div>&nbsp;</div>
						    <div class="form-group">
						        <label class="col-md-12 control-label">Fax</label>
						        <div class="col-md-12">
						        	<input type="text" name="fax" id="fax" class="form-control" value="<?=$company->fax?>" placeholder="fax"/>
						       	</div>
						    </div>
					  	</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
	        	<div class="row">
	        		<div class="col-md-12">
			        	<div class="member_card_style">
			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="row">
			                    		<div class="text-center col-md-12">
									       	<span class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><h4>VISI</h4></span>
									  	</div>
									  	<div class="col-md-12">
									  		<textarea rows="10" id="summernote" name="visi" class="form-control"><?=$company->visi?></textarea>
									  	</div>
			                    	</div>
			                    </div>
			                </div>
			            </div>
		            </div>
		            <div class="col-md-12">
			        	<div class="member_card_style">
			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="row">
			                    		<div class="text-center col-md-12">
									       	<span class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><h4>MISI</h4></span>
									  	</div>
									  	<div class="col-md-12">
									  		<textarea rows="10" id="summernote2" name="misi" class="form-control"><?=$company->misi?></textarea>
									  	</div>
			                    	</div>
			                    </div>
			                </div>
			            </div>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-12">
	        	<div class="member_card_style">
	                <div class="row">
	                    <div class="col-md-12">
	                    	<div class="row">
	                    		<div class="text-center col-md-12">
							       	<span class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><h4>ABOUT</h4></span>
							  	</div>
							  	<div class="col-md-12">
							  		<textarea rows="10" id="summernote3" name="visi" class="form-control"><?=$company->about?></textarea>
							  	</div>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-12">
	        	<div class="member_card_style">
	                <div class="row">
	                    <div class="col-md-12">
	                    	<div class="row">
	                    		<div class="text-center col-md-12">
							       	<span class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><h4>Social Media</h4></span>
							  	</div>
							  	<div class="col-md-12">
							  		<div class="col-md-12">
								  		<div class="col-md-12">
								        	<button type="button" class="btn btn-secondary" onclick="add_form_social_media();"><i class="fas fa-plus"></i> Tambah</button>
								        </div>
							  		</div>
							  		<div class="col-md-12">
							  			<h6>Data yang akan di simpan</h6>
							  		</div>
							  		<hr/>
							  		<div class="col-md-12">
							  			<div class="row" id="IndexedDB">
							  			<!-- content -->
							  			</div>
							  		</div>
							  		<hr/>
							  		<div class="col-md-12">
							  			<h6>Data yang sudah ada</h6>
							  		</div>
							  		<hr/>
							  		<div class="col-md-12">
							  			<div class="row">
								  			<?php if ($social_media != ""){
								  				foreach ($social_media as $row) {
								  					if ($row->is_active == '1') { 
								                        $btn_active = '<button type="button" class="btn badge rounded-pill bg-success" id="'.$row->id.'" onclick="activated_social_media_company(this.id);">active</button>';
								                    }else{
								                        $btn_active = '<button type="button" class="btn badge rounded-pill bg-danger" id="'.$row->id.'" onclick="activated_social_media_company(this.id);">inactive</button>';
								                    }
								                    $btn_edit = '<button type="button" class="btn badge rounded-pill bg-warning" id="'.$row->id.'" onclick="edit_form_social_media(this.id);">edit</button>';
								  			?>
								  					<div class="col-md-3 text-center">
								  						<a href="<?=$row->link?>">
												  			<div class="col-md-12">
												  				<?=$row->social_media_logo?>
												  			</div>
												  			<div class="col-md-12">
												  				<?=$row->title?>
												  			</div>
											  			</a>
											  			<div class="col-md-12">
											  				<div class="row">
											  					<div class="col-md-6 text-center">
											  						<?=$btn_active?>
											  					</div>
											  					<div class="col-md-6 text-center">
											  						<?=$btn_edit?>
											  					</div>
											  				</div>
											  			</div>
										  			</div>
								  			<?php
								  				}
								  			}else{
								  				echo "No data.";
								  			} ?>
							  			</div>
							  		</div>
							  		<hr/>
							  	</div>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-12">
	        	<button type="button" class="col-md-12 btn btn-primary" onclick="proses();"><i class="fas fa-save"></i> Save</button>
	        </div>
		</div>
    </form>
</div>
<div class="modal fade" id="modal-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_form">Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	if (!window.indexedDB) {
	    alert("Your browser doesn't support a stable version of IndexedDB. Such and such feature will not be available.");
		window.location.href = "<?=base_url('company_setting/');?>";
	}else{
		console.log("Ok. IndexedDB.");
	}
	var request = window.indexedDB.open("SocialMediaCompanyOwlcats");
	request.onerror = function(event) {
	  	console.log("Why didn't you allow my web app to use IndexedDB?!");
	};
	request.onsuccess = function(event) {
	  	db = event.target.result;
	};
	request.onupgradeneeded = function(event) {
		var db = event.target.result;
		var objStore = db.createObjectStore("data_social_media", {keyPath: 'id', autoIncrement:true});
	};

	$(document).ready(function(){
		get_kabupaten();
		call_data_indexeddb();
	});

	function get_kabupaten(){
		var provinsi_id  = $('#provinsi_id').val();
		var kabupaten_id = "<?=$kabupaten_id?>";
		var formData     = {
            'provinsi_id' : provinsi_id,
            'kabupaten_id': kabupaten_id
        };

        $.ajax({
        	type	: 'POST',
        	url     : "<?=base_url('company_setting/get_kabupaten');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                	$('#kabupaten_id').empty();
                	$('#kabupaten_id').html(obj.msg);
                	get_kecamatan();
                }else{
                    alert(obj.msg);
                }
            }
        });
	}

	function get_kecamatan(){
		var kabupaten_id  = $('#kabupaten_id').val();
		var kecamatan_id = "<?=$kecamatan_id?>";
		var formData     = {
            'kabupaten_id' : kabupaten_id,
            'kecamatan_id': kecamatan_id
        };

        $.ajax({
        	type	: 'POST',
        	url     : "<?=base_url('company_setting/get_kecamatan');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                	$('#kecamatan_id').empty();
                	$('#kecamatan_id').html(obj.msg);
                	get_kelurahan();
                }else{
                    alert(obj.msg);
                }
            }
        });
	}

	function get_kelurahan(){
		var kecamatan_id  = $('#kecamatan_id').val();
		var kelurahan_id  = "<?=$kelurahan_id?>";
		var formData      = {
            'kecamatan_id' : kecamatan_id,
            'kelurahan_id': kelurahan_id
        };

        $.ajax({
        	type	: 'POST',
        	url     : "<?=base_url('company_setting/get_kelurahan');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                	$('#kelurahan_id').empty();
                	$('#kelurahan_id').html(obj.msg);
                }else{
                    alert(obj.msg);
                }
            }
        });
	}

	function add_form_social_media(){
		var id 							= "";
		var company_code 				= $('#company_code').val();

		var formData      = {
            'id' 						: id,
            'company_code'				: company_code
        };

        $.ajax({
        	type	: 'POST',
        	url     : "<?=base_url('company_setting/form_social_media_company');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                	$('.modal-title').empty();
                    $('.modal-title').html(obj.title);
                    $('.modal-body').empty();
                    $('.modal-body').html(obj.form);
                    $('#save_form').removeAttr('onclick');
                    $('#save_form').attr('onClick', 'save_form_social_media_company();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
	}

	function save_form_social_media_company(){
		var id 							= $('#id').val();;
		var company_code 				= $('#company_code').val();
		var social_media_code 			= $('#social_media_code').val();
		var title 						= $('#title').val();
		var link 						= $('#link').val();
		var create_date 				= "<?=date('Y-m-d H:i:s')?>";
		var create_user 				= "<?=$this->session->userdata('username')?>";

		if (company_code == "") {
			alert('Something went wrong');
			return;
		}

		if (social_media_code == "") {
			alert('Jenis sosial media harus di pilih.');
			return;
		}

		if (title == "") {
			alert('Judul / title harus di isi.');
			return;
		}

		if (link == "") {
			alert('Link sosial media harus di isi sesuai dengan link sebenarnya.');
			return;
		}

        if (id == "") {
			var formData      = {
	            'social_media_code'			: social_media_code,
	        };
	        $.ajax({
	        	type	: 'POST',
	        	url     : "<?=base_url('company_setting/get_index_social_media');?>",
	            data    : formData,
	            timeout : 60000, // 60 detik timeout
	            success : function (data) {
	                obj = JSON.parse(data);
	                if (obj.status == 'success') {
	                	// console.log(obj.msg);
	                	var transaction = db.transaction(["data_social_media"], "readwrite");
	                	var objectStore = transaction.objectStore("data_social_media");
			  			var store = {
			  				company_code : company_code,
			  				social_media_code : social_media_code,
			  				link : link,
			  				title : title,
			  				is_active : '1',
			  				create_date : create_date,
			  				create_user : create_user,
			  				social_media_logo : obj.msg
			  			};
	                	objectStore.add(store);
	                	call_data_indexeddb();
	                	$('#modal-form').modal('hide');
	                }else{
	                    alert(obj.msg);
	                }
	            }
	        });
        }else{
        	var formData      = {
        		'id'						: id,
	            'social_media_code'			: social_media_code,
	            'company_code'				: company_code,
	            'title' 					: title,
	            'link' 						: link,
	            'update_date' 				: create_date,
	            'update_user' 				: create_user
	        };
	        $.ajax({
	        	type	: 'POST',
	        	url     : "<?=base_url('company_setting/save_form_social_media_company');?>",
	            data    : formData,
	            timeout : 60000, // 60 detik timeout
	            success : function (data) {
	                obj = JSON.parse(data);
	                if (obj.status == 'success') {
	                	alert(obj.msg);
	                	window.location.href = window.location.href;
	                }else{
	                	alert(obj.msg);
	                }
	            }
	    	});
        }
	}
	function call_data_indexeddb(){
		var html 					= '';
		var request 				= window.indexedDB.open("SocialMediaCompanyOwlcats");
		request.onsuccess 			= function(event) {
		  	var db 					= event.target.result;
			var transaction 		= db.transaction(["data_social_media"]);
			var objectStore 		= transaction.objectStore("data_social_media");
			var request 			= objectStore.getAll();

			request.onsuccess 		= function(event) {
			  	var fore 			= event.target.result;
			  	if (fore != "") {
				  for (var i = 0; i < fore.length; i++) {
				  	html += "<div class='col-md-3 text-center'>";
					  	html += "<a href='"+fore[i].link+"'>"
					  		html += "<div class='col-md-12'>";
					  			html += fore[i].social_media_logo;
					  		html += "</div>";
					  		html += "<div class='col-md-12'>";
					  			html += fore[i].title;
					  		html += "</div>";
					  	html += "</a>";
					  	html += "<div class='col-md-12'>";
			  				html += "<button type='button' class='btn badge rounded-pill bg-danger' id='"+fore[i].id+"' onclick='deleteIndexedDb(this.id);'>delete</button>";
					  	html += "</div>";
				  	html += "</div>";
				  	}
			  	}else{
			  		html += "<div class='col-md-12'>";
			  			html += "<div class='row'>";
			  				html += "No data";
			  			html += "</div>";
			  		html += "</div>";
			  	}
			  	$('#IndexedDB').empty();
			  	$('#IndexedDB').html(html);
			  	$('.sosmed').addClass('fa-5x');
			};
		};
	}

	function deleteIndexedDb(id){
		var id 							= id;
		var request 					= window.indexedDB.open("SocialMediaCompanyOwlcats");
		request.onsuccess 				= function(event) {
		  	var db 						= event.target.result;
			var transaction 			= db.transaction(["data_social_media"], "readwrite")
            var objectStore 			= transaction.objectStore("data_social_media");
			var request 				= objectStore.delete(parseInt(id));

            request.onsuccess 			= function(event) {
			  	call_data_indexeddb();
			};
		};
	}

	function proses(){
		var company_code 				= $('#company_code').val();
		var company_name 				= $('#company_name').val();
		var alamat 						= $('#alamat').val();
		var provinsi_id 				= $('#provinsi_id').val();
		var kabupaten_id 				= $('#kabupaten_id').val();
		var kecamatan_id 				= $('#kecamatan_id').val();
		var kelurahan_id 				= $('#kelurahan_id').val();
		var postal_code 				= $('#postal_code').val();
		var nomor_telpon 				= $('#nomor_telpon').val();
		var nomor_handphone 			= $('#nomor_handphone').val();
		var email 						= $('#email').val();
		var fax 						= $('#fax').val();
		var visi 						= $('#summernote').val();
		var misi 						= $('#summernote2').val();
		var about 						= $('#summernote3').val();

		var request 					= window.indexedDB.open("SocialMediaCompanyOwlcats");
		request.onsuccess 				= function(event) {
		  	var db 						= event.target.result;
			var transaction 			= db.transaction(["data_social_media"]);
			var objectStore 			= transaction.objectStore("data_social_media");
			var request 				= objectStore.getAll();

			request.onsuccess 			= function(event) {
				var data_social_media 	= JSON.stringify(event.target.result);
				var formData 			= {
					'data_social_media' : data_social_media,
					'company_code' 		: company_code,
					'company_name' 		: company_name,
					'alamat' 			: alamat,
					'provinsi_id' 		: provinsi_id,
					'kabupaten_id' 		: kabupaten_id,
					'kecamatan_id' 		: kecamatan_id,
					'kelurahan_id' 		: kelurahan_id,
					'postal_code' 		: postal_code,
					'nomor_telpon' 		: nomor_telpon,
					'nomor_handphone' 	: nomor_handphone,
					'email' 			: email,
					'fax' 				: fax,
					'visi'				: visi,
					'misi'				: misi,
					'about'				: about
				}
				$.ajax({
		        	type	: 'POST',
		        	url     : "<?=base_url('company_setting/proses_edit_company');?>",
		            data    : formData,
		            timeout : 60000, // 60 detik timeout
		            success : function (data) {
		            	obj = JSON.parse(data);
                		if (obj.status == 'success') {
                			alert(obj.msg);
		            		var DBDeleteRequest = window.indexedDB.deleteDatabase("SocialMediaCompanyOwlcats");
		            		window.location.href = "<?=base_url('company_setting/')?>";
		            	}else{
		            		alert(obj.msg);
		            	}
		            }
		        });
			};
		};
	}
	function edit_form_social_media(id){
		var id 							= id;
		var company_code 				= $('#company_code').val();

		var formData      = {
            'id' 						: id,
            'company_code'				: company_code
        };

        $.ajax({
        	type	: 'POST',
        	url     : "<?=base_url('company_setting/form_social_media_company');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                	$('.modal-title').empty();
                    $('.modal-title').html(obj.title);
                    $('.modal-body').empty();
                    $('.modal-body').html(obj.form);
                    $('#save_form').removeAttr('onclick');
                    $('#save_form').attr('onClick', 'save_form_social_media_company();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
	}
	function activated_social_media_company(id){
        var id          = id;

        var formData    = {
            'id'         : id
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_social_media_company');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    alert(obj.msg);
                    window.location.href = window.location.href;
                }else{
                	alert(obj.msg);
                }
            }
        });
    }
</script>

<div class="custom_tab_owlcats_outer">
    <div class="row">
    	<div class="col-md-4">
        	<div class="member_card_style">
                <div class="row">
                    <div class="col-md-12">
                    	<div class="row">
                        	<div class="col-md-12 d-flex justify-content-center">
                        		<?php if ($is_company == '1') { ?>
	                        		<span class="position-absolute top-0 start-40 translate-middle badge bg-light text-dark" style="margin-top: 80px; margin-right: 100px; cursor: pointer;" id="<?=$company->company_code?>" onclick="edit_picture(this.id)">
	    								<i class="fas fa-edit"></i>
	    							</span>
                        		<?php } ?>
						  		<?php if ($company->picture == ""){ ?>
						        	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png');?>" alt="profile picture" class="img-fluid rounded-circle my-4 p-1 d-md-block shadow" style="width: 150px; height: 150px;"/>
						  		<?php }else{ ?>
						  			<img src="<?php echo base_url('assets/logo/company_logo/'.$company->picture);?>" alt="profile picture" class="img-fluid rounded-circle my-4 p-1 d-md-block shadow" style="width: 150px; height: 150px;"/>
						  		<?php } ?>
						  	</div>
                            <div class="text-center col-md-12">
						       	<span class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><h4><?=strtoupper($company->company_name)?></h4></span>
						  	</div>
						  	<div>&nbsp;</div>
						  	<div class="col-md-12">
						  		<div class="row">
							  		<div class="col-md-2">
							  			<i class="fas fa-map-marked-alt"></i>
							  		</div>
							       	<div class="col-md-9">
							       		<span>
							       			<h6><?=strtoupper($company->alamat)?>, <?=strtoupper($company->nama_kelurahan)?>, <?=strtoupper($company->nama_kecamatan)?>, <?=strtoupper($company->nama_kabupaten)?>, <?=strtoupper($company->nama_provinsi)?></h6>
							       		</span>
							       	</div>
							       	<div class="col-md-2">&nbsp;</div>
							       	<div class="col-md-9">
							       		<span>
							       			<h6>Kodepos : <?=strtoupper($company->postal_code)?></h6>
							       		</span>
							       	</div>
						       	</div>
						  	</div>
						  	<hr/>
						  	<div class="col-md-12">
						  		<div class="row">
							  		<div class="col-md-2">
							  			<i class="fas fa-mobile"></i>
							  		</div>
							       	<div class="col-md-9">
							       		<span>
							       			<h6><?=strtoupper($company->nomor_handphone)?></h6>
							       		</span>
							       	</div>
						       	</div>
						  	</div>
						  	<hr/>
						  	<?php if ($company->nomor_telpon != "") { ?>
							  	<div class="col-md-12">
							  		<div class="row">
								  		<div class="col-md-2">
								  			<i class="fas fa-phone-square-alt"></i>
								  		</div>
								       	<div class="col-md-9">
								       		<span>
								       			<h6><?=strtoupper($company->nomor_telpon)?></h6>
								       		</span>
								       	</div>
							       	</div>
							  	</div>
							  	<hr/>
						  	<?php } ?>
						  	<?php if ($company->fax != "") { ?>
							  	<div class="col-md-12">
							  		<div class="row">
								  		<div class="col-md-2">
								  			<i class="fas fa-fax"></i>
								  		</div>
								       	<div class="col-md-9">
								       		<span>
								       			<h6><?=strtoupper($company->fax)?></h6>
								       		</span>
								       	</div>
							       	</div>
							  	</div>
							  	<hr/>
						  	<?php } ?>
						  	<div class="col-md-12">
						  		<div class="row">
							  		<div class="col-md-2">
							  			<i class="fas fa-mail-bulk"></i>
							  		</div>
							       	<div class="col-md-10">
							       		<span>
							       			<h6><?=$company->email?></h6>
							       		</span>
							       	</div>
						       	</div>
						  	</div>
						  	<hr/>
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
								  		<?php echo ($company->visi == "")? 'VISI BELUM DI SETTING.' : $company->visi; ?>
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
								  		<?php echo ($company->misi == "")? 'MISI BELUM DI SETTING.' : $company->misi; ?>
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
						  		<?php echo ($company->about == "")? 'ABOUT BELUM DI SETTING.' : $company->about; ?>
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
						       	<span class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><h4>EMPLOYEE</h4></span>
						  	</div>
						  	<div>&nbsp;</div>
					       	<div class="col-md-12">
						       	<div class="overflow-scroll">
						       		<div class="row">
							       		<?php if ($get_employe != ""){
									  		foreach ($get_employe as $row) {
									  	?>
									  			<div class="col-md-3 text-center">
							  						<!-- <a href="<?=$row->link?>"> -->
										  			<div class="col-md-12">
										  				<img src="<?php echo base_url('assets/logo/employe/').$row->picture;?>" alt="profile picture" class="img-fluid rounded-circle my-4 p-1 d-md-block shadow" style="width: 150px; height: 150px;"/>
										  			</div>
										  			<div class="col-md-12">
										  				<?=$row->employe_name?>
										  			</div>
										  			<!-- </a> -->
										  		</div>
										<?php
											}
										}else{
											echo "Tidak ada data.";
										}
										?>
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
						       	<span class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><h4>SOCIAL MEDIA</h4></span>
						  	</div>
					       	<div>&nbsp;</div>
					       	<div class="col-md-12">
						       	<div class="overflow-scroll">
						       		<div class="row">
							       		<?php if ($get_social_media != ""){
									  		foreach ($get_social_media as $row) {
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
										  		</div>
										<?php
											}
										}else{
											echo "Tidak ada data.";
										}
										?>
									</div>
						       	</div>
						  	</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        	<?php if ($is_company == '1') { ?>
        		<a href="<?=base_url('company_setting/edit_company/'.$company->company_code)?>" class="col-md-12 btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        	<?php } ?>
        </div>
    </div>
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
    $(document).ready(function(){
		$('.sosmed').addClass('fa-5x');
	});
	function edit_picture(company_code){
        var company_code  = company_code;
        var formData    = {
            'company_code' : company_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_edit_picture');?>",
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
                    $('#save_form').attr('onClick', 'save_picture();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_picture(){
    	var form = $('#edit_picture')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?=base_url('company_setting/save_form_edit_picture');?>",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (res) {
            	var obj = JSON.parse(res);
            	if (obj.status == 'success') {
            		window.location.href = "<?=base_url('company_setting/')?>";
            	}else{
            		alert(obj.msg);
            	}
            }
        });
    }
</script>
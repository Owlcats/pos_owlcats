<?php
if (empty($get_etalase)) {
?>
	<div class="col-md-12 content d-flex align-items-center justify-content-center">
		<img src="<?=base_url('assets/icons/icon_svg/background/empty.svg')?>" width='300'>
	</div>
	<div class="col-md-12 content d-flex align-items-center justify-content-center">
		<span class="empty-text">
			<strong>
				Opss.. !! Kamu belum mengatur etalase, 
				<br/>
				klik <a href="<?=base_url('pos/form_etalase')?>">disini <i class="fas fa-hand-point-left"></i></a> 
				<br/>
				untuk mengatur etalase kamu segera...
			</strong>
		</span>
	</div>
<?php
}else{
?>
	<div class="col-md-12 content content_etalase">
<?php
	foreach ($get_etalase as $key => $r) {
?>
		<a id="<?=$r->id?>" onclick="show_item(this.id);">
			<div class="member_card_style">
				<div class="row row-dash">
					<div class="col_row_first">
						<div class="row">
							<div class="col_row_content_first d-flex align-items-center justify-content-center">
								<img src="<?=base_url('assets/icons/icon_svg/bookshelf.svg')?>" class="img-dash">
							</div>
							<div class="col_row_content_seccond d-flex align-items-center">
								<span class="text-title-dash"><strong><?=$r->etalase_name?></strong></span>
							</div>
						</div>
					</div>
					<div class="col_row_seccond d-flex justify-content-end">
						<div class="card d-flex align-items-center justify-content-center" style="width: 100px;border: 0;">
							<i class="fas fa-angle-double-down fa-3x"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
		<hr/>
		<div class="content_item" id="content_item_<?=$r->id?>"></div>
<?php
	}
?>
		<div>&nbsp;</div>
		<div class="col-md-12" style="margin: 0px 20px 0px 20px;">
	    		<a href="<?=base_url('pos/form_etalase')?>" class="col-md-12 btn btn-success btn_full"><i class="fas fa-plus"></i> Buat Etalase Baru</a>
	    </div>
	</div>
<?php
}
?>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>

<script type="text/javascript">
	function show_item(id){
		var id = id;

		formData = {
			'id' : id
		};

        var content = document.getElementById('content_item_etalase_'+id);
        if (typeof content === "undefined" || content == null) {
			$.ajax({
				type    : 'POST',
	            url     : "<?=base_url('pos/show_etalase_item');?>",
	            data    : formData,
	            timeout : 60000, // 60 detik timeout
	            success : function (data) {
	            	obj = JSON.parse(data);
	            	if (obj.status == 'success') {
	                    $('.content_item').empty();
	                    $('#content_item_'+id).html(obj.data);
	                }else{
	                    alert(obj.msg);
	                }
	            }
			});
        }else{
        	$('#content_item_'+id).empty();
        }
	}

	function detail(){
		alert('mohon maaf fitur ini belum tersedia.');
	}
</script>
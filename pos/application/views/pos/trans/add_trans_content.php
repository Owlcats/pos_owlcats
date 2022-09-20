<?php
if (empty($get_etalase_company)) {
?>
	<div class="col-md-12 content d-flex align-items-center justify-content-center">
		<img src="<?=base_url('assets/icons/icon_svg/background/empty.svg')?>" width='300'>
	</div>
	<div class="col-md-12 content d-flex align-items-center justify-content-center">
		<span class="empty-text">
			<strong>
				Opss.. !! Kamu belum mengatur etalase / item, 
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
<!-- <div onload="call_quantity_val();"> -->
	<?php
	foreach ($get_etalase_company as $row_etalase => $r_etalase) {
	?>
		<div>&nbsp;</div>
		<span class="badge rounded-pill bg-warning"><?=$r_etalase->etalase_name?></span>
		<div>&nbsp;</div>
		<div class="col-md-12 d-flex align-items-center justify-content-center">
			<div class="row">
				<?php
				foreach ($get_item as $row_item => $r_item) {
					if ($r_item->id_etalase_company == $r_etalase->id) {
				?>
						<div class="col">
							<!-- <?=$r_item->item_name?> -->
							<div class="card_item h-100 shadow-sm"> 
								<?php if ($r_item->picture == "") { ?>
			                		<img src="<?=base_url('assets/icons/icon_svg/polaroids.svg')?>" class="card-img-top" alt="...">
			                	<?php }else{ ?>
			                		<img src="<?=base_url('assets/icons/company_item_icon/'.$r_item->picture)?>" class="card-img-top" alt="...">
			                	<?php } ?>
			                    <div class="card-body">
			                        <div class="clearfix mb-3"> 
			                        	<span class="badge rounded-pill bg-primary"><?=$r_item->item_name?></span>
			                        	<br/>
			                        	<span class="price_item">Rp. <?=$r_item->sell_price?></span>
			                        	<br/>
			                        	<span class="price_item">Stok : <?=$r_item->stock?></span> 
			                        </div>
			                    </div>
			                    <div class="card-footer">
		                        	<div class="col d-flex align-items-center justify-content-center">
						          		<button type="button" class="btn btn-default btn-number" id="btn-minus_<?=$r_item->id?>" disabled="disabled" name="<?=$r_item->id?>" onclick="minus(this.name);">
							                  	<span><i class="fas fa-minus"></i></span>
							            </button>
										<span class="text-title-dash"><strong><span id="text_<?=$r_item->id?>" name="<?=$r_item->id?>">0</span></strong></span>
										<button type="button" class="btn btn-default btn-number" id="btn-plus_<?=$r_item->id?>" name="<?=$r_item->id?>" onclick="plus(this.name);">
							                  	<span><i class="fas fa-plus"></i></span>
							            </button>
									</div>
			                    </div>
			                </div>
							<span id="notif_<?=$r_item->id?>" style="color:red;"></span>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	<?php
	}
	?>
	<!-- </div> -->
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
	$(document).ready(function(){
		call_quantity_val();
	});
</script>
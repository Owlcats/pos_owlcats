<?php
if (empty($get_item)) {
?>
	<div class="col-md-12 content d-flex align-items-center justify-content-center" id="content_item_etalase_<?=$id_etalase_company?>">
		<img src="<?=base_url('assets/icons/icon_svg/background/empty.svg')?>" width='300'>
	</div>
	<div class="col-md-12 content d-flex align-items-center justify-content-center">
		<span class="empty-text">
			<strong>
				Opss.. !! Kamu belum mengatur Item, 
				<br/>
				klik <a href="<?=base_url('pos/form_item_etalase/'.$id_etalase_company)?>">disini <i class="fas fa-hand-point-left"></i></a> 
				<br/>
				untuk menambahkan item tanpa modal...
			</strong>
		</span>
	</div>
<?php
}else{
?>
	<div class="col-md-12 content" id="content_item_etalase_<?=$id_etalase_company?>">
		<div class="col-md-12">
	    	<a href="<?=base_url('pos/form_item_etalase/'.$id_etalase_company)?>" class="col-md-12 btn btn-success btn_full"><i class="fas fa-plus"></i> Buat Item Baru</a>
	    </div>
	    <div>&nbsp;</div>
	</div>
	<div class="col-md-12 d-flex align-items-center justify-content-center">
		<div class="row">
<?php
	foreach ($get_item as $key => $r) {
?>
        <div class="col">
            <div class="card_item h-100 shadow-sm"> 
            	<?php if ($r->picture == "") { ?>
            		<img src="<?=base_url('assets/icons/icon_svg/polaroids.svg')?>" class="card-img-top" alt="...">
            	<?php }else{ ?>
            		<img src="<?=base_url('assets/icons/company_item_icon/'.$r->picture)?>" class="card-img-top" alt="...">
            	<?php } ?>
                <div class="card-body">
                    <div class="clearfix mb-3"> 
                    	<span class="badge rounded-pill bg-primary"><?=$r->item_name?></span> 
                    	<br/>
                    	<span class="price_item">Rp. <?=$r->sell_price?></span>
                    	<br/>
                    	<span class="price_item">Stok : <?=$r->stock?></span> 
                    </div>
                    <div class="text-center my-4"> 
                    	<a class="btn_item btn-warning_item" onclick="detail();" style="cursor: pointer;">Detail</a>
                    </div>
                </div>
            </div>
        </div>
<?php
	}
?>
        </div>
	</div>
<?php
}
?>
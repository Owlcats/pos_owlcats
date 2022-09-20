<?php if (!$get_banner) { ?>

<div class="col-md-12">
	<div class="member_card_style">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12" id="list_data">
                        <b>Kamu tidak mempunyai data banner apaun di akun kamu.</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}else{
?>
<div class="row">
<?php
	foreach ($get_banner as $row) {	
?>
	<div class="col-md-4">
		<div class="member_card_style">
	        <div class="row">
	            <div class="col-md-12">
	                <div class="row">
	                    <div class="col-md-12 d-flex justify-content-center">
	                        <img src="<?=base_url('assets/banner/company_banner/').$row->picture?>" style="width: 200px; height: 100px;"/>
	                    </div>
	                    <div>&nbsp;</div>
	                    <div class="col-md-12 d-flex justify-content-center">
	                        BANNER-<?=$row->id?>
	                    </div>
	                    <!-- <div>&nbsp;</div>
	                    <div class="col-md-12 d-flex justify-content-center">
	                        <button class="btn badge rounded-pill bg-danger" id="'.$row->id.'" onclick="delete_list_data_banner(this.id);">delete</button>
	                    </div> -->
	                    <div>&nbsp;</div>
	                    <div class="col-md-12 d-flex justify-content-center">
	                    	<?php if($row->is_active == '1'){ ?>
	                        	<button class="btn badge rounded-pill bg-success" id="<?=$row->id?>" onclick="activated_banner(this.id);">active</button>
	                        <?php }else{ ?>
	                        	<button class="btn badge rounded-pill bg-danger" id="<?=$row->id?>" onclick="activated_banner(this.id);">non-active</button>
	                        <?php
	                        }
	                        ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php
	}
?>
</div>
<?php
}
?>
<div class="container-fluid header_owlcats">
	<div class="col-md-12 d-flex justify-content-center">
		<div class="member_card_style d-flex justify-content-center">
        	<?php if (!$get_picture_company) { ?>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
				  	<div class="carousel-indicators">
				    	<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				    	<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
				    	<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
				  	</div>
				  	<div class="carousel-inner">
				    	<div class="carousel-item active">
				      		<img src="<?=base_url('assets/banner/banner_first.jpg')?>" class="d-block banner">
				    	</div>
				    	<div class="carousel-item">
				      		<img src="<?=base_url('assets/banner/banner_second.jpg')?>" class="d-block banner">
				    	</div>
				    	<div class="carousel-item">
				      		<img src="<?=base_url('assets/banner/banner_third.jpg')?>" class="d-block banner">
				    	</div>
				  	</div>
				  	<!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
				    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    	<span class="visually-hidden">Previous</span>
				  	</button>
				  	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
				    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
				    	<span class="visually-hidden">Next</span>
				  	</button> -->
				</div>
			<?php }else{ ?>
				<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
				  	<div class="carousel-indicators">
				  		<?php foreach ($get_picture_company as $row_b) { ?>
				  			<?php if ($row_b->nomor == '1'){
				  				$active_b = 'active';
				  				$slide_to = $row_b->nomor - 1;
				  			}else{
				  				$active_b = '';
				  				$slide_to = $row_b->nomor - 1;
				  			} ?>
				  			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$slide_to?>" class="<?=$active_b?>" aria-current="true"></button>
				  		<?php } ?>
				  	</div>
				  	<div class="carousel-inner">
				  		<?php foreach ($get_picture_company as $row_p) { ?>
				  			<?php if ($row_p->nomor == '1'){
				  				$active_p = 'active';
				  			}else{
				  				$active_p = '';
				  			} ?>
				  			<div class="carousel-item <?=$active_p?>">
					      		<img src="<?=base_url('assets/banner/company_banner/').$row_p->picture?>" class="d-block banner">
					    	</div>
				  		<?php } ?>
				  	</div>
				  	<!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
				    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    	<span class="visually-hidden">Previous</span>
				  	</button>
				  	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
				    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
				    	<span class="visually-hidden">Next</span>
				  	</button> -->
				</div>
			<?php } ?>
	    </div>
	</div>
</div>
<div>&nbsp;</div>
<div class="container-fluid container_owlcats">
	<div class="col-md-12 main_content">
		<div class="row">
			<div class="col d-flex justify-content-center">
				<a href="<?=base_url('pos/')?>" class="link_home">
					<img src="<?=base_url('assets/icons/icon_svg/cashier_pos.svg')?>" width="90"/>
					<br/>
					<span class="link_text">POS</span>
				</a>
			</div>
		</div>
		<!-- <?php if ($is_company == '1'){ ?>
		<div class="col-md-12" style="margin: 20px 5px 5px 5px;">
			<div class="alert alert-warning alert-dismissible fade show col-md-12" role="alert">
			  Hallo <b><?=$company->company_name?></b>, akun kamu sekarang berada di tingkat <b><?=$company->company_type_name?></b>. Ayo upgrade akun mu sekarang dengan untuk menikmati lebih banyak fiture lainya dengan cara hubungi kontak service di teguh.fitrianto@owlcats.com .
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</div>
		<?php } ?> -->
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
		<div class="row">&nbsp;</div>
	</div>
</div>
<div class="container-fluid footer_owlcats">
	<div class="col-md-12 text-center">
		<!-- <div class="row">
			<div class="col-md-4">
				Credit by @owlcats
			</div>
		</div> -->
		<span class="link_text_foot">Credit by @owlcats</span>
	</div>
</div>
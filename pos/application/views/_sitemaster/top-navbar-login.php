<div class="nav_owlcats">
	<nav class="navbar navbar-light bg-light">
		<div class="container-fluid">
			<?php
			if ($company->picture=='') { ?>
			  	<a class="navbar-brand" href="<?= base_url() ?>">
			    	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png'); ?>" width="30" height="24" class="d-inline-block align-top" alt="">
			    	<img src="<?php echo base_url('assets/logo/logo-owlcats-text.png'); ?>" width="100" height="24" class="d-inline-block align-top" alt="">
			  	</a>
		  	<?php
			}else{
			?>
				<a class="navbar-brand" href="<?= base_url() ?>">
			    	<img src="<?php echo base_url('assets/logo/company_logo/');echo $company->picture ?>" width="30" height="24" class="d-inline-block align-top" alt="">
			  	</a>
			<?php
			}
			?>
	  		<div class="dropdown">
			    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
			      	<?=$company->company_name;?>
			    </button>
			    <ul class="dropdown-menu dropdown-menu-end">
			    	<li><a class="dropdown-item" href="<?=base_url('company_setting/');?>">Pengaturan</a></li>
			    	<div class="dropdown-divider"></div>
			    	<li><a class="dropdown-item" href="<?=base_url('user/do_logout/');?>">Log Out</a></li>
			    </ul>
			</div>
	  	</div>
	</nav>
</div>
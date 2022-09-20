<!-- QUERY -->
<?php

$relation_code 	= $this->session->userdata('relation_code');
$user_id 	 	= $this->session->userdata('user_id');
$roles_code 	= $this->session->userdata('roles_code');

$company 		= $this->db->select('company_code,company_type,company_name,picture')
							->from('owl_company')
							->where('company_code',$relation_code)
							->get()
							->row();

if ($company) {
	$company_type = $company->company_type;
	$company_name = $company->company_name;
	$company_pict = $company->picture;
}else{
	$employe 	  			= $this->db->select('company_code,employe_code')
										->from('owl_employe')
										->where('employe_code',$relation_code)
										->get()
										->row();

	$get_company_by_employe	= $this->db->select('company_code,company_type,company_name,picture')
										->from('owl_company')
										->where('company_code',$employe->company_code)
										->get()
										->row();

	$company_type = $get_company_by_employe->company_type;
	$company_name = $get_company_by_employe->company_name;
	$company_pict = $get_company_by_employe->picture;
}

if ($company_type == 'ADM') {
	$get_user_permision 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_user_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.user_id',$user_id)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	if (!$get_user_permision) {
		$get_menu 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_roles_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.roles_code',$roles_code)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	}else{
		$get_menu 			= $get_user_permision;
	}
}else if ($company_type == 'GLD') {
	$get_user_permision 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_user_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("GLD","SVR","BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.user_id',$user_id)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	if (!$get_user_permision) {
		$get_menu 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_roles_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("GLD","SVR","BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.roles_code',$roles_code)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	}else{
		$get_menu 			= $get_user_permision;
	}
}else if ($company_type == 'SVR') {
	$get_user_permision 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_user_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("SVR","BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.user_id',$user_id)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	if (!$get_user_permision) {
		$get_menu 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_roles_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("SVR","BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.roles_code',$roles_code)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	}else{
		$get_menu 			= $get_user_permision;
	}
}else{
	$get_user_permision 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_user_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.user_id',$user_id)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	if (!$get_user_permision) {
		$get_menu 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
										->from('owl_menu as a')
										->join('owl_roles_permision as b','a.menu_code=b.menu_code')
										->join('owl_menu_type as c','a.menu_type=c.id')
										->where('a.menu_level in ("BRZ")')
										->where('c.controller','company_setting')
										->where('c.is_active','1')
										->where('a.is_active','1')
										->where('b.roles_code',$roles_code)
										->where('b.is_views','1')
										->where('a.menu_parent','')
										->order_by('a.order_cells','ASC')
										->get()
										->result();
	}else{
		$get_menu 			= $get_user_permision;
	}
}

?>
<!-- END QUERY -->
<aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark flex-shrink-1">
	<nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row align-items-center py-2 text-center sticky-top " id="sidebar">
	  	<div class="text-center p-3">
	  		<?php if ($company_pict == ""){ ?>
	        	<img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png');?>" alt="profile picture" class="img-fluid rounded-circle my-4 p-1 d-none d-md-block shadow" style="width: 150px; height: 150px;"/>
	  		<?php }else{ ?>
	  			<img src="<?php echo base_url('assets/logo/company_logo/'.$company_pict);?>" alt="profile picture" class="img-fluid rounded-circle my-4 p-1 d-none d-md-block shadow" style="width: 150px; height: 150px;"/>
	  		<?php } ?>
	       	<a href="#" class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><?=strtoupper($company_name)?></a>
	  	</div>
	  	<button type="button" class="navbar-toggler border-0 order-1" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>	
	  	<div class="collapse navbar-collapse order-last sidebar" id="nav">
		    <ul class="navbar-nav flex-column w-100 justify-content-center">
	  			<div class="dropdown-divider"></div>
	  			<?php
	  				foreach ($get_menu as $row) {
	  					if ($row->link != "") {
	  						echo '<li class="nav-item">';
	  							echo '<a href="'.base_url($row->menu_link).'" class="nav-link" id="'.$row->menu_link.'"> '.$row->menu_name.' </a>';
	  						echo '</li>';
	  					}else{
	  						if ($company_type == 'ADM') {
								$get_user_permision_sub 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_user_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.user_id',$user_id)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								if (!$get_user_permision_sub) {
									$get_menu_sub 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_roles_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.roles_code',$roles_code)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								}else{
									$get_menu_sub 			= $get_user_permision_sub;
								}
							}else if ($company_type == 'GLD') {
								$get_user_permision_sub 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_user_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("GLD","SVR","BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.user_id',$user_id)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								if (!$get_user_permision_sub) {
									$get_menu_sub 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_roles_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("GLD","SVR","BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.roles_code',$roles_code)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								}else{
									$get_menu_sub 			= $get_user_permision_sub;
								}
							}else if ($company_type == 'SVR') {
								$get_user_permision_sub 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_user_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("SVR","BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.user_id',$user_id)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								if (!$get_user_permision_sub) {
									$get_menu_sub 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_roles_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("SVR","BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.roles_code',$roles_code)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								}else{
									$get_menu_sub 			= $get_user_permision_sub;
								}
							}else{
								$get_user_permision_sub 	= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_user_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.user_id',$user_id)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								if (!$get_user_permision_sub) {
									$get_menu_sub 			= $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
																	->from('owl_menu as a')
																	->join('owl_roles_permision as b','a.menu_code=b.menu_code')
																	->join('owl_menu_type as c','a.menu_type=c.id')
																	->where('a.menu_level in ("BRZ")')
																	->where('c.controller','company_setting')
																	->where('c.is_active','1')
																	->where('a.is_active','1')
																	->where('b.roles_code',$roles_code)
																	->where('b.is_views','1')
																	->where('a.menu_parent',$row->menu_code)
																	->order_by('a.order_cells','ASC')
																	->get()
																	->result();
								}else{
									$get_menu_sub 			= $get_user_permision_sub;
								}
							}
	  						echo '<li class="nav-item has-submenu">
		          					<a href="#" class="nav-link"> '.$row->menu_name.' </a>
	          						<ul class="submenu collapse">
	          							<div class="dropdown-divider"></div>';
	          						foreach ($get_menu_sub as $row) {
	          							echo '<li><a class="nav-link" href="'.base_url($row->menu_link).'">'.$row->menu_name.'</a></li>';
	          						}
	          				echo '		<div class="dropdown-divider"></div>
	          						</ul>
				        		</li>';
	  					}
	  				}
	  			?>
		  	</ul>
	  	</div>
	  	<ul class="nav justify-content-center">
	  		<li class="nav-item">
	  			<a href="<?php echo base_url();?>" class="nav-link text-white"><i class="fas fa-backward"></i></a>
	  		</li>
	  		<li class="nav-item">
	  			<a href="<?php echo base_url('user/do_logout');?>" class="nav-link text-white"><i class="fas fa-sign-out-alt"></i></a>
	  		</li>
	  	</ul>      
	</nav>   
</aside>
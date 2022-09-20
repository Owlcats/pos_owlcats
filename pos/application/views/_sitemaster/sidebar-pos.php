<?php

$relation_code  = $this->session->userdata('relation_code');
$user_id        = $this->session->userdata('user_id');
$roles_code     = $this->session->userdata('roles_code');

$company        = $this->db->select('company_code,company_type,company_name,picture')
                            ->from('owl_company')
                            ->where('company_code',$relation_code)
                            ->get()
                            ->row();

if ($company) {
    $company_type = $company->company_type;
    $company_name = $company->company_name;
    $company_pict = $company->picture;
}else{
    $employe                = $this->db->select('company_code,employe_code')
                                        ->from('owl_employe')
                                        ->where('employe_code',$relation_code)
                                        ->get()
                                        ->row();

    $get_company_by_employe = $this->db->select('company_code,company_type,company_name,picture')
                                        ->from('owl_company')
                                        ->where('company_code',$employe->company_code)
                                        ->get()
                                        ->row();

    $company_type = $get_company_by_employe->company_type;
    $company_name = $get_company_by_employe->company_name;
    $company_pict = $get_company_by_employe->picture;
}

if ($company_type == 'ADM') {
    $get_user_permision     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.user_id',$user_id)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    if (!$get_user_permision) {
        $get_menu           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.roles_code',$roles_code)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    }else{
        $get_menu           = $get_user_permision;
    }
}else if ($company_type == 'GLD') {
    $get_user_permision     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("GLD","SVR","BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.user_id',$user_id)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    if (!$get_user_permision) {
        $get_menu           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("GLD","SVR","BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.roles_code',$roles_code)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    }else{
        $get_menu           = $get_user_permision;
    }
}else if ($company_type == 'SVR') {
    $get_user_permision     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("SVR","BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.user_id',$user_id)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    if (!$get_user_permision) {
        $get_menu           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("SVR","BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.roles_code',$roles_code)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    }else{
        $get_menu           = $get_user_permision;
    }
}else{
    $get_user_permision     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.user_id',$user_id)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    if (!$get_user_permision) {
        $get_menu           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                        ->from('owl_menu as a')
                                        ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                        ->join('owl_menu_type as c','a.menu_type=c.id')
                                        ->where('a.menu_level in ("BRZ")')
                                        ->where('c.controller','pos')
                                        ->where('c.is_active','1')
                                        ->where('a.is_active','1')
                                        ->where('b.roles_code',$roles_code)
                                        ->where('b.is_views','1')
                                        ->where('a.menu_parent','')
                                        ->order_by('a.order_cells','ASC')
                                        ->get()
                                        ->result();
    }else{
        $get_menu           = $get_user_permision;
    }
}

?>
<!--========== HEADER ==========-->
<header class="header">
    <div class="header__container">
        <?php
        if ($company_pict=='') { ?>
            <img src="<?php echo base_url('assets/logo/logo-owlcats-pict.png'); ?>" alt="" class="header__img">
        <?php
        }else{
        ?>
            <img src="<?php echo base_url('assets/logo/company_logo/');echo $company_pict ?>" alt="" class="header__img">
        <?php
        }
        ?>
        <div class="header__toggle">
            <i class='fa fa-th-large' id="header-toggle"></i>
        </div>
    </div>
</header>

<!--========== NAV ==========-->
<div class="nav" id="navbar">
    <nav class="nav__container">
        <div>
            <a href="<?=base_url('pos/')?>" class="nav__link nav__logo">
                <i class="fas fa-compact-disc nav__icon"></i>
                <span class="nav__logo-name"><?=$company_name?></span>
            </a>

            <div class="nav__list">
                <div class="nav__items">
                    <h3 class="nav__subtitle">Menu</h3>
                    <?php 
                    foreach ($get_menu as $row) {
                        if ($row->link != "") {
                    ?>

                            <a href="<?=base_url($row->menu_link)?>" class="nav__link" id="<?=$row->menu_link?>">
                                <?=$row->logo?>
                                <span class="nav__name"><?=$row->menu_name?></span>
                            </a>
                    <?php 
                        }else{
                            if ($company_type == 'ADM') {
                                $get_user_permision_sub     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.user_id',$user_id)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                if (!$get_user_permision_sub) {
                                    $get_menu_sub           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("ADM","GLD","SVR","BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.roles_code',$roles_code)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                }else{
                                    $get_menu_sub           = $get_user_permision_sub;
                                }
                            }else if ($company_type == 'GLD') {
                                $get_user_permision_sub     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("GLD","SVR","BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.user_id',$user_id)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                if (!$get_user_permision_sub) {
                                    $get_menu_sub           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("GLD","SVR","BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.roles_code',$roles_code)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                }else{
                                    $get_menu_sub           = $get_user_permision_sub;
                                }
                            }else if ($company_type == 'SVR') {
                                $get_user_permision_sub     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("SVR","BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.user_id',$user_id)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                if (!$get_user_permision_sub) {
                                    $get_menu_sub           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("SVR","BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.roles_code',$roles_code)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                }else{
                                    $get_menu_sub           = $get_user_permision_sub;
                                }
                            }else{
                                $get_user_permision_sub     = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_user_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.user_id',$user_id)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                if (!$get_user_permision_sub) {
                                    $get_menu_sub           = $this->db->select('a.*,CONCAT(c.controller,a.link) as menu_link')
                                                                    ->from('owl_menu as a')
                                                                    ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                                                    ->join('owl_menu_type as c','a.menu_type=c.id')
                                                                    ->where('a.menu_level in ("BRZ")')
                                                                    ->where('c.controller','pos')
                                                                    ->where('c.is_active','1')
                                                                    ->where('a.is_active','1')
                                                                    ->where('b.roles_code',$roles_code)
                                                                    ->where('b.is_views','1')
                                                                    ->where('a.menu_parent',$row->menu_code)
                                                                    ->order_by('a.order_cells','ASC')
                                                                    ->get()
                                                                    ->result();
                                }else{
                                    $get_menu_sub           = $get_user_permision_sub;
                                }
                            }
                    ?>
                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <?=$row->logo?>
                                    <span class="nav__name">$row->menu_name</span>
                                    <i class='fas fa-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>
                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <?php foreach ($get_menu_sub as $row) { ?>
                                            <a href="<?=base_url($row->menu_link)?>" class="nav__dropdown-item" id="<?=$row->menu_link?>"><?=$row->menu_name?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                    <?php 
                        }
                    }  
                    ?>
                    <!-- <div class="nav__dropdown">
                        <a href="#" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>
                            <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                        </a>

                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <a href="#" class="nav__dropdown-item">Passwords</a>
                                <a href="#" class="nav__dropdown-item">Mail</a>
                                <a href="#" class="nav__dropdown-item">Accounts</a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="nav__link">
                        <i class='bx bx-message-rounded nav__icon' ></i>
                        <span class="nav__name">Messages</span>
                    </a> -->
                </div>
            </div>
        </div>

        <div class="nav__foot">
            <a href="<?php echo base_url();?>" class="nav__link nav__back">
                <i class="fas fa-backward nav__icon"></i>
                <span class="nav__name">Back to home</span>
            </a>
            <a href="<?php echo base_url('user/do_logout');?>" class="nav__link nav__logout">
                <i class="fas fa-sign-out-alt nav__icon"></i>
                <span class="nav__name">Log Out</span>
            </a>
        </div>
    </nav>
</div>
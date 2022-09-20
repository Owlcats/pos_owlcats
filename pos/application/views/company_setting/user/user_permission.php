<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Roles Permission</h2>
        </div>
        <div class="col-md-12" id="alert"><!-- alert --></div>
        <div class="col-md-12">
        	<div class="member_card_style">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <form method="POST" class="form-control" action="<?=base_url('company_setting/process_permission_user')?>">
                                <div class="col-md-12">
                                    <div class="col-md-12 d-flex flex-row border-bottom">
                                        <a href="<?=base_url('company_setting/user/2')?>" class="btn btn-secondary"><i class="fas fa-hand-point-left"></i></i> Kembali</a> &nbsp;
                                        <button type="submit" class="btn btn-success"><i class="fas fa-hdd"></i> Simpan</button>
                                    </div>
                                    <div>&nbsp;</div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="user_id" id="user_id" value="<?=$id?>">
                                        <?php 
                                            foreach ($get_menu_type as $row_type) {
                                        ?>
                                                <ul>
                                                    <li>
                                                       <?=$row_type->menu_type?>
                                        <?php 
                                                foreach ($get_menu_parent as $row_parent) {
                                                    if ($row_parent->is_views == '1') {
                                                        $checked    = 'checked';
                                                    }else{
                                                        $checked    = '';
                                                    }

                                                    if ($row_parent->menu_type == $row_type->id) {
                                                        
                                                        if ($row_parent->link != '') {
                                                            
                                        ?>
                                                            <ul>
                                                                <li>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="<?=$row_parent->menu_code?>" id="is_views" name="is_views[]" <?=$checked?>/>
                                                                        <label class="form-check-label" for="flexCheckDefault">
                                                                            <?=$row_parent->menu_name?>
                                                                        </label>
                                                                    </div>
                                                                </li> 
                                                            </ul>
                                        <?php
                                                        }else{
                                        ?>
                                                            <ul>
                                                                <li>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" value="<?=$row_parent->menu_code?>" id="is_views" name="is_views[]" <?=$checked?>/>
                                                                        <label class="form-check-label" for="flexCheckDefault">
                                                                            <?=$row_parent->menu_name?>
                                                                        </label>
                                                                    </div>
                                                                    <ul>
                                        <?php 
                                                                            foreach ($get_sub_menu as $row_sub) {

                                                                                if ($row_sub->is_views == '1') {
                                                                                    $checked    = 'checked';
                                                                                }else{
                                                                                    $checked    = '';
                                                                                }

                                                                                if ($row_sub->menu_parent == $row_parent->menu_code) {
                                        ?>
                                                                                    <li>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" value="<?=$row_sub->menu_code?>" id="is_views" name="is_views[]" <?=$checked?>/>
                                                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                                                <?=$row_sub->menu_name?>
                                                                                            </label>
                                                                                        </div>
                                                                                    </li>
                                        <?php                                            
                                                                                }
                                                                            }
                                        ?>
                                                                    </ul>
                                                                </li> 
                                                            </ul>
                                        <?php
                                                        }
                                                    }

                                                }
                                        ?>
                                                    </li>
                                                </ul>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <div>&nbsp;</div>
                                    <div class="col-md-12 d-flex flex-row-reverse border-top">
                                        <button type="submit" class="btn btn-success float-end"><i class="fas fa-hdd"></i> Simpan</button> &nbsp;
                                        <a href="<?=base_url('company_setting/user/2')?>" class="btn btn-secondary float-end"><i class="fas fa-hand-point-left"></i></i> Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
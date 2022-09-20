<div class="row">
    <div class="col-md-12">
        <button type="button" name="add_list_data_module_type" id="add_list_data_module_type" class="btn btn-primary" onclick="add_list_data_roles();"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>
    <div class="col-md-12">
        <table id='company_setting' class='table table-striped nowrap' style="width: 100%;">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Roles Name</th>
                    <th>User Create</th>
                    <th>Date Create</th>
                    <th>User Update</th>
                    <th>Date Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0; 
                    foreach ($get_roles as $row) {
                    if ($row->is_active == '1') { 
                        $btn_active = '<button class="btn badge rounded-pill bg-success" id="'.$row->roles_code.'" onclick="activated_roles(this.id);">active</button>';
                    }else{
                        $btn_active = '<button class="btn badge rounded-pill bg-danger" id="'.$row->roles_code.'" onclick="activated_roles(this.id);">inactive</button>';
                    }
                    $btn_edit = '<button class="btn badge rounded-pill bg-warning" id="'.$row->roles_code.'" onclick="edit_list_data_roles(this.id);">edit</button>';

                    $btn_permision = '<a href="'.base_url('company_setting/permission_roles/').$row->roles_code.'" class="btn badge rounded-pill bg-info">permision</a>';
                ?>
                    <tr>
                        <td><?=$btn_permision.' '.$btn_active.' '.$btn_edit?></td>
                        <td><?=$row->roles_name?></td>
                        <td><?=$row->create_user?></td>
                        <td><?=$row->create_date?></td>
                        <td><?=$row->update_user?></td>
                        <td><?=$row->last_update_date?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
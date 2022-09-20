<div class="row">
    <div class="col-md-12">
        <button type="button" name="add_list_data_module_type" id="add_list_data_module_type" class="btn btn-primary" onclick="add_list_data_module_type();"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>
    <div class="col-md-12">
        <table id="company_setting" class="table table-striped nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Module Type</th>
                    <th>Controllers</th>
                    <th>Create Date</th>
                    <th>User Create</th>
                    <th>Update Date</th>
                    <th>User Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0; 
                    foreach ($get_module_type as $row) {
                    if ($row->is_active == '1') { 
                        $btn_active = '<button class="btn badge rounded-pill bg-success" id="'.$row->id.'" onclick="activated_module_type(this.id);">active</button>';
                    }else{
                        $btn_active = '<button class="btn badge rounded-pill bg-danger" id="'.$row->id.'" onclick="activated_module_type(this.id);">inactive</button>';
                    }
                    $btn_edit = '<button class="btn badge rounded-pill bg-warning" id="'.$row->id.'" onclick="edit_list_data_module_type(this.id);">edit</button>';
                ?>
                    <tr>
                        <td><?=$btn_active.' '.$btn_edit?></td>
                        <td><?=$row->menu_type?></td>
                        <td><?=$row->controller?></td>
                        <td><?=$row->create_date?></td>
                        <td><?=$row->user_create?></td>
                        <td><?=$row->update_date?></td>
                        <td><?=$row->user_update?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
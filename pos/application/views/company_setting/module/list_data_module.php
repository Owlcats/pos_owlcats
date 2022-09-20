<div class="row">
    <div class="col-md-12">
        <button type="button" name="add_list_data_module_type" id="add_list_data_module_type" class="btn btn-primary" onclick="add_list_data_module();"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>
    <div class="col-md-12">
        <table id='company_setting' class='table table-striped nowrap'>
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Module Name</th>
                    <th>Module Type</th>
                    <th>Module Level</th>
                    <th>Module Parent</th>
                    <th>Module Link</th>
                    <th>Module Cells</th>
                    <th>Logo</th>
                    <th>Create Date</th>
                    <th>User Create</th>
                    <th>Update Date</th>
                    <th>User Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0; 
                    foreach ($get_module as $row) {
                    if ($row->is_active == '1') { 
                        $btn_active = '<button class="btn badge rounded-pill bg-success" id="'.$row->menu_code.'" onclick="activated_module(this.id);">active</button>';
                    }else{
                        $btn_active = '<button class="btn badge rounded-pill bg-danger" id="'.$row->menu_code.'" onclick="activated_module(this.id);">inactive</button>';
                    }
                    $btn_edit = '<button class="btn badge rounded-pill bg-warning" id="'.$row->menu_code.'" onclick="edit_list_data_module(this.id);">edit</button>';
                ?>
                    <tr>
                        <td><?=$btn_active.' '.$btn_edit?></td>
                        <td><?=$row->menu_name?></td>
                        <td><?=$row->menu_type_name?></td>
                        <td><?=$row->company_type_name?></td>
                        <td><?=$row->menu_parent?></td>
                        <td><?=$row->menu_link?></td>
                        <td><?=$row->order_cells?></td>
                        <td><?=$row->logo?></td>
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
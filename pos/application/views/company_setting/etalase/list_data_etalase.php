<div class="row">
    <div class="col-md-12">
        <button type="button" name="add_list_data_etalase" id="add_list_data_etalase" class="btn btn-primary" onclick="add_list_data_etalase();"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>
    <div class="col-md-12">
        <table id='company_setting' class='table table-striped nowrap' style="width: 100%;">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Etalase Name</th>
                    <th>User Create</th>
                    <th>Date Create</th>
                    <th>User Update</th>
                    <th>Date Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0; 
                    foreach ($get_etalase as $row) {
                    if ($row->is_active == '1') { 
                        $btn_active = '<button class="btn badge rounded-pill bg-success" id="'.$row->id.'">active</button>';
                    }else{
                        $btn_active = '<button class="btn badge rounded-pill bg-danger" id="'.$row->id.'">inactive</button>';
                    }
                    $btn_edit = '<button class="btn badge rounded-pill bg-warning" id="'.$row->id.'" onclick="edit_list_data_etalase(this.id);">edit</button>';
                ?>
                    <tr>
                        <td><?=$btn_active.' '.$btn_edit?></td>
                        <td><?=$row->etalase_name?></td>
                        <td><?=$row->create_date?></td>
                        <td><?=$row->create_user?></td>
                        <td><?=$row->update_date?></td>
                        <td><?=$row->update_user?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
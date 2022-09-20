<div class="row">
    <div class="col-md-12">
        <button type="button" name="add_list_data_module_type" id="add_list_data_social_media" class="btn btn-primary" onclick="add_list_data_social_media();"><i class="fas fa-plus"></i> Tambah Data</button>
    </div>
    <div class="col-md-12">
        <table id='company_setting' class='table table-striped nowrap' style="width: 100%;">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Social Media</th>
                    <th>Logo</th>
                    <th>User Create</th>
                    <th>Date Create</th>
                    <th>User Update</th>
                    <th>Date Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0; 
                    foreach ($get_social_media as $row) {
                    if ($row->is_active == '1') { 
                        $btn_active = '<button class="btn badge rounded-pill bg-success" id="'.$row->social_media_code.'" onclick="activated_social_media(this.id);">active</button>';
                    }else{
                        $btn_active = '<button class="btn badge rounded-pill bg-danger" id="'.$row->social_media_code.'" onclick="activated_social_media(this.id);">inactive</button>';
                    }
                    $btn_edit = '<button class="btn badge rounded-pill bg-warning" id="'.$row->social_media_code.'" onclick="edit_list_data_social_media(this.id);">edit</button>';
                ?>
                    <tr>
                        <td><?=$btn_active.' '.$btn_edit?></td>
                        <td><?=$row->social_media_name?></td>
                        <td><?=$row->social_media_logo?></td>
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
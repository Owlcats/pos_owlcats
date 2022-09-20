<div class="row">
    <div class="col-md-12">
        <table id="company_setting" class="table table-striped nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Username</th>
                    <th>Relation</th>
                    <th>Type</th>
                    <th>Roles</th>
                    <th>Last Login</th>
                    <th>Login Address</th>
                    <th>Create Date</th>
                    <th>User Create</th>
                    <th>Update Date</th>
                    <th>User Update</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 0; 
                    foreach ($get_user as $row) {
                    if ($row->is_active == '1') { 
                        $btn_active = '<button class="btn badge rounded-pill bg-success" id="'.$row->id.'" onclick="activated_user(this.id);">active</button>';
                    }else{
                        $btn_active = '<button class="btn badge rounded-pill bg-danger" id="'.$row->id.'" onclick="activated_user(this.id);">inactive</button>';
                    }

                    $btn_permision = '<a href="'.base_url('company_setting/permission_user/').$row->id.'" class="btn badge rounded-pill bg-info">permision</a>';
                ?>
                    <tr>
                        <td><?=$btn_active.' '.$btn_permision?></td>
                        <td><?=$row->username?></td>
                        <td><?=$row->relation_code?></td>
                        <td><?=$row->type_name?></td>
                        <td><?=$row->roles_name?></td>
                        <td><?=$row->last_login?></td>
                        <td><?=$row->alamat_login?></td>
                        <td><?=$row->create_date?></td>
                        <td><?=$row->create_user?></td>
                        <td><?=$row->last_update_date?></td>
                        <td><?=$row->update_user?></td>
                        <td><?=$row->keterangan_update?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
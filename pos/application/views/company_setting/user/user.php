<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Master User</h2>
        </div>
        <div class="col-md-12" id="alert"><!-- alert --></div>
        <div class="col-md-12">
            <ul class="nav nav-tabs custom_tab_owlcats" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav_user_type" data-bs-toggle="tab" type="button" role="tab" aria-selected="true" onclick="list_data_user_type();">User Type</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav_user" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" onclick="list_data_user();">User</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="module_type" role="tabpanel" aria-labelledby="module_type-tab">
                    <div class="member_card_style">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12" id="list_data">
                                        <!-- list data -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_form">Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.onload = function() {
        var link_type = "<?=$link_type?>";
        if (link_type == '1') {
            list_data_user_type();
        }else{
            $('#nav_user_type').removeClass('active');
            $('#nav_user').addClass('active');
            list_data_user();
        }
    }
    function list_data_user_type() {
        $.ajax({
            type    : 'GET',
            url     : "<?=base_url('company_setting/list_data_user_type');?>",
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('#list_data').empty();
                    $('#list_data').html(obj.data);
                    $('#company_setting').DataTable({
                        "destroy": true,
                        "scrollX": true
                    });
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function add_list_data_user_type(){
        var type_code   = "";
        var formData    = {
            'type_code' : type_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_user_type');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('.modal-title').empty();
                    $('.modal-title').html(obj.title);
                    $('.modal-body').empty();
                    $('.modal-body').html(obj.form);
                    $('#save_form').removeAttr('onclick');
                    $('#save_form').attr('onClick', 'save_form_user_type();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function edit_list_data_user_type(type_code){
        var type_code   = type_code;
        var formData    = {
            'type_code' : type_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_user_type');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('.modal-title').empty();
                    $('.modal-title').html(obj.title);
                    $('.modal-body').empty();
                    $('.modal-body').html(obj.form);
                    $('#save_form').removeAttr('onclick');
                    $('#save_form').attr('onClick', 'save_form_user_type();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_form_user_type(){
        var type_code   = document.getElementById('type_code').value;
        var type_name   = document.getElementById('type_name').value;

        if (type_name == '') {
            alert('Kolom nama tipe tidak boleh kosong')
            return;
        }

        var formData    = {
            'type_code'  : type_code,
            'type_name'  : type_name
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/save_form_user_type');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_user_type();
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-success" role="alert">'+obj.msg+'</div>');
                    $('#modal-form').modal('hide');
                }else{
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-danger" role="alert">'+obj.msg+'</div>');
                    $('#modal-form').modal('hide');
                }
            }
        });
    }
    function activated_user_type(type_code){
        var type_code          = type_code;

        var formData    = {
            'type_code'         : type_code
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_user_type');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_user_type();
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-success" role="alert">'+obj.msg+'</div>');
                }else{
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-danger" role="alert">'+obj.msg+'</div>');
                }
            }
        });
    }
    function list_data_user() {
        $.ajax({
            type    : 'GET',
            url     : "<?=base_url('company_setting/list_data_user');?>",
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('#list_data').empty();
                    $('#list_data').html(obj.data);
                    $('#company_setting').DataTable({
                        "destroy": true,
                        "scrollX": true
                    });
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function activated_user(id){
        var user_id          = id;

        var formData    = {
            'id'         : user_id
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_user');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_user();
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-success" role="alert">'+obj.msg+'</div>');
                }else{
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-danger" role="alert">'+obj.msg+'</div>');
                }
            }
        });
    }
</script>
<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Master Module</h2>
        </div>
        <div class="col-md-12" id="alert"><!-- alert --></div>
        <div class="col-md-12">
            <ul class="nav nav-tabs custom_tab_owlcats" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" type="button" role="tab" aria-selected="true" onclick="list_data_module_type();">Module Type</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" type="button" role="tab" aria-selected="false" onclick="list_data_module();">Module</button>
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
        list_data_module_type();
    }

    function list_data_module_type() {
        $.ajax({
            type    : 'GET',
            url     : "<?=base_url('company_setting/list_data_module_type');?>",
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
    function list_data_module() {
        $.ajax({
            type    : 'GET',
            url     : "<?=base_url('company_setting/list_data_module');?>",
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
    function add_list_data_module_type(){
        var id          = "";
        var formData    = {
            'id' : id
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_module_type');?>",
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
                    $('#save_form').attr('onClick', 'save_form_module_type();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function edit_list_data_module_type(id_type){
        var id          = id_type;
        var formData    = {
            'id' : id
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_module_type');?>",
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
                    $('#save_form').attr('onClick', 'save_form_module_type();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_form_module_type(){
        var id          = document.getElementById('id').value;
        var menu_type   = document.getElementById('menu_type').value;
        var controller  = document.getElementById('controller').value;

        if (menu_type == '') {
            alert('Kolom nama tipe tidak boleh kosong')
            return;
        }
        if (controller == '') {
            alert('Kolom controller tidak boleh kosong')
            return;
        }

        var formData    = {
            'id'         : id,
            'menu_type'  : menu_type,
            'controller' : controller
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/save_form_module_type');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_module_type();
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
    function activated_module_type(id_type){
        var id          = id_type;

        var formData    = {
            'id'         : id
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_module_type');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_module_type();
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-success" role="alert">'+obj.msg+'</div>');
                }else{
                    $('#alert').empty();
                    $('#alert').html('<div class="alert alert-danger" role="alert">'+obj.msg+'</div>');
                }
            }
        });
    }
    function add_list_data_module(){
        var menu_code   = "";
        var formData    = {
            'menu_code' : menu_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_module');?>",
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
                    $('#save_form').attr('onClick', 'save_form_module();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function edit_list_data_module(menu_code){
        var menu_code   = menu_code;
        var formData    = {
            'menu_code' : menu_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_module');?>",
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
                    $('#save_form').attr('onClick', 'save_form_module();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_form_module(){
        var menu_code   = document.getElementById('menu_code').value;
        var menu_name   = document.getElementById('menu_name').value;
        var menu_type   = document.getElementById('menu_type').value;
        var menu_level  = document.getElementById('menu_level').value;
        var menu_parent = document.getElementById('menu_parent').value;
        var link        = document.getElementById('link').value;
        var order_cells = document.getElementById('order_cells').value;
        var logo        = document.getElementById('logo').value;

        if (menu_name == '') {
            alert('Kolom nama menu tidak boleh kosong')
            return;
        }
        if (menu_type == '') {
            alert('Kolom tipe menu tidak boleh kosong')
            return;
        }
        if (menu_level == '') {
            alert('Kolom level menu tidak boleh kosong')
            return;
        }
        if (menu_parent != '') {
            if (link == '') {
            alert('Kolom link tidak boleh kosong, karna sudah memilih parent')
            return;
            }
        }

        var formData    = {
            'menu_code'  : menu_code,
            'menu_name'  : menu_name,
            'menu_type'  : menu_type,
            'menu_level' : menu_level,
            'menu_parent': menu_parent,
            'link'       : link,
            'order_cells': order_cells,
            'logo'       : logo
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/save_form_module');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_module();
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
    function activated_module(menu_code){
        var menu_code        = menu_code;

        var formData    = {
            'menu_code'      : menu_code
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_module');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_module();
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
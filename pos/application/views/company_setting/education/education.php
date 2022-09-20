<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Master Education</h2>
        </div>
        <div class="col-md-12" id="alert"><!-- alert --></div>
        <div class="col-md-12">
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
        list_data_education();
    }
    function list_data_education(){
        $.ajax({
            type    : 'GET',
            url     : "<?=base_url('company_setting/list_data_education');?>",
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
    function add_list_data_education(){
        var id  = "";
        var formData    = {
            'id' : id
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_education');?>",
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
                    $('#save_form').attr('onClick', 'save_form_education();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function edit_list_data_education(id){
        var id  = id;
        var formData    = {
            'id' : id
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_education');?>",
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
                    $('#save_form').attr('onClick', 'save_form_education();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_form_education(){
        var id              = document.getElementById('id').value;
        var education_code  = document.getElementById('education_code').value;
        var education_name  = document.getElementById('education_name').value;

        if (education_code == '') {
            alert('Kolom kode tidak boleh kosong')
            return;
        }

        if (education_name == '') {
            alert('Kolom nama tidak boleh kosong')
            return;
        }

        var formData    = {
            'id'             : id,
            'education_code' : education_code,
            'education_name' : education_name
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/save_form_education');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_education();
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
    function activated_education(id){
        var id          = id;

        var formData    = {
            'id'         : id
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_education');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_education();
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
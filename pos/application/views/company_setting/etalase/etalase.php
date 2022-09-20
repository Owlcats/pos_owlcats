<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Master Etalase</h2>
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
        list_data_etalase();
    }
    function list_data_etalase(){
        $.ajax({
            type    : 'GET',
            url     : "<?=base_url('company_setting/list_data_etalase');?>",
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
    function add_list_data_etalase(){
        var id  = "";
        var formData    = {
            'id' : id
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_etalase');?>",
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
                    $('#save_form').attr('onClick', 'save_form_etalase();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function edit_list_data_etalase(id){
        var id  = id;
        var formData    = {
            'id' : id
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_etalase');?>",
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
                    $('#save_form').attr('onClick', 'save_form_etalase();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_form_etalase(){
        var id              = document.getElementById('id').value;
        var etalase_name    = document.getElementById('etalase_name').value;

        if (etalase_name == '') {
            alert('Kolom nama tidak boleh kosong');
            return;
        }

        var formData    = {
            'id'             : id,
            'etalase_name' : etalase_name
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/save_form_etalase');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_etalase();
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
</script>
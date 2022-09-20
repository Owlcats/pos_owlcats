<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Master Banner</h2>
        </div>
        <div class="col-md-12" id="alert"><!-- alert --></div>
        <div class="col-md-12" id="list_data">
            <!-- list_data -->
        </div>
        <?php if ($is_company == '1') { ?>
            <div>&nbsp;</div>
            <div class="col-md-12">
                <button type="button" name="add_list_data_banner" id="add_list_data_banner" class="btn btn-primary col-md-12" onclick="add_list_data_banner();"><i class="fas fa-plus"></i> Tambah Data</button>
            </div>
        <?php } ?>
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
        list_data_banner();
    }
    function list_data_banner(){
        var company_code    = "<?=$company->company_code?>";

        formData = {
            'company_code' : company_code
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/list_data_banner');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    $('#list_data').empty();
                    $('#list_data').html(obj.data);
                }else{
                    alert(obj.msg);
                }
            }
        });

    }
    function add_list_data_banner(){
        var company_code    = "<?=$company->company_code?>";

        formData = {
            'company_code' : company_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_banner');?>",
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
                    $('#save_form').attr('onClick', 'save_form_banner();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_form_banner(){
        var form = $('#edit_picture')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?=base_url('company_setting/save_form_banner');?>",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (res) {
                var obj = JSON.parse(res);
                if (obj.status == 'success') {
                    list_data_banner();
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

    function activated_banner(id){
        var id          = id;

        var formData    = {
            'id'         : id
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_banner');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_banner();
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
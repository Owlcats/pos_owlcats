<div class="custom_tab_owlcats_outer">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="main_title">Master Social Media</h2>
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
        list_data_social_media();
    }
    function list_data_social_media(){
        $.ajax({
            type    : 'GET',
            url     : "<?=base_url('company_setting/list_data_social_media');?>",
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
    function add_list_data_social_media(){
        var social_media_code  = "";
        var formData    = {
            'social_media_code' : social_media_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_social_media');?>",
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
                    $('#save_form').attr('onClick', 'save_form_social_media();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function edit_list_data_social_media(social_media_code){
        var social_media_code  = social_media_code;
        var formData    = {
            'social_media_code' : social_media_code
        };
        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/form_social_media');?>",
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
                    $('#save_form').attr('onClick', 'save_form_social_media();');
                    $('#modal-form').modal('show');
                }else{
                    alert(obj.msg);
                }
            }
        });
    }
    function save_form_social_media(){
        var social_media_code  = document.getElementById('social_media_code').value;
        var social_media_name  = document.getElementById('social_media_name').value;
        var social_media_logo  = document.getElementById('social_media_logo').value;

        if (social_media_name == '') {
            alert('Kolom nama social media tidak boleh kosong')
            return;
        }

        if (social_media_logo == '') {
            alert('Kolom logo social media tidak boleh kosong')
            return;
        }

        var formData    = {
            'social_media_code' : social_media_code,
            'social_media_name' : social_media_name,
            'social_media_logo' : social_media_logo
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/save_form_social_media');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_social_media();
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
    function activated_social_media(social_media){
        var social_media_code          = social_media;

        var formData    = {
            'social_media_code'         : social_media
        };

        $.ajax({
            type    : 'POST',
            url     : "<?=base_url('company_setting/activated_social_media');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
                obj = JSON.parse(data);
                if (obj.status == 'success') {
                    list_data_social_media();
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
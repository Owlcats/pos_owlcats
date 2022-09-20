<div class="tab_custom">
	<input type="radio" class="tab_custom_radio" name="tab_custom_radio" id="tab_custom_radio1">
	<input type="radio" class="tab_custom_radio" name="tab_custom_radio" id="tab_custom_radio2">
	<!-- <input type="radio" class="tab_custom_radio" name="tab_custom_radio" id="tab_custom_radio3"> -->
	<label for="tab_custom_radio1" class="tab_custom_radio_text" id="tab_custom_radio_text1" onclick="show_form_not_exist();"><span class="tab_custom_radio_text_content">New Item</span></label>
  	<label for="tab_custom_radio2" class="tab_custom_radio_text" id="tab_custom_radio_text2" onclick="show_form_exist();"><span class="tab_custom_radio_text_content">Existing Item</span></label>
    <div class="tab_custom_circle"></div>
	  	<div class="tab_custom_content">
	    	<div class="tab_custom_bottom">
	      		<span class="tab_custom_indicator"></span>
	    	</div>
	  	</div>
	</div>
</div>
<div class="content_form_item">
	<!-- content -->
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>

<script>
	$(function(){
		show_form_not_exist();
		$("#tab_custom_radio1").prop('checked', true);
		$("#tab_custom_radio2").prop('checked', false);
	});

	function show_form_not_exist(){
		var type				= 'not exist';
		var id_etalase_company	= '<?=$get_by_id_etalase_company->id?>';

		var formData 			= {
			'type'				: type,
			'id_etalase_company': id_etalase_company
		};

		$.ajax({
            type    : 'POST',
            url     : "<?=base_url('pos/form_item_etalase_content');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
            	// console.log(data);
            	obj = JSON.parse(data);
            	if (obj.status == 'success') {
                    $('.content_form_item').empty();
                    $('.content_form_item').html(obj.data);
                }else{
                    alert(obj.msg);
                }
            }
        });
	};

	function show_form_exist(){
		var type				= 'exist';
		var id_etalase_company	= '<?=$get_by_id_etalase_company->id?>';

		var formData 			= {
			'type'				: type,
			'id_etalase_company': id_etalase_company
		};

		$.ajax({
            type    : 'POST',
            url     : "<?=base_url('pos/form_item_etalase_content');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
            	// console.log(data);
            	obj = JSON.parse(data);
            	if (obj.status == 'success') {
                    $('.content_form_item').empty();
                    $('.content_form_item').html(obj.data);
                    $('.select2_single').select2();
                }else{
                    alert(obj.msg);
                }
            }
        });
	};

	function save_form_item_etalase(){
		var item_name 	= document.getElementById('item_name').value;
		var stock 		= document.getElementById('item_stock').value;
		var harga 		= document.getElementById('sell_price').value;

		if (item_name == '') {
			alert('Nama item harus di isi.');
			return;
		};
		if (stock == '') {
			alert('Stock harus di isi minimum 0.');
			return;
		};
		if (harga == '') {
			alert('Harga jual harus di isi.');
			return;
		};

		var form = $('#form_add_item')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?=base_url('pos/save_form_item_etalase');?>",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (res) {
            	var obj = JSON.parse(res);
            	if (obj.status == 'success') {
            		window.location.href = "<?=base_url('pos/etalase')?>";
            	}else{
            		alert(obj.msg);
            	}
            }
        });
	};

	function form_exist_value(){
		var item_code = document.getElementById('item_code').value;

		var formData 			= {
			'item_code'				: item_code
		};

		$.ajax({
            type    : 'POST',
            url     : "<?=base_url('pos/form_exist_value');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
            	// console.log(data);
            	obj = JSON.parse(data);
            	if (obj.status == 'success') {
                    // alert(obj.msg);
                    $('#item_name').val(obj.item_name);
                    $('#item_stock').val(obj.stock);
                    $('#sell_price').val(obj.sell_price);
                    $('#upload-img').attr('src',"<?=base_url('assets/icons/company_item_icon/')?>"+obj.picture);
                }else{
                    alert(obj.msg);
                }
            }
        });
	};
</script>
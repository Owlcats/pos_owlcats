<div class="col-md-12">
	<!-- <a href="<?=base_url('pos/etalase/')?>"> -->
	<div class="member_card_style">
		<div class="row row-dash">
			<div class="col_row_first">
				<div class="row">
					<div class="col_row_content_first d-flex align-items-center justify-content-center">
						<img src="<?=base_url('assets/icons/icon_svg/piggybank-pig.svg')?>" class="img-dash">
					</div>
					<div class="col_row_content_seccond d-flex align-items-center">
						<span class="text-title-dash"><strong>CASH</strong></span>
					</div>
				</div>
			</div>
			<div class="col_row_seccond d-flex justify-content-end">
				<div class="card d-flex align-items-center justify-content-center" style="width: 100px;border: 0;">
					<i class="fas fa-angle-double-down fa-3x"></i>
				</div>
			</div>
		</div>
	</div>
	<!-- </a> -->
	<hr/>
	<div class="col-md-12">
		<div class="content_form_purchase_header header-pos">
			<div class="col-md-12 d-flex align-items-center justify-content-center">
				<img src="<?=base_url('assets/logo/company_logo/'.$company->picture)?>" class="img-dash">
			</div>
			<div class="col-md-12 d-flex align-items-center justify-content-center">
				<span class="text-title-dash"><strong><?=$company->company_name?></strong></span>
			</div>
		</div>
		<!-- <hr/> -->
		<div class="content_form_purchase header-pos" id="content_form_purchase">
			<!-- content -->
		</div>
		<div class="content_form_footer header-pos">
			<div class="row">
                <div class="col">
                    <div class="col-md-12">
                        <span class="text-title-head"><strong>Total Tagihan</strong></span>
                    </div>
                </div>
                <div class="col">
                	<div class="col-md-12 text-end">
                        <span class="text-title-head"><strong>Rp. <span id="summary_tagihan"></span></strong></span>
                    </div>
                </div>
            </div>
		</div>
		<div class="content_form_input header-pos d-flex align-items-center justify-content-center">
			<input type="number" name="nominal_pembayaran" id="nominal_pembayaran" class="text-form" placeholder="Nominal Bayar" value="" required="" oninput="hitung_kembalian();">
		</div>
		<div class="content_form_kembalian header-pos">
			<div class="row">
                <div class="col">
                    <div class="col-md-12">
                        <span class="text-title-head"><strong>Kembalian</strong></span>
                    </div>
                </div>
                <div class="col">
                	<div class="col-md-12 text-end">
                        <span class="text-title-head"><strong>Rp. <span id="summary_kembalian">0</span></strong></span>
                    </div>
                </div>
            </div>
		</div>
		<div class="content_button_end">
			<div class="col-md-12" onclick="lanjut();">
				<div class="member_card_style_idb d-flex align-items-center justify-content-center">
					<div class="row">
						<div class="col d-flex align-items-center justify-content-center">
							<span class="text-title-idb"><strong>Lanjut !</strong></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<script type="text/javascript">
	$(document).ready(function(){
		call_content_form_purchase();
	});

	function call_content_form_purchase(){
		var html 					= "";
		var sum_price 				= 0;
		var request 				= window.indexedDB.open("basket_<?=$company->company_code?>");
		request.onsuccess 			= function(event) {
		  	var db 					= event.target.result;
			var transaction 		= db.transaction(["data_basket"]);
			var objectStore 		= transaction.objectStore("data_basket");
			var request 			= objectStore.getAll();

			request.onsuccess 		= async function(event) {
				var data_val = event.target.result;
				if (data_val != "") {
				  	for (var i = 0; i < data_val.length; i++) {
				  		if (data_val[i].quantity != '0') {
					  		html += '<div class="row">';
						  		html += '<div class="col_row_content_first_purchase">'+data_val[i].item_name+'</div>';
						  		html += '<div class="col_row_content_seccond_purchase text-center">'+data_val[i].quantity+'x</div>';
						  		html += '<div class="col_row_content_tirth_purchase text-end">Rp. '+data_val[i].price+'</div>';
						  	html += '</div>';
				  		}
					  	sum_price += data_val[i].price;
				  	}
				}
				$('#content_form_purchase').html(html);
				$('#summary_tagihan').html(sum_price);
				hitung_kembalian();
			}
		}
	}

	function hitung_kembalian(){
		var pembayaran 	= document.getElementById('nominal_pembayaran').value;
		var total 		= document.getElementById('summary_tagihan').innerHTML;
		var kembalian 	= document.getElementById('summary_kembalian').innerHTML;

		if (pembayaran == '') {
			var kembalian_fin = '0';
		}else{
			var kembalian_fin = parseInt(pembayaran) - parseInt(total);
		}

		$('#summary_kembalian').empty();
		$('#summary_kembalian').html(kembalian_fin);
	}

	function lanjut(){
		var pembayaran 	= document.getElementById('nominal_pembayaran').value;
		var kembalian 	= document.getElementById('summary_kembalian').innerHTML;
		var tagihan 	= document.getElementById('summary_tagihan').innerHTML;

		if (kembalian < 0 || pembayaran == '') {
			alert('Nominal Pembayaran Kurang');
		}else{
			// alert('Sorry, fitur belum tersedia');
			// return;

			var request 				= window.indexedDB.open("basket_<?=$company->company_code?>");
			request.onsuccess 			= function(event) {
			  	var db 					= event.target.result;
				var transaction 		= db.transaction(["data_basket"]);
				var objectStore 		= transaction.objectStore("data_basket");
				var request 			= objectStore.getAll();

				request.onsuccess 		= async function(event) {
					var data_basket 	= JSON.stringify(event.target.result);
					var formData 			= {
						'data_basket' 		: data_basket,
						'pembayaran' 		: pembayaran,
						'kembalian' 		: kembalian,
						'tagihan' 			: tagihan
					};
					$.ajax({
			        	type	: 'POST',
			        	url     : "<?=base_url('pos/process_purchase');?>",
			            data    : formData,
			            timeout : 60000, // 60 detik timeout
			            success : function (data) {
			            	// console.log(data);
			            	obj = JSON.parse(data);
	                		if (obj.status == 'success') {
	                			// alert(obj.msg);
			            		var DBDeleteRequest = window.indexedDB.deleteDatabase("basket_<?=$company->company_code?>");
			            		window.location.href = "<?=base_url('pos/process_purchase_info/')?>"+obj.transaksi_code;
			            	}else{
			            		window.location.href = "<?=base_url('pos/process_purchase_info/')?>";
			            	}
			            }
			        });
				}
			}
		}
	}
</script>
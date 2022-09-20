<div class="col-md-12" id="content_checkout">
	<!-- content -->
	<div id="stock_24"></div>
</div>
<div>&nbsp;</div>
<div class="col-md-12" id="sum_price">
	<!-- content -->
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
		call_content_checkout();
		call_quantity_val();
	});

	async function get_stock(id){
		// alert(id);
		var stock;
  		var formData 	= {
  			'id' : id
  		};
		try {
	  		stock = await $.ajax({
	  			type    : 'POST',
	            url     : "<?=base_url('pos/add_data_basket');?>",
	            data    : formData,
	  		});
	  		return stock;
  		}catch (error) {
	        console.error(error);
	    }
	};

	function stock_db(res){
		obj = JSON.parse(res);
		var request 				= window.indexedDB.open("basket_<?=$company->company_code?>");
		request.onsuccess 			= function(event) {
		  	var db 					= event.target.result;
			var transaction 		= db.transaction(["data_basket"], "readwrite");
			var objectStore 		= transaction.objectStore("data_basket");
			var request 			= objectStore.get(obj.data.id);

			request.onsuccess 		= function(event) {
				var data_val = event.target.result;
				data_val.stock = parseInt(obj.data.stock);
		        objectStore.put(data_val);
			}
		}
		return obj.data.stock;
	}

	function call_content_checkout(){
		var html 					= "";
		var html_price 				= "";
		var html_button 			= "";
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
				  		var return_stock = await get_stock(data_val[i].id_item).then( (data) => stock_db(data));
				  		if (data_val[i].quantity != 0) {
				  			html += '<div class="member_card_style">';
					  			html += '<div class="row row-dash">';
									html += '<div class="col_row_first_checkout">';
										html += '<div class="row">';
											html += '<div class="col_row_content_first_checkout d-flex align-items-center justify-content-center">';
												html += '<img src="<?=base_url('')?>'+data_val[i].pict+'" class="img-dash">';
											html += '</div>';
											html += '<div class="col_row_content_seccond_checkout d-flex align-items-center">';
												html += '<span class="text-title-dash"><strong>'+data_val[i].item_name+'</strong><br/>Stock : <span id="stock_'+data_val[i].id_item+'">'+return_stock+'</span><br/> Harga : Rp. <span id="price_'+data_val[i].id_item+'">'+data_val[i].price+'</span></span>';
											html += '</div>';
										html += '</div>';
									html += '</div>';
									html += '<div class="col_row_seccond_checkout d-flex align-items-center justify-content-center">';
										html += '<div class="row">';
											html += '<div class="col d-flex align-items-center justify-content-center">';
												
												html += '<button type="button" class="btn btn-default btn-number" id="btn-minus_'+data_val[i].id_item+'" name="'+data_val[i].id_item+'" onclick="minus(this.name);"><span><i class="fas fa-minus"></i></span></button>';
												html += '<span class="text-title-dash"><strong><span  id="text_'+data_val[i].id_item+'" name="'+data_val[i].id_item+'">'+data_val[i].quantity+'</span></strong></span>';
												if (data_val[i].quantity >= return_stock) {
										  			html += '<button type="button" class="btn btn-default btn-number" id="btn-plus_'+data_val[i].id_item+'" name="'+data_val[i].id_item+'" onclick="plus(this.name);" disabled><span><i class="fas fa-plus"></i></span></button>';
										  		}else{
										  			html += '<button type="button" class="btn btn-default btn-number" id="btn-plus_'+data_val[i].id_item+'" name="'+data_val[i].id_item+'" onclick="plus(this.name);"><span><i class="fas fa-plus"></i></span></button>';
										  		}
												
											html += '</div>';
										html += '</div>';
									html += '</div>';
								html += '</div>';
					  		html += '</div>';
					  		if (data_val[i].quantity > return_stock) {
					  			html += '<span id="notif_'+data_val[i].id_item+'" style="color:red;">Jumlah stock tidak mencukupi</span>';
					  		}
				  		}
				  		if (data_val[i].quantity <= return_stock) {
				  			sum_price += data_val[i].price;
				  		}
				  	}
				}
				html_price += '<div class="sum-price">';
					html_price += '<div class="row">';
						html_price += '<div class="col-md-12 d-flex align-items-center justify-content-center">';
							html_price += '<span class="text-title-head"><strong>TOTAL PEMBAYARAN</strong></span>';
						html_price += '</div>';
						html_price += '<div>&nbsp;</div>';
						html_price += '<div class="col-md-12 d-flex align-items-center justify-content-center">';
							html_price += '<span class="text-title-head" id="sum_price_val"><strong>Rp. '+sum_price+'</strong></span>';
							html_price += '<input type="hidden" id="price_sell" name="price_sell" value="'+sum_price+'">'
						html_price += '</div>';
					html_price += '</div>';
				html_price += '</div>';

				html_button += '<div class="col-md-12" onclick="bayar();">';
					html_button += '<div class="member_card_style_idb d-flex align-items-center justify-content-center">';
						html_button += '<div class="row">';
							html_button += '<div class="col d-flex align-items-center justify-content-center">';
								html_button += '<span class="text-title-idb"><strong>Bayar !</strong></span>';
							html_button += '</div>';
						html_button += '</div>';
					html_button += '</div>';
				html_button += '</div>';

				$('#content_checkout').html(html);
				$('#sum_price').html(html_price);
				$('.plus').css('bottom','7.5rem');
				$('.keranjang').css('display','block');
				$('.keranjang').html(html_button);
			}
		}
	}

	function plus(id){
		var quantity 	= document.getElementById('text_'+id).innerHTML;

		update_summary_basket('+');

		add_data_basket('+',id,quantity);
	};

	function minus(id){
		var quantity 	= document.getElementById('text_'+id).innerHTML;
		
		update_summary_basket('-');

		add_data_basket('-',id,quantity);
	};

	function update_summary_basket(val){
		var request 		= window.indexedDB.open("basket_<?=$company->company_code?>");
		request.onsuccess 	= function(event) {
		  	var db 			= event.target.result;
		  	var transaction = db.transaction(["summary_basket"], "readwrite");
			var objectStore = transaction.objectStore("summary_basket");
			var request 	= objectStore.get(1);
			request.onerror = function(event) {
				alert('error update.');
			};
			request.onsuccess = function(event) {
			  	var data = event.target.result;
			  	if (val == '+') {
				  	data.quantity = parseInt(data.quantity)+1;
				  	objectStore.put(data);
				  	// call_data_basket();
			  	}else{
			  		data.quantity = parseInt(data.quantity)-1;
				  	objectStore.put(data);
				  	// call_data_basket();
			  	}
			};
		};
	};

	function add_data_basket(action,id,text_val){
		var quantity 	= text_val;
		var action 		= action;

		var formData	= {
			'id'	: id
		};

		$.ajax({
			type    : 'POST',
            url     : "<?=base_url('pos/add_data_basket');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
            	obj = JSON.parse(data);
            	if (obj.status == 'success') {
                   	// alert(obj.data.id);
                   	if (obj.data.picture == '') {
                   		var picture = 'assets/icons/icon_svg/polaroids.svg';
                   	}else{
                   		var picture = 'assets/icons/company_item_icon/'+obj.data.picture;
                   	}
                   	var request 				= window.indexedDB.open("basket_<?=$company->company_code?>");
					request.onsuccess 			= function(event) {
					  	var db 					= event.target.result;
						var transaction 		= db.transaction(["data_basket"]);
						var objectStore 		= transaction.objectStore("data_basket");
						var request 			= objectStore.get(obj.data.id);

						request.onsuccess 		= function(event) {
						  	var get_idb 		= event.target.result;

						  	// alert(get_idb);

						  	if (get_idb == undefined) {
						  		var transaction = db.transaction(["data_basket"], "readwrite");
			                	var objectStore = transaction.objectStore("data_basket");
					  			var store = {
					  				id_item : obj.data.id,
					  				item_code : obj.data.item_code,
					  				item_name : obj.data.item_name,
					  				pict : picture,
					  				quantity : parseInt(quantity)+1,
					  				price : parseInt(obj.data.sell_price)*(parseInt(quantity)+1),
					  				stock : parseInt(obj.data.stock),
					  				message : obj.msg
					  			};
			                	objectStore.add(store);
			       				// alert('aa')
						  	}else{
							  	// alert('bb');

					  			var transaction = db.transaction(["data_basket"], "readwrite");
		                		var objectStore = transaction.objectStore("data_basket");

		                		get_idb.stock = parseInt(obj.data.stock);
		                		objectStore.put(get_idb);

						  		if (action == '+') {
								  	get_idb.quantity 	= parseInt(get_idb.quantity)+1;
								  	get_idb.price 		= parseInt(obj.data.sell_price)*parseInt(get_idb.quantity);
								  	if (get_idb.quantity > get_idb.stock) {
								  		get_idb.quantity 	= parseInt(get_idb.quantity)-1;	
								  	}
								  	objectStore.put(get_idb);
							  	}else{
							  		get_idb.quantity 	= parseInt(get_idb.quantity)-1;
							  		get_idb.price 		= parseInt(obj.data.sell_price)*parseInt(get_idb.quantity);
								  	objectStore.put(get_idb);
							  	}
						  	}
						  	call_quantity_val();
						}
					}

                }else{
                    alert(obj.msg);
                }
            }
		});
	};

	function call_quantity_val(){
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

				  		var return_stock = await get_stock(data_val[i].id_item).then( (data) => stock_db(data));

				  		var id_btn1 = document.getElementById("btn-minus_"+data_val[i].id_item);
				  		var id_btn2 = document.getElementById("btn-plus_"+data_val[i].id_item);
						
						$("#text_"+data_val[i].id_item).html(data_val[i].quantity);
						// $("#qty_"+data_val[i].id_item).html(data_val[i].quantity);
						$("#price_"+data_val[i].id_item).html(data_val[i].price);
						
						
						// alert(return_stock);
							

						if (data_val[i].quantity <= 0) {
					  		if ((typeof id_btn1 == "undefined" || id_btn1 == null)) {

					  			// alert('bb');
					  			// return false;
					  		}else{
					  			// alert('aa');
								document.getElementById('btn-minus_'+data_val[i].id_item).disabled = true;
					  		}
						}else{
							if ((typeof id_btn1 == "undefined" || id_btn1 == null)) {

					  			// alert('bb');
					  			// return false;
					  		}else{
					  			// alert('aa');
								document.getElementById('btn-minus_'+data_val[i].id_item).disabled = false;
					  		}
						}

						if (data_val[i].quantity >= return_stock) {
							if ((typeof id_btn2 == "undefined" || id_btn2 == null)) {

					  			// alert('bb');
					  			// return false;
					  		}else{
					  			// alert('aa');
								document.getElementById('btn-plus_'+data_val[i].id_item).disabled = true;
					  		}
						}else{
							if ((typeof id_btn2 == "undefined" || id_btn2 == null)) {

					  			// alert('bb');
					  			// return false;
					  		}else{
					  			// alert('aa');
								document.getElementById('btn-plus_'+data_val[i].id_item).disabled = false;
					  		}
						}
						if (data_val[i].quantity <= return_stock) {
				  			sum_price += data_val[i].price;
				  			$('#notif_'+data_val[i].id_item).empty();
				  		}
				  	}
					$('#sum_price_val').empty();
					$('#sum_price_val').html('<strong>Rp. '+sum_price+'</strong>');
				}else{
					document.getElementsByName('quantity').value = 0;
					document.getElementById('btn-minus_'+data_val[i].id_item).disabled = true;
				}
			}
		}
	}

	function bayar(){
		window.location.href = "<?=base_url('pos/purchase');?>";
	}
</script>
<div class="header__search">
    <input type="search" id="search" placeholder="Search nama item" class="header__input">
    <i class='fa fa-search header__icon' onclick="search_item();"></i>
</div>
<div class="col-md-12 content_add_trans">
	<!-- content -->
</div>
<script type="text/javascript">
	if (!window.indexedDB) {
	    alert("Your browser doesn't support a stable version of IndexedDB. Such and such feature will not be available.");
		window.location.href = "<?=base_url('company_setting/');?>";
	}else{
		console.log("Ok. IndexedDB.");
	}

	var request = window.indexedDB.open("basket_<?=$company->company_code?>");
	request.onerror = function(event) {
	  	console.log("Why didn't you allow my web app to use IndexedDB?!");
	};
	request.onsuccess = function(event) {
	  	db = event.target.result;
	  	var db 					= event.target.result;
	};
	request.onupgradeneeded = function(event) {
		var db = event.target.result;
		var objStore_i = db.createObjectStore("summary_basket", {keyPath: 'id', autoIncrement:false});
		objStore_i.transaction.oncomplete = function(event) {
			var transaction = db.transaction(["summary_basket"], "readwrite");
			var objectStore = transaction.objectStore("summary_basket");
			var store = {
				id 			: 1,
				quantity	: 0
			};
			objectStore.add(store);
	  	};
	};

	var request = window.indexedDB.open("basket_<?=$company->company_code?>",2);
	request.onerror = function(event) {
	  	console.log("Why didn't you allow my web app to use IndexedDB?!");
	};
	request.onsuccess = function(event) {
	  	db = event.target.result;
	  	var db 					= event.target.result;
	};
	request.onupgradeneeded = function(event) {
		var db = event.target.result;
		var objStore_ii = db.createObjectStore("data_basket", {keyPath: 'id_item', unique: true});
		// objStore_ii.createIndex("id_item", "id_item", { unique: true });
	};

	// console.log(obj.msg);

	$(document).ready(function(){
		search_item();
		call_data_basket();
	});
	// call_quantity_val();

	function search_item(){
		var company_code 	= "<?=$company->company_code?>";
		var search 			= document.getElementById('search').value;
		
		var formData 		= {
			'company_code'	: company_code,
			'search' 		: search
		};

		$.ajax({
			type    : 'POST',
            url     : "<?=base_url('pos/show_content_add_trans');?>",
            data    : formData,
            timeout : 60000, // 60 detik timeout
            success : function (data) {
            	obj = JSON.parse(data);
            	if (obj.status == 'success') {
                    $('.content_add_trans').empty();
	                $('.content_add_trans').html(obj.data);
                }else{
                    alert(obj.msg);
                }
            }
		});
	};

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
				  	call_data_basket();
			  	}else{
			  		data.quantity = parseInt(data.quantity)-1;
				  	objectStore.put(data);
				  	call_data_basket();
			  	}
			};
		};
	};

	function call_data_basket(){
		var html 					= '';
		var request 				= window.indexedDB.open("basket_<?=$company->company_code?>");
		request.onsuccess 			= function(event) {
		  	var db 					= event.target.result;
			var transaction 		= db.transaction(["summary_basket"]);
			var objectStore 		= transaction.objectStore("summary_basket");
			var request 			= objectStore.get(1);

			request.onsuccess 		= function(event) {
				var data = event.target.result;

				if (data.quantity > 0) {
					// alert('data bisa di tampil');
					html += '<div class="col-md-12" onclick="checkout();">';
						html += '<div class="member_card_style_idb d-flex align-items-center justify-content-center">';
							html += '<div class="row">';
								html += '<div class="col_row_seccond d-flex align-items-center justify-content-end">';
									html += '<img src="<?=base_url('assets/icons/icon_svg/basket-idb.svg')?>" class="img-idb">';
								html += '</div>';
								html += '<div class="col_row_first d-flex align-items-center">';
									html += '<span class="text-title-idb"><strong>'+data.quantity+' belanjaan di keranjang !</strong></span>';
								html += '</div>';
							html += '</div>';
						html += '</div>';
					html += '</div>';
					$('.plus').css('bottom','7.5rem');
					$('.keranjang').css('display','block');
					$('.keranjang').html(html);
				} else {
					$('.plus').css('bottom','3.5rem');
					$('.keranjang').css('display','none');
					$('.keranjang').html('');
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
						
						// document.getElementById("text_"+data_val[i].id_item).innerHTML = data_val[i].quantity;
						$("#text_"+data_val[i].id_item).html(data_val[i].quantity);
						
						// if (data_val[i].quantity > return_stock) {
						// 	alert('data tidak mencukupi');
						// 	return;
						// }

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

				  	}
				}else{
					document.getElementsByName('quantity').value = 0;
					document.getElementById('btn-minus_'+data_val[i].id_item).disabled = true;
				}
			}
		}
	}

	function checkout(){
		window.location.href = "<?=base_url('pos/checkout')?>";
	}

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
</script>
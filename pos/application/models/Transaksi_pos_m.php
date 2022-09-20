<?php
    class Transaksi_pos_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'Company_m',
                'Employe_m',
                'Item_m',
                'Etalase_m'
            ));
        }

        public function get_summary_purchase($company_code){
        	$query = $this->db->select('sum(price_value) as sum_price_value')
        						->from('owl_pos_transaksi')
        						->where('company_code',$company_code)
        						->get()
        						->row();

        	if ($query) {
        		return $query;
        	}else{
        		return false;
        	}
        }

        public function get_by_id($type,$code){
        	$query = $this->db->select('*')
        						->from('owl_pos_transaksi')
        						->where($type,$code)
        						->get()
        						->row();

        	if ($query) {
        		return $query;
        	}else{
        		return false;
        	}
        }

        public function process_purchase(){
        	$this->db->trans_start();

        	$session_relation       = $this->session->userdata('relation_code');
        	$session_username		= $this->session->userdata('username');

        	$data_basket 			= $this->input->post('data_basket');
        	$tagihan 				= $this->input->post('tagihan');
        	$pembayaran 			= $this->input->post('pembayaran');
        	$kembalian 				= $this->input->post('kembalian');

        	$get_company            = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $company 			= $get_company;
            }else{
                  $employe          = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe  = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $company 			= $company_employe;
            }

            if (!$company) {
            	$result = array('status' => 'error', 'msg' => 'Terjadi kesalahan, harap coba lagi nanti atau hubungi teguh.fitrianto@owlcats.com.');
                return $result;
            }

            if ($data_basket != "") {
                $data_decode        = json_decode($data_basket);

                foreach ($data_decode as $key => $value) {
                    $v = (array)$value;
                    if ($v['quantity'] != '0') {
                    	
	                    $get_item 	= $this->Item_m->get_by_id_qty('item_code',$v['item_code'],$v['quantity']);

	                    if (!$get_item) {
	                    	$result = array('status' => 'error', 'msg' => 'Terjadi kesalahan ambil data item '.$v['item_name'].', harap coba lagi nanti atau hubungi teguh.fitrianto@owlcats.com.');
	                        return $result;
	                    }
	                }
	            }
	        }

        	$data_insert_transaksi 	= array(
        		'company_code'		=> $company->company_code,
        		'price_value'		=> $tagihan,
        		'payment_value'		=> $pembayaran,
        		'return_value'		=> $kembalian,
        		'create_date'		=> date('Y-m-d H:i:s'),
        		'create_user'		=> $session_username
        	);

        	$insert_transaksi = $this->db->insert('owl_pos_transaksi',$data_insert_transaksi);

        	if (!$insert_transaksi) {
        		$result = array('status' => 'error', 'msg' => 'Terjadi kesalahan update transaksi, harap coba lagi nanti atau hubungi teguh.fitrianto@owlcats.com.');
                return $result;
        	}

        	$last_id                = $this->db->insert_id();

            $transaksi_code         = $company->company_code.'-'.date('Y').'-'.date('m').'-'.sprintf("%08s", $last_id);

            $this->db->where('id', $last_id);
            $this->db->update('owl_pos_transaksi', array('transaksi_code' => $transaksi_code));

            if ($data_basket != "") {
                $data_decode        = json_decode($data_basket);

                foreach ($data_decode as $key => $value) {
                    $v = (array)$value;
                    if ($v['quantity'] != '0') {
                    	

                    	$data_insert_detail = array(
                    		'transaksi_code'	=> $transaksi_code,
                    		'item_code'			=> $v['item_code'],
                    		'price_value'		=> $v['price'],
                    		'quantity'			=> $v['quantity'],
                    		'create_date'		=> date('Y-m-d H:i:s'),
                    		'create_user'		=> $session_username
                    	);

                    	$insert_detail = $this->db->insert('owl_pos_transaksi_detail',$data_insert_detail);

	                    if (!$insert_detail) {
	                        $result = array('status' => 'error', 'msg' => 'Terjadi kesalahan update detail, harap coba lagi nanti atau hubungi teguh.fitrianto@owlcats.com.');
	                        return $result;
	                    }

	                    $get_item 			= $this->Item_m->get_by_id('item_code',$v['item_code']);

	                    $stock 				= $get_item->stock - $v['quantity'];

	                    $data_updt_item		= array(
	                    	'stock'			=> $stock,
	                    	'update_date'	=> date('Y-m-d H:i:s'),
                    		'update_user'	=> $session_username
	                    );

	                    $update_item 		= $this->Item_m->update('item_code',$get_item->item_code,$data_updt_item);

	                    if (!$update_item) {
	                        $result = array('status' => 'error', 'msg' => 'Terjadi kesalahan update item '.$get_item->item_name.', harap coba lagi nanti atau hubungi teguh.fitrianto@owlcats.com.');
	                        return $result;
	                    }
                    }
                    
                }
            }

        	$this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error', 'msg' => 'Gagal.');
                return $result;
            }else{
                $result = array('status' => 'success', 'msg' => 'Berhasil.', 'transaksi_code' => $transaksi_code);
                return $result;;
            }
        }
    }
?>
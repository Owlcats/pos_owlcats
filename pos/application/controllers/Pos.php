<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {
	public function __construct()
      {
		parent::__construct();
		if(!$this->session->userdata('isLogin')) redirect ('user/login');
		$this->load->model(array(
                  'Company_m',
                  'Employe_m',
                  'Etalase_m',
                  'Item_m',
                  'Transaksi_pos_m'
            ));
	}

      public function index(){
            $session_relation                         = $this->session->userdata('relation_code');

            $get_company                              = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $this->data['company']              = $company = $get_company;
            }else{
                  $employe                            = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe                    = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $this->data['company']              = $company = $company_employe;
            }

            $this->data['title']                = 'Dashboard';
            $this->data['sidebar']              = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);
            // $this->data['content']                 = $this->load->view('_sitemaster/under-construction',$this->data, TRUE);
            $this->data['content']              = $this->load->view('pos/dashboard/dashboard',$this->data, TRUE);
            $this->load->view('_sitemaster/home_pos',$this->data);
      }

      public function etalase(){
            $session_relation                         = $this->session->userdata('relation_code');

            $get_company                              = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $this->data['company']              = $company = $get_company;
            }else{
                  $employe                            = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe                    = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $this->data['company']              = $company = $company_employe;
            }

            $this->data['get_etalase']                = $this->Etalase_m->get_all_active_etalase_company($company->company_code);

            $this->data['title']                = 'Etalase';
            $this->data['sidebar']              = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);
            // $this->data['content']                 = $this->load->view('_sitemaster/under-construction',$this->data, TRUE);
            $this->data['content']              = $this->load->view('pos/etalase/etalase',$this->data, TRUE);
            $this->load->view('_sitemaster/home_pos',$this->data);
      }

      public function form_etalase(){
            $session_relation                         = $this->session->userdata('relation_code');

            $get_company                              = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $this->data['company']              = $company = $get_company;
            }else{
                  $employe                            = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe                    = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $this->data['company']              = $company = $company_employe;
            }

            $this->data['get_etalase']                = $this->Etalase_m->get_all_active($company->company_code);

            $this->data['title']                = 'Form Etalase';
            $this->data['sidebar']              = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);
            // $this->data['content']                 = $this->load->view('_sitemaster/under-construction',$this->data, TRUE);
            $this->data['content']              = $this->load->view('pos/etalase/form_etalase',$this->data, TRUE);
            $this->load->view('_sitemaster/home_pos',$this->data);
      }

      public function save_form_etalase_company(){
            $company_code                             = $this->input->post('company_code');
            $etalase_code                             = $this->input->post('etalase_code');

            $result                                   = $this->Etalase_m->save_form_etalase_company($company_code,$etalase_code);
            
            $this->session->set_flashdata($result['status'], $result['msg']);
            echo json_encode($result);
            die();
      }

      public function show_etalase_item(){
            $this->data['id_etalase_company']               = $id = $this->input->post('id');
            $this->data['get_item']                         = $this->Item_m->get_by_param(array('id_etalase_company' => $id));

            $content                                        = $this->load->view('pos/etalase/item_etalase',$this->data, TRUE);

            echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
            die();
      }

      public function form_item_etalase($id_etalase_company=''){

            if ($id_etalase_company == '') {
                  $this->session->set_flashdata('error', 'data etalase yang ingin di tambahkan item tidak di temukan');
                  redirect('pos/etalase');
                  die(); 
            }
            $get_etalase                        = $this->Etalase_m->get_by_id_etalase_company('id',$id_etalase_company);
            if (!$get_etalase) {
                  $this->session->set_flashdata('error', 'data etalase yang ingin di tambahkan item tidak di temukan');
                  redirect('pos/etalase');
                  die(); 
            }

            $this->data['get_by_id_etalase_company']  = $get_etalase;
            $this->data['title']                      = 'Form Item';
            $this->data['sidebar']                    = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);
            // $this->data['content']                 = $this->load->view('_sitemaster/under-construction',$this->data, TRUE);
            $this->data['content']                    = $this->load->view('pos/etalase/form_item_etalase',$this->data, TRUE);
            $this->load->view('_sitemaster/home_pos',$this->data);
      }

      public function form_item_etalase_content(){
            $type                               = $this->input->post('type');
            $id_etalase_company                 = $this->input->post('id_etalase_company');

            $this->data['type']                 = $type;
            $this->data['id_etalase_company']   = $id_etalase_company;

            if ($type == 'not exist') {
                  $content                = $this->load->view('pos/etalase/form_item_etalase_not_exist',$this->data, TRUE);
            }else{
                  $this->data['get_item'] = $this->Item_m->get_by_param(array('id_etalase_company' => $id_etalase_company, 'is_active' => '1'));
                  $content                = $this->load->view('pos/etalase/form_item_etalase_exist',$this->data, TRUE);
            }
            echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
            die();
      }

      public function save_form_item_etalase(){
            $result                 = $this->Item_m->save_form_item_etalase();
            $this->session->set_flashdata($result['status'], $result['msg']);
            echo json_encode($result);
            die();
      }

      public function form_exist_value(){
            $item_code              = $this->input->post('item_code');

            if ($item_code == '') {
                  echo json_encode(array('status' => 'error', 'msg' => 'Data yang ingin di rubah tidak di temukan2'));
                  die();
            }

            $get_item               = $this->Item_m->get_by_id('item_code',$item_code);

            if (!$get_item) {
                  echo json_encode(array('status' => 'error', 'msg' => 'Data yang ingin di rubah tidak di temukan'));
                  die();
            }

            echo json_encode(array('status' => 'success', 'msg' => 'berhasil', 'item_code' => $get_item->item_code, 'item_name' => $get_item->item_name, 'stock' => $get_item->stock, 'sell_price' => $get_item->sell_price, 'picture' => $get_item->picture));
            die();
      }

      public function add_trans(){
            $session_relation                         = $this->session->userdata('relation_code');

            $get_company                              = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $this->data['company']              = $company = $get_company;
            }else{
                  $employe                            = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe                    = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $this->data['company']              = $company = $company_employe;
            }

            $this->data['title']                = 'Add trans';
            $this->data['sidebar']              = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);
            $this->data['content']              = $this->load->view('pos/trans/add_trans',$this->data, TRUE);
            $this->load->view('_sitemaster/home_pos',$this->data);
      }

      public function show_content_add_trans(){
            $company_code                       = $this->input->post('company_code');
            $search                             = $this->input->post('search');
            
            $this->data['get_item']             = $this->Item_m->query_item_for_add_trans($search);

            $this->data['get_etalase_company']  = $this->Etalase_m->get_all_active_etalase_company($company_code);
            
            $content                            = $this->load->view('pos/trans/add_trans_content',$this->data, TRUE);

            echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
            die();
      }

      public function add_data_basket(){
            $id_item                            = $this->input->post('id');

            $get_item                           = $this->Item_m->get_by_id('id',$id_item);

            if (!$get_item) {
                  echo json_encode(array('status' => 'error', 'msg' => 'Data item tidak di temukan'));
                  die();
            }

            echo json_encode(array('status' => 'success', 'msg' => 'Data item di temukan', 'data' => $get_item));
            die();
      }

      public function checkout(){
            $session_relation       = $this->session->userdata('relation_code');

            $get_company            = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $this->data['company']              = $company = $get_company;
            }else{
                  $employe          = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe  = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $this->data['company']              = $company = $company_employe;
            }

            $this->data['title']                = 'Add trans';
            $this->data['sidebar']              = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);
            $this->data['content']              = $this->load->view('pos/trans/checkout',$this->data, TRUE);
            $this->load->view('_sitemaster/home_pos',$this->data);
      }

      public function purchase(){
            $session_relation       = $this->session->userdata('relation_code');

            $get_company            = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $this->data['company']              = $company = $get_company;
            }else{
                  $employe          = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe  = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $this->data['company']              = $company = $company_employe;
            }

            $this->data['title']                = 'Purchase trans';
            $this->data['sidebar']              = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);
            $this->data['content']              = $this->load->view('pos/trans/purchase',$this->data, TRUE);
            $this->load->view('_sitemaster/home_pos',$this->data);
      }

      public function process_purchase(){
            $result                 = $this->Transaksi_pos_m->process_purchase();

            echo json_encode($result);
            die();
      }

      public function process_purchase_info($transaksi_code=''){
            $session_relation       = $this->session->userdata('relation_code');

            $get_company            = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $this->data['company']              = $company = $get_company;
            }else{
                  $employe          = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe  = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $this->data['company']              = $company = $company_employe;
            }

            $this->data['title']                = 'Info trans';
            $this->data['sidebar']              = $this->load->view('_sitemaster/sidebar-pos',$this->data, TRUE);

            if ($transaksi_code != '') {
                  $this->data['get_transaksi']  = $this->Transaksi_pos_m->get_by_id('transaksi_code',$transaksi_code);
                  $this->data['content']        = $this->load->view('pos/trans/info_success',$this->data, TRUE);
            }else{
                  $this->data['content']        = $this->load->view('pos/trans/info_error',$this->data, TRUE);
            }

            $this->load->view('_sitemaster/home_pos',$this->data);
      }
}
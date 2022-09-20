<?php
    class Item_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'Employe_m',
                'Company_m',
                'Etalase_m'
            ));
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_pos_item')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_pos_item')
                                ->where('is_active','1')
                                ->order_by('id','DESC')
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_by_id($type,$code){
        	$query 	= $this->db->select('*')
        						->from('owl_pos_item')
        						->where($type,$code)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_by_id_qty($type,$code,$qty){
            $query  = $this->db->select('*')
                                ->from('owl_pos_item')
                                ->where($type,$code)
                                ->where('stock >= '.$qty)
                                ->get();
            $result = $query->row();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_by_param($param){
            $query  = $this->db->select('*')
                                ->from('owl_pos_item')
                                ->where($param)
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }
        
        public function insert($data_ins){
            $this->db->trans_start();
            
            $this->db->insert('owl_pos_item', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($type,$item_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $item_code);
            $this->db->update('owl_pos_item', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_item_etalase(){
            $this->db->trans_start();

            $item_code              = $this->input->post('item_code');
            $item_name              = $this->input->post('item_name');
            $item_stock             = $this->input->post('item_stock');
            $sell_price             = $this->input->post('sell_price');
            $id_etalase_company     = $this->input->post('id_etalase_company');

            $session_relation       = $this->session->userdata('relation_code');

            $get_company            = $this->Company_m->get_all_by_id('company_code',$session_relation);

            if ($get_company) {
                  $company          = $get_company;
            }else{
                  $employe          = $this->Employe_m->get_all_by_id('employe_code',$session_relation);
                  $company_employe  = $this->Company_m->get_all_by_id('company_code',$employe->company_code);
                  $company          = $company_employe;
            }

            $get_etalase_company    = $this->Etalase_m->get_by_params_etalase_company(array('id' => $id_etalase_company, 'company_code' => $company->company_code));

            if (!$get_etalase_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di update tidak di temukan.');
                return $result;
            }

            if ($item_code == '') {

                $data_ins                       = array(
                    'id_etalase_company'        => $get_etalase_company->id,
                    'item_name'                 => $item_name,
                    'stock'                     => $item_stock,
                    'sell_price'                => $sell_price,
                    'create_date'               => date('Y-m-d H:i:s'),
                    'create_user'               => $this->session->userdata('username'),
                    'is_active'                 => '1'
                );

                $insert                         = $this->insert($data_ins);

                if (!$insert) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert data item.');
                    return $result;
                }

                $insert_id                      = $this->db->insert_id();

                $this->load->library('image_lib');

                $config['upload_path']          = './assets/icons/company_item_icon/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['file_name']            = $company->company_code."-ITEM-".$insert_id;
                $config['overwrite']            = true;
                $config['max_size']             = 6144; // 3MB

                $this->load->library('upload', $config);

                $picture                        = $this->upload->do_upload('picture');

                if ($picture)
                {
                    $image_data                 =   $this->upload->data();

                    $configer                   =  array(
                        'image_library'   => 'gd2',
                        'source_image'    =>  $image_data['full_path'],
                        'maintain_ratio'  =>  TRUE,
                        'width'           =>  5841,
                        'height'          =>  1921,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                    $picture_inp = $this->upload->data("file_name");
                }else{
                    $picture_inp = "";
                }

                $char               = 'CT';
                $item_code_fin      = $char.sprintf("%03s", $insert_id);

                $data_updt              = array(
                    'item_code'            => $item_code_fin,
                    'picture'              => $picture_inp
                );

                $update = $this->update('id',$insert_id,$data_updt);
                if (!$update) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert data gambar item.');
                    return $result;
                }
            }else{
                $get_item   = $this->get_by_id('item_code',$item_code);
                if (!$get_item) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di update tidak di temukan.');
                    return $result;
                }

                $this->load->library('image_lib');

                $config['upload_path']          = './assets/icons/company_item_icon/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['file_name']            = $company->company_code."-ITEM-".$get_item->id;
                $config['overwrite']            = true;
                $config['max_size']             = 6144; // 3MB

                $this->load->library('upload', $config);

                $picture                        = $this->upload->do_upload('picture');

                if ($picture)
                {
                    $image_data                 =   $this->upload->data();

                    $configer                   =  array(
                        'image_library'   => 'gd2',
                        'source_image'    =>  $image_data['full_path'],
                        'maintain_ratio'  =>  TRUE,
                        'width'           =>  5841,
                        'height'          =>  1921,
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                    $picture_inp = $this->upload->data("file_name");
                }else{
                    $picture_inp = $get_item->picture;
                }

                $data_updt                       = array(
                    'item_name'                 => $item_name,
                    'stock'                     => $item_stock,
                    'sell_price'                => $sell_price,
                    'update_date'               => date('Y-m-d H:i:s'),
                    'update_user'               => $this->session->userdata('username'),
                    'picture'                   => $picture_inp
                );

                $update = $this->update('id',$get_item->id,$data_updt);
                if (!$update) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update item.');
                    return $result;
                }
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error', 'msg' => 'Gagal.');
                return $result;
            }else{
                $result = array('status' => 'success', 'msg' => 'Berhasil.');
                return $result;;
            }
        }

        public function query_item_for_add_trans($search){
            if ($search == "") {
                $query          = $this->db->query('
                        SELECT 
                            * 
                        FROM owl_pos_item 
                        WHERE 
                            is_active = "1"
                    ');
            }else{
                $query          = $this->db->query('
                        SELECT 
                            * 
                        FROM owl_pos_item 
                        WHERE 
                            is_active = "1"
                        AND
                            item_name like "%'.$search.'%"
                    ');
            }

            $result             = $query->result();

            if ($result) {
                return $result;
            }else{
                return FALSE;
            }
        }
    }
?>
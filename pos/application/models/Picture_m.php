<?php
    class Picture_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'Company_m'
            ));
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_company_picture')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_by_id($type,$code){
        	$query 	= $this->db->select('*')
        						->from('owl_company_picture')
        						->where($type,$code)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_by_params($params){
            $query  = $this->db->select('*')
                                ->from('owl_company_picture')
                                ->where($params)
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_for_banner($type,$code){
            $query  = $this->db->query('SELECT @no:=@no+1 nomor, owl_company_picture.* FROM owl_company_picture,(SELECT @no:= 0) AS no WHERE '.$type.' = "'.$code.'" and is_active="1"');

            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function insert($data_ins){
            $this->db->trans_start();
            
            $this->db->insert('owl_company_picture', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($type,$code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $code);
            $this->db->update('owl_company_picture', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function add_banner($company_code){
            $this->db->trans_start();

            $get_company                    = $this->Company_m->get_all_by_id('company_code',$company_code);
            if (!$get_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di update tidak di temukan.');
                return $result;
            }

            $data_ins                       = array(
                'company_code'              => $get_company->company_code,
                'create_date'               => date('Y-m-d H:i:s'),
                'create_user'               => $this->session->userdata('username'),
                'is_active'                 => '1'
            );

            $insert                         = $this->insert($data_ins);

            if (!$insert) {
                $result = array('status' => 'error', 'msg' => 'Gagal insert data banner.');
                return $result;
            }

            $insert_id                      = $this->db->insert_id();

            $this->load->library('image_lib');

            $config['upload_path']          = './assets/banner/company_banner/';
            $config['allowed_types']        = 'jpg|png';
            $config['file_name']            = "BANNER-".$get_company->company_code."-".$insert_id;
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

            $data_updt_banner              = array(
                'picture'              => $picture_inp
            );

            $this->db->where('id', $insert_id);
            $this->db->update('owl_company_picture', $data_updt_banner);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error', 'msg' => 'Gagal.');
                return $result;
            }else{
                $result = array('status' => 'success', 'msg' => 'Berhasil.');
                return $result;;
            }
        }

        public function activated($id){
            $this->db->trans_start();

            $get_banner = $this->get_by_id('id',$id);

            if (!$get_banner) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                return $result;
            }

            if ($get_banner->is_active == '1') {

                $data_updt_banner                 = array(
                    'is_active'             => '0',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }else{
                $data_updt_banner                 = array(
                    'is_active'             => '1',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }

            $update_banner                  = $this->update('id',$get_banner->id,$data_updt_banner);

            if (!$update_banner) {
                $result = array('status' => 'error', 'msg' => 'Gagal update banner.');
                return $result;
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error', 'msg' => 'Gagal.');
                return $result;
            }else{
                $result = array('status' => 'success', 'msg' => 'Berhasil.');
                return $result;
            }
        }
    }
?>
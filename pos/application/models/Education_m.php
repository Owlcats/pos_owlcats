<?php
    class Education_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'Employe_m',
                'Company_m'
            ));
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_education')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_education')
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
        						->from('owl_education')
        						->where($type,$code)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }
        public function get_education_employe($type,$code){
            $query  = $this->db->select('*')
                                ->from('owl_education_employe')
                                ->where($type,$code)
                                ->get();
            $result = $query->row();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }
        public function insert($data_ins){
            $this->db->trans_start();
            
            $this->db->insert('owl_education', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($type,$education_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $education_code);
            $this->db->update('owl_education', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_education($id,$education_code,$education_name){
            $this->db->trans_start();
            
            if ($id == '') {
            
                $data_ins_education      = array(
                	'education_code'     	=> $education_code,
                    'education_name'     	=> $education_name,
                    'is_active'             => '0',
                    'create_user'           => $this->session->userdata('username'),
                    'create_date'           => date('Y-m-d H:i:s')
                );

                $insert_education       = $this->insert($data_ins_education);

                if (!$insert_education) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert social media.');
                    return $result;
                }
            }else{
                $get_education           = $this->get_by_id('id',$id);

                if (!$get_education) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                    return $result;
                }

                $data_updt_education                 = array(
                    'education_name'     	=> $education_name,
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s'),
                    'is_active'             => $get_education->is_active
                );

                $update_education        = $this->update('id',$id,$data_updt_education);

                if (!$update_education) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update social media.');
                    return $result;
                }
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

        public function activated($id){
            $this->db->trans_start();

            $get_education = $this->get_by_id('id',$id);

            if (!$get_education) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                return $result;
            }

            if ($get_education->is_active == '1') {

                $get_education_employe = $this->get_education_employe('education_code',$get_education->education_code);
                if ($get_education_employe) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah mempunyai relasi dengan suatu karyawan dari suatu perusaan.');
                    return $result;
                }

                $data_updt_education                 = array(
                    'is_active'             => '0',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }else{
                $data_updt_education                 = array(
                    'is_active'             => '1',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }

            $update_education        = $this->update('education_code',$get_education->education_code,$data_updt_education);

            if (!$update_education) {
                $result = array('status' => 'error', 'msg' => 'Gagal update social media.');
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
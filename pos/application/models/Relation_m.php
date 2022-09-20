<?php
    class Relation_m extends CI_Model 
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
        						->from('owl_relation')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_relation')
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

        public function get_by_id($relation_code){
        	$query 	= $this->db->select('*')
        						->from('owl_relation')
        						->where('relation_code',$relation_code)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }
        public function get_relation_employe($type,$code){
            $query  = $this->db->select('*')
                                ->from('owl_relation_employe')
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
            
            $this->db->insert('owl_relation', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($type,$relation_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $relation_code);
            $this->db->update('owl_relation', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_relation($relation_code,$relation_name){
            $this->db->trans_start();
            
            if ($relation_code == '') {
            
                $data_ins_relation      = array(
                    'relation_name'         => $relation_name,
                    'is_active'             => '0',
                    'create_user'           => $this->session->userdata('username'),
                    'create_date'           => date('Y-m-d H:i:s')
                );

                $insert_relation       = $this->insert($data_ins_relation);

                if (!$insert_relation) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert social media.');
                    return $result;
                }

                $ins_id                     = $this->db->insert_id();
                $char                       = 'RL';
                $relation_code_fin          = $char.sprintf("%02s", $ins_id);

                $data_updt_relation                = array(
                    'relation_code'     => $relation_code_fin
                );

                $update_relation        = $this->update('id',$ins_id,$data_updt_relation);

                if (!$update_relation) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update social media.');
                    return $result;
                }
            }else{
                $get_relation           = $this->get_by_id($relation_code);

                if (!$get_relation) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                    return $result;
                }

                $data_updt_relation                 = array(
                    'relation_name'         => $relation_name,
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s'),
                    'is_active'             => $get_relation->is_active
                );

                $update_relation        = $this->update('relation_code',$relation_code,$data_updt_relation);

                if (!$update_relation) {
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

        public function activated($relation_code){
            $this->db->trans_start();

            $get_relation = $this->get_by_id($relation_code);

            if (!$get_relation) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                return $result;
            }

            if ($get_relation->is_active == '1') {

                $get_relation_company = $this->get_relation_company('relation_code',$get_relation->relation_code);
                if ($get_relation_company) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah mempunyai relasi dengan suatu perusahaan.');
                    return $result;
                }

                $get_relation_employe = $this->get_relation_employe('relation_code',$get_relation->relation_code);
                if ($get_relation_employe) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah mempunyai relasi dengan suatu karyawan dari suatu perusaan.');
                    return $result;
                }

                $data_updt_relation                 = array(
                    'is_active'             => '0',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }else{
                $data_updt_relation                 = array(
                    'is_active'             => '1',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }

            $update_relation        = $this->update('relation_code',$get_relation->relation_code,$data_updt_relation);

            if (!$update_relation) {
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
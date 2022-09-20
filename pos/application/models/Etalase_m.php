<?php
    class Etalase_m extends CI_Model 
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
        						->from('owl_pos_etalase')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_pos_etalase')
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
        						->from('owl_pos_etalase')
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
            
            $this->db->insert('owl_pos_etalase', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($type,$etalase_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $etalase_code);
            $this->db->update('owl_pos_etalase', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_etalase($id,$etalase_name){
            $this->db->trans_start();
            
            if ($id == '') {
            
                $data_ins_etalase      = array(
                    'etalase_name'     	=> $etalase_name,
                    'is_active'         => '1',
                    'create_user'       => $this->session->userdata('username'),
                    'create_date'       => date('Y-m-d H:i:s')
                );

                $insert_etalase       = $this->insert($data_ins_etalase);

                if (!$insert_etalase) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert social media.');
                    return $result;
                }

                $last_id               = $this->db->insert_id();
                $etalase_code          = 'SE-'.$last_id;

                $data_updt_etalase                 = array(
                    'etalase_code'     => $etalase_code,
                );

                $update_etalase        = $this->update('id',$id,$data_updt_etalase);
            }else{
                $get_etalase           = $this->get_by_id('id',$id);

                if (!$get_etalase) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                    return $result;
                }

                $data_updt_etalase                 = array(
                    'etalase_name'     	=> $etalase_name,
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s'),
                    'is_active'             => $get_etalase->is_active
                );

                $update_etalase        = $this->update('id',$id,$data_updt_etalase);

                if (!$update_etalase) {
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

        public function get_all_etalase_company(){
            $query  = $this->db->select('*')
                                ->from('owl_pos_etalase_company')
                                ->order_by('id','DESC')
                                ->get();
            $result = $query->result();

            return $result;
        }

        public function get_all_active_etalase_company($code){
            $query  = $this->db->select('a.*,b.etalase_name')
                                ->from('owl_pos_etalase_company as a')
                                ->join('owl_pos_etalase as b','a.etalase_code=b.etalase_code')
                                ->where('a.company_code',$code)
                                ->where('a.is_active','1')
                                ->order_by('a.id','DESC')
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_by_id_etalase_company($type,$code){
            $query  = $this->db->select('*')
                                ->from('owl_pos_etalase_company')
                                ->where($type,$code)
                                ->get();
            $result = $query->row();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_by_params_etalase_company($params){
            $query  = $this->db->select('*')
                                ->from('owl_pos_etalase_company')
                                ->where($params)
                                ->get();
            $count  = $query->num_rows();

            if ($count > 1) {
                $result = $query->result();
            }else{
                $result = $query->row();
            }

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function save_form_etalase_company($company_code,$etalase_code){
            $this->db->trans_start();

            $data_ins   = array(
                'company_code'  => $company_code,
                'etalase_code'  => $etalase_code,
                'is_active'     => '1',
                'create_user'   => $this->session->userdata('username'),
                'create_date'   => date('Y-m-d H:i:s')
            );

            $insert_etalase_company       = $this->insert_etalase_company($data_ins);

            if (!$insert_etalase_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal insert social media.');
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

        public function insert_etalase_company($data_ins){
            $this->db->trans_start();
            
            $this->db->insert('owl_pos_etalase_company', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update_etalase_company($params,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($params);
            $this->db->update('owl_pos_etalase_company', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
?>
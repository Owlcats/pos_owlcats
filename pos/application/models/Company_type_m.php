<?php
    class Company_type_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_company_type')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_company_type')
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

        public function get_by_id($company_type_code){
        	$query 	= $this->db->select('*')
        						->from('owl_company_type')
        						->where('company_type_code',$company_type_code)
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
            
            $this->db->insert('owl_company_type', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($company_type_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where('company_type_code', $company_type_code);
            $this->db->update('owl_company_type', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
?>
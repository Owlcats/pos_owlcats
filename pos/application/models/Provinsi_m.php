<?php
    class Provinsi_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }

        public function get_all(){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_provinsi')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_by_id($id){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_provinsi')
        						->where('id',$id)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }
    }
?>
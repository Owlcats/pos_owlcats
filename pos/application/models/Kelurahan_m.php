<?php
    class Kelurahan_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }

        public function get_all(){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_kelurahan')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_by_id($id){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_kelurahan')
        						->where('id',$id)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_by_kecamatan($kecamatan_id){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_kelurahan')
        						->where('kecamatan_id',$kecamatan_id)
        						->get();
        	$result = $query->result();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }
    }
?>
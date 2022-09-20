<?php
    class Kecamatan_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }

        public function get_all(){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_kecamatan')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_by_id($id){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_kecamatan')
        						->where('id',$id)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_by_kabupaten($kabupaten_id){
        	$query 	= $this->db->select('id,nama')
        						->from('owl_master_kecamatan')
        						->where('kabupaten_id',$kabupaten_id)
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
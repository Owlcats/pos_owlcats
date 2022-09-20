<?php
    class Permision_roles_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_roles_permision')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_view(){
            $query  = $this->db->select('*')
                                ->from('owl_roles_permision')
                                ->where('is_view','1')
                                ->order_by('id','DESC')
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_by_id($id){
        	$query 	= $this->db->select('*')
        						->from('owl_roles_permision')
        						->where('id',$id)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_multiple_clause($where){
            $query  = $this->db->select('*')
                                ->from('owl_roles_permision')
                                ->where($where)
                                ->get();
            $count = $query->num_rows();

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

        public function get_menu_parent_permission($roles_code){
            $query  = $this->db->select('a.*,b.menu_code,b.menu_name,b.menu_parent,b.link,b.menu_type')
                                ->from('owl_roles_permision as a')
                                ->join('owl_menu as b','a.menu_code=b.menu_code')
                                ->join('owl_user_roles as c','a.roles_code=c.roles_code')
                                ->where('b.is_active','1')
                                ->where('c.roles_code',$roles_code)
                                ->where('b.menu_parent','')
                                ->order_by('b.order_cells','ASC')
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_sub_menu_permission($roles_code){
            $query  = $this->db->select('a.*,b.menu_code,b.menu_name,b.menu_parent,b.link,b.menu_type')
                                ->from('owl_roles_permision as a')
                                ->join('owl_menu as b','a.menu_code=b.menu_code')
                                ->join('owl_user_roles as c','a.roles_code=c.roles_code')
                                ->where('b.is_active','1')
                                ->where('c.roles_code',$roles_code)
                                ->where('b.menu_parent is not null')
                                ->order_by('b.order_cells','ASC')
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
            
            $this->db->insert('owl_roles_permision', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($id_name,$id_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($id_name, $id_code);
            $this->db->update('owl_roles_permision', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update_multiple_clause($where,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($where);
            $this->db->update('owl_roles_permision', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
?>
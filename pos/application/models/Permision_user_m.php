<?php
    class Permision_user_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_user_permision')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_view(){
            $query  = $this->db->select('*')
                                ->from('owl_user_permision')
                                ->where('is_views','1')
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
        						->from('owl_user_permision')
        						->where('id',$id)
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
            
            $this->db->insert('owl_user_permision', $data_ins);
            
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
            $this->db->update('owl_user_permision', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function delete($field_name,$type_code){
            $this->db->trans_start();
            
            $this->db->where($field_name, $type_code);
            $this->db->delete('owl_user_permision');
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function delete_join($field_name,$code,$field_name2,$code2){
            $this->db->trans_start();
            
            $this->db->where($field_name, $code);
            $this->db->delete('owl_user_permision join (select * form owl_user where '.$field_name2.' = "'.$code2.'") as a on a.id=owl_user_permision.user_id');
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function get_menu_parent_permission($id,$roles_code){
            $query  = $this->db->select('a.menu_code,a.menu_name,a.menu_parent,a.link,a.menu_type,c.is_views,c.user_id')
                                ->from('owl_menu as a')
                                ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                ->join('(select user_id,menu_code,is_views from owl_user_permision where user_id="'.$id.'") as c','a.menu_code=c.menu_code','left')
                                ->where('a.is_active','1')
                                ->where('a.menu_parent','')
                                ->where('b.is_views','1')
                                ->where('b.roles_code',$roles_code)
                                ->order_by('a.order_cells','ASC')
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_sub_menu_permission($id,$roles_code){
            $query  = $this->db->select('a.menu_code,a.menu_name,a.menu_parent,a.link,a.menu_type,c.is_views,c.user_id')
                                ->from('owl_menu as a')
                                ->join('owl_roles_permision as b','a.menu_code=b.menu_code')
                                ->join('(select user_id,menu_code,is_views from owl_user_permision where user_id="'.$id.'") as c','a.menu_code=c.menu_code','left')
                                ->where('a.is_active','1')
                                ->where('a.menu_parent is not null')
                                ->where('b.is_views','1')
                                ->where('b.roles_code',$roles_code)
                                ->order_by('a.order_cells','ASC')
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
<?php
    class Menu_type_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'User_roles_m',
                'Permision_roles_m',
                'Permision_user_m',
                'Menu_m'
            ));
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_menu_type')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_menu_type')
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

        public function get_by_id($id){
        	$query 	= $this->db->select('*')
        						->from('owl_menu_type')
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
            
            $this->db->insert('owl_menu_type', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($id,$data_updt){
            $this->db->trans_start();
            
            $this->db->where('id', $id);
            $this->db->update('owl_menu_type', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
        public function activated($id){
            $this->db->trans_start();
            
            $get_module_type                    = $this->get_by_id($id);
            if (!$get_module_type) {
                $result = array('status' => 'error', 'msg' => 'Gagal Aktivasi, data yang ingin di aktifkan tidak di temukan.');
                return $result;
            }

            if ($get_module_type->is_active == '1') {
                $data_updt                      = array(
                    'user_update'   => $this->session->userdata('username'),
                    'update_date'   => date('Y-m-d H:i:s'),
                    'is_active'     => '0'
                );

                $get_module                     = $this->Menu_m->get_by_type($get_module_type->id);
                if ($get_module) {
                    $update_menu                = $this->Menu_m->update('menu_type',$get_module_type->id,$data_updt);
                    if (!$update_menu) {
                        $result = array('status' => 'error', 'msg' => 'Gagal inactive menu.');
                        return $result;
                    }
                    $data_updt_permision        = array(
                        'user_update'   => $this->session->userdata('username'),
                        'date_update'   => date('Y-m-d H:i:s'),
                        'is_views'     => '0'
                    );
                    foreach ($get_module as $row) {
                        $updt_roles_permision      = $this->Permision_roles_m->update('menu_code',$row->menu_code,$data_updt_permision);

                        if (!$updt_roles_permision) {
                            $result = array('status' => 'error', 'msg' => 'Gagal update roles permision.');
                            return $result;
                        }

                        $delete_permission_user = $this->Permision_user_m->delete('menu_code',$row->menu_code);

                        if (!$delete_permission_user) {
                            $result = array('status' => 'error', 'msg' => 'Gagal delete user permision.');
                            return $result;
                        }
                    }
                }
            }else{
                $data_updt                      = array(
                    'user_update'   => $this->session->userdata('username'),
                    'update_date'   => date('Y-m-d H:i:s'),
                    'is_active'     => '1'
                );
            }

            $this->update($id,$data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error', 'msg' => 'Gagal.');
                return $result;
            }else{
                $result = array('status' => 'success', 'msg' => 'Berhasil.');
                return $result;;
            }
        }
    }
?>
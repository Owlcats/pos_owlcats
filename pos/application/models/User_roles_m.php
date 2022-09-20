<?php
    class User_roles_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'Menu_m',
                'User_m',
                'Permision_user_m'
            ));
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_user_roles')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_user_roles')
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

        public function get_by_id($roles_code){
        	$query 	= $this->db->select('*')
        						->from('owl_user_roles')
        						->where('roles_code',$roles_code)
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
            
            $this->db->insert('owl_user_roles', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($code_name,$roles_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($code_name, $roles_code);
            $this->db->update('owl_user_roles', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_roles($roles_code,$roles_name){
            $this->db->trans_start();

            if ($roles_code == '') {
            
                $data_ins_roles     = array(
                    'roles_name'    => $roles_name,
                    'is_active'     => '0',
                    'create_user'   => $this->session->userdata('username'),
                    'create_date'   => date('Y-m-d H:i:s')
                );

                $insert_roles       = $this->insert($data_ins_roles);

                if (!$insert_roles) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert roles.');
                    return $result;
                }

                $ins_id             = $this->db->insert_id();
                $char               = 'R';
                $roles_code_fin     = $char.sprintf("%03s", $ins_id);

                $data_updt_roles                = array(
                    'roles_code'    => $roles_code_fin
                );

                $update_roles       = $this->update('id',$ins_id,$data_updt_roles);

                if (!$update_roles) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update roles code.');
                    return $result;
                }

                $get_menu           = $this->Menu_m->get_all();
                if ($get_menu) {
                    foreach ($get_menu as $row) {
                        $data_ins_roles_permision   = array(
                            'menu_code'     => $row->menu_code,
                            'roles_code'    => $roles_code_fin,
                            'is_views'      => '0',
                            'user_create'   => $this->session->userdata('username'),
                            'date_create'   => date('Y-m-d H:i:s')
                        );

                        $insert_roles_permision     = $this->Permision_roles_m->insert($data_ins_roles_permision);

                        if (!$insert_roles_permision) {
                            $result = array('status' => 'error', 'msg' => 'Gagal insert permision roles.');
                            return $result;
                        }
                    }
                }
            
            }else{
                $get_roles              = $this->get_by_id($roles_code);
                if (!$get_roles) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                    return $result;
                }

                $data_updt_roles                 = array(
                    'roles_name'            => $roles_name,
                    'update_user'           => $this->session->userdata('username'),
                    'last_update_date'      => date('Y-m-d H:i:s'),
                    'is_active'             => $get_roles->is_active
                );

                $update_roles        = $this->update('roles_code',$roles_code,$data_updt_roles);

                if (!$update_roles) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update roles.');
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

        public function activated($roles_code){
            $this->db->trans_start();

            $get_roles              = $this->get_by_id($roles_code);
            if (!$get_roles) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                return $result;
            }

            if ($get_roles->roles_code == 'R001') {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, karna roles yang ingin di update adalah administrator.');
                return $result;
            }

            if ($get_roles->is_active == '1') {
                $get_user                       = $this->User_m->get_all_by_id('type_code',$type_code);
                if ($get_user) {
                    foreach ($get_user as $row) {
                        $delete_permission_user = $this->Permision_user_m->delete('user_id',$get_user->id);

                        if (!$delete_permission_user) {
                            $result = array('status' => 'error', 'msg' => 'Gagal delete permission user.');
                            return $result;
                        } 
                    }

                    $data_updt_user             = array(
                        'is_active'         => '0',
                        'last_update_date'  => date('Y-m-d H:i:s'),
                        'update_user'       => $this->session->userdata('username'),
                        'keterangan_update' => ($row->keterangan_update == '') ? 'Update nonactive user type' : $row->keterangan_update.' - Update nonactive user type'
                    );

                    $update_user                = $this->User_m->update('roles_code',$roles_code,$data_updt_user);

                    if (!$update_user) {
                        $result = array('status' => 'error', 'msg' => 'Gagal update user.');
                        return $result;
                    }
                }
                $data_updt_roles            = array(
                    'update_user'           => $this->session->userdata('username'),
                    'last_update_date'      => date('Y-m-d H:i:s'),
                    'is_active'             => '0'
                );

                $data_updt_permision       = array(
                    'user_update'   => $this->session->userdata('username'),
                    'date_update'   => date('Y-m-d H:i:s'),
                    'is_views'      => '0'
                );

                $updt_roles_permision      = $this->Permision_roles_m->update('roles_code',$get_roles->roles_code,$data_updt_permision);

                if (!$updt_roles_permision) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update roles permision.');
                    return $result;
                }
            }else{
                $data_updt_roles            = array(
                    'update_user'           => $this->session->userdata('username'),
                    'last_update_date'      => date('Y-m-d H:i:s'),
                    'is_active'             => '1'
                );
            }

            $this->update('roles_code',$get_roles->roles_code,$data_updt_roles);

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
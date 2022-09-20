<?php
    class Menu_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
	            'User_roles_m',
	            'Permision_roles_m',
	            'Permision_user_m',
	            'Menu_type_m',
	            'Company_type_m'
	        ));
        }

        public function get_all(){
        	$query 	= $this->db->select('a.*,b.menu_type as menu_type_name,c.company_type_name,CONCAT(b.controller,a.link) as menu_link')
        						->from('owl_menu as a')
        						->join('owl_menu_type as b','a.menu_type=b.id')
        						->join('owl_company_type as c','a.menu_level=c.company_type_code')
        						->order_by('a.id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_by_id($menu_code){
        	$query 	= $this->db->select('*')
        						->from('owl_menu')
        						->where('menu_code',$menu_code)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_by_type($menu_type){
        	$query 	= $this->db->select('*')
        						->from('owl_menu')
        						->where('menu_type',$menu_type)
        						->get();
        	$result = $query->result();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_all_parent(){
        	$query 	= $this->db->select('*')
        						->from('owl_menu')
        						->where('link','')
        						->get();
        	$result = $query->result();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_by_parent($parent_code){
        	$query 	= $this->db->select('*')
        						->from('owl_menu')
        						->where('menu_parent',$parent_code)
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
            
            $this->db->insert('owl_menu', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($menu_code_name,$menu_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($menu_code_name, $menu_code);
            $this->db->update('owl_menu', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
        public function save_form_module($menu_code,$menu_name,$menu_type,$menu_level,$menu_parent,$link,$order_cells,$logo){
        	$this->db->trans_start();

            
            if ($menu_code == "") {
            	$data_ins_menu 					= array(
					'menu_name'		=> $menu_name,
					'menu_type'		=> $menu_type,
					'menu_level'	=> $menu_level,
					'menu_parent'	=> $menu_parent,
					'link'			=> $link,
					'order_cells'	=> $order_cells,
                    'logo'          => $logo,
					'is_active'		=> '0',
					'user_create'	=> $this->session->userdata('username'),
					'create_date'	=> date('Y-m-d H:i:s')
				);
            	// a
            	$insert_menu 		= $this->insert($data_ins_menu);

            	if (!$insert_menu) {
	        		$result = array('status' => 'error', 'msg' => 'Gagal insert menu.');
	                return $result;
	        	}

            	$ins_id 			= $this->db->insert_id();
            	$char				= 'M';
            	$menu_code_fin		= $char.sprintf("%04s", $ins_id);

            	$data_updt_menu 				= array(
            		'menu_code'		=> $menu_code_fin
            	);

            	$update_menu 		= $this->update('id',$ins_id,$data_updt_menu);

            	if (!$update_menu) {
	        		$result = array('status' => 'error', 'msg' => 'Gagal update menu code.');
	                return $result;
	        	}
        	   
                $get_roles				= $this->User_roles_m->get_all();
                if ($get_roles) {
                	foreach ($get_roles as $row) {
                		$data_ins_roles_permision 	= array(
                			'menu_code'		=> $menu_code_fin,
                			'roles_code'	=> $row->roles_code,
                			'is_views'		=> '0',
                			'user_create'	=> $this->session->userdata('username'),
    						'date_create'	=> date('Y-m-d H:i:s')
                		);

                		$insert_roles_permision 	= $this->Permision_roles_m->insert($data_ins_roles_permision);

                		if (!$insert_roles_permision) {
    		        		$result = array('status' => 'error', 'msg' => 'Gagal insert permision roles.');
    		                return $result;
    		        	}
                	}
                }
            }else{
            	$get_menu				= $this->get_by_id($menu_code);
				if (!$get_menu) {
					$result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
		            return $result;
				}

            	$data_updt_menu 				= array(
            		'menu_name'		=> $menu_name,
            		'menu_type'		=> $menu_type,
					'menu_level'	=> $menu_level,
					'menu_parent'	=> $menu_parent,
					'link'			=> $link,
					'order_cells'	=> $order_cells,
                    'logo'          => $logo,
					'user_update'	=> $this->session->userdata('username'),
					'update_date'	=> date('Y-m-d H:i:s'),
					'is_active'		=> $get_menu->is_active
            	);

            	$update_menu 		= $this->update('menu_code',$menu_code,$data_updt_menu);

            	if (!$update_menu) {
	        		$result = array('status' => 'error', 'msg' => 'Gagal update menu.');
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

        public function activated($menu_code){
        	$this->db->trans_start();
            
            $get_module                    = $this->get_by_id($menu_code);
            if (!$get_module) {
                $result = array('status' => 'error', 'msg' => 'Gagal Aktivasi, data yang ingin di aktifkan tidak di temukan.');
                return $result;
            }

            if ($get_module->is_active == '1') {
            	$data_updt_menu            = array(
                    'user_update'   => $this->session->userdata('username'),
                    'update_date'   => date('Y-m-d H:i:s'),
                    'is_active'     => '0'
                );
                $data_updt_permision 	   = array(
                    'user_update'   => $this->session->userdata('username'),
                    'date_update'   => date('Y-m-d H:i:s'),
                    'is_views'      => '0'
                );

                $updt_roles_permision      = $this->Permision_roles_m->update('menu_code',$get_module->menu_code,$data_updt_permision);

                if (!$updt_roles_permision) {
                	$result = array('status' => 'error', 'msg' => 'Gagal update roles permision.');
	                return $result;
                }

                $updt_user_permision      = $this->Permision_user_m->delete('menu_code',$get_module->menu_code);

                if (!$updt_user_permision) {
                	$result = array('status' => 'error', 'msg' => 'Gagal delete user permision.');
	                return $result;
                }

                $get_sub 	= $this->get_by_parent($menu_code);
                if ($get_sub) {
                	$this->update('menu_parent',$menu_code,$data_updt_menu);
                	foreach ($get_sub as $row) {
                		$this->Permision_roles_m->update('menu_code',$row->menu_code,$data_updt_permision);
                		$this->Permision_user_m->delete('menu_code',$row->menu_code);
                	}
                }
            }else{
            	$data_updt_menu            = array(
                    'user_update'   => $this->session->userdata('username'),
                    'update_date'   => date('Y-m-d H:i:s'),
                    'is_active'     => '1'
                );

            	$get_module_type                    = $this->Menu_type_m->get_by_id($get_module->menu_type);
	            if (!$get_module_type || $get_module_type->is_active != '1') {
	                $result = array('status' => 'error', 'msg' => 'Gagal Aktivasi, Tipe pada data yang ingin di aktifkan tidak di temukan atau tidak aktif.');
	                return $result;
	            }
	            $get_company_type                    = $this->Company_type_m->get_by_id($get_module->menu_level);
	            if (!$get_company_type || $get_company_type->is_active != '1') {
	                $result = array('status' => 'error', 'msg' => 'Gagal Aktivasi, Level pada data yang ingin di aktifkan tidak di temukan atau tidak aktif.');
	                return $result;
	            }

	            if ($get_module->menu_parent != "") {
	            	$get_parent 	= $this->get_by_id($get_module->menu_parent);
	            	if ($get_parent->is_active != '1') {
	            		$result = array('status' => 'error', 'msg' => 'Gagal Aktivasi, Parent pada menu ini tidak aktif.');
	                	return $result;
	            	}
	            }
            }

            $this->update('menu_code',$menu_code,$data_updt_menu);
            
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
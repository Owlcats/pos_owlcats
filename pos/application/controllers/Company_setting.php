<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_setting extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		if(!$this->session->userdata('isLogin')) redirect ('user/login');
		$this->load->model(array(
            'Company_m',
            'Company_type_m',
            'Employe_m',
            'Menu_m',
            'Menu_type_m',
            'User_roles_m',
            'Permision_roles_m',
            'Permision_user_m',
            'User_type_m',
            'User_m',
            'Social_media_m',
            'Education_m',
            'Status_m',
            'Relation_m',
            'Provinsi_m',
            'Kabupaten_m',
            'Kecamatan_m',
            'Kelurahan_m',
            'Picture_m',
            'Etalase_m'
        ));
	}

	public function index(){
		$session_relation 				= $this->session->userdata('relation_code');

		$company 						= $this->Company_m->get_all_by_id('company_code',$session_relation);

		if ($company) {
			$this->data['company']			= $company;
			$this->data['is_company']		= '1';
			$this->data['get_social_media']	= $this->Social_media_m->get_social_media_company(array('a.company_code' => $company->company_code, 'a.is_active' => '1'));
			$this->data['get_employe']		= $this->Employe_m->get_active_by_id('company_code',$company->company_code);
		}else{
			$employe 						= $this->Employe_m->get_all_by_id('employe_code',$session_relation);
			$company_employe 				= $this->Company_m->get_all_by_id('company_code',$employe->company_code);
			$this->data['company']			= $company_employe;
			$this->data['is_company']		= '0';
			$this->data['get_social_media']	= $this->Social_media_m->get_social_media_company(array('company_code' => $company_employe->company_code, 'is_active' => '1'));
			$this->data['get_employe']		= $this->Employe_m->get_active_by_id('company_code',$company_employe->company_code);
		}

		$this->data['title']			= 'Dashboard';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		// $this->data['content'] 			= $this->load->view('_sitemaster/under-construction',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/dashboard/dashboard',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function menu(){
		$this->data['title']			= 'Module';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/module/module',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_module_type(){
		$this->data['get_module_type']	= $this->Menu_type_m->get_all();

		$content 						= $this->load->view('company_setting/module/list_data_module_type',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => "$content"));
		die();
	}

	public function list_data_module(){
		$this->data['get_module']		= $this->Menu_m->get_all();

		$content 						= $this->load->view('company_setting/module/list_data_module',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_module_type(){
		$id 								= $this->input->post('id');
		$this->data['id']					= $id;
		
		if ($id == "") {
			$this->data['get_module_type']	= "";
			$title 							= 'Form Add Module Type';
		}else{
			$this->data['get_module_type']	= $this->Menu_type_m->get_by_id($id);
			$title 							= 'Form Edit Module Type';
		}
		$content 							= $this->load->view('company_setting/module/form_module_type',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_module_type(){
		$id 								= $this->input->post('id');
		$menu_type 							= $this->input->post('menu_type');
		$controller 						= $this->input->post('controller');

		if ($id == "") {
			$data_ins 						= array(
				'menu_type'		=> $menu_type,
				'controller'	=> $controller,
				'user_create'	=> $this->session->userdata('username'),
				'create_date'	=> date('Y-m-d H:i:s'),
				'is_active'		=> '0',
			);

			$result							= $this->Menu_type_m->insert($data_ins);
		}else{
			$get_module_type				= $this->Menu_type_m->get_by_id($id);
			if (!$get_module_type) {
				echo json_encode(array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.'));
				die();
			}

			$data_updt 						= array(
				'menu_type'		=> $menu_type,
				'controller'	=> $controller,
				'user_update'	=> $this->session->userdata('username'),
				'update_date'	=> date('Y-m-d H:i:s'),
				'is_active'		=> $get_module_type->is_active
			);

			$result 						= $this->Menu_type_m->update($id,$data_updt);
		}
		if (!$result) {
			echo json_encode(array('status' => 'error', 'msg' => 'Gagal.'));
		}else{
			echo json_encode(array('status' => 'success', 'msg' => 'Berhasil.'));
		}
	}

	public function activated_module_type(){
		$id 								= $this->input->post('id');

		$result 							= $this->Menu_type_m->activated($id);
		echo json_encode($result);
		die();
	}

	public function form_module(){
		$menu_code 							= $this->input->post('menu_code');
		$this->data['menu_code']			= $menu_code;

		if ($menu_code == "") {
			$this->data['get_module']		= "";
			$title 							= 'Form Add Module';
		}else{
			$this->data['get_module']		= $this->Menu_m->get_by_id($menu_code);
			$title 							= 'Form Edit Module';
		}

		$this->data['get_module_type']		= $this->Menu_type_m->get_all_active();
		$this->data['get_company_type']		= $this->Company_type_m->get_all_active();
		$this->data['get_module_parent']	= $this->Menu_m->get_all_parent();

		$content 							= $this->load->view('company_setting/module/form_module',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_module(){
		$menu_code 							= $this->input->post('menu_code');
		$menu_name 							= $this->input->post('menu_name');
		$menu_type 							= $this->input->post('menu_type');
		$menu_level 						= $this->input->post('menu_level');
		$menu_parent 						= $this->input->post('menu_parent');
		$link 								= $this->input->post('link');
		$order_cells 						= $this->input->post('order_cells');
		$logo 								= $this->input->post('logo');

		$result 							= $this->Menu_m->save_form_module($menu_code,$menu_name,$menu_type,$menu_level,$menu_parent,$link,$order_cells,$logo);
		echo json_encode($result);
		die();
	}

	public function activated_module(){
		$menu_code 							= $this->input->post('menu_code');

		$result 							= $this->Menu_m->activated($menu_code);

		echo json_encode($result);
		die();
	}

	public function roles(){
		$this->data['title']			= 'Module';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/roles/roles',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_roles(){
		$this->data['get_roles']		= $this->User_roles_m->get_all();

		$content 						= $this->load->view('company_setting/roles/list_data_roles',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_roles(){
		$roles_code 						= $this->input->post('roles_code');
		$this->data['roles_code']			= $roles_code;

		if ($roles_code == "") {
			$this->data['get_roles']		= "";
			$title 							= 'Form Add Roles';
		}else{
			$this->data['get_roles']		= $this->User_roles_m->get_by_id($roles_code);
			$title 							= 'Form Edit Roles';
		}
		$content 							= $this->load->view('company_setting/roles/form_roles',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_roles(){
		$roles_code 					= $this->input->post('roles_code');
		$roles_name 					= $this->input->post('roles_name');

		$result 							= $this->User_roles_m->save_form_roles($roles_code,$roles_name);
		echo json_encode($result);
		die();
	}

	public function activated_roles(){
		$roles_code 						= $this->input->post('roles_code');

		$result 							= $this->User_roles_m->activated($roles_code);

		echo json_encode($result);
		die();
	}

	public function permission_roles($roles_code = ''){
		$get_roles						= $this->User_roles_m->get_by_id($roles_code);
		if (!$get_roles || $get_roles->is_active != '1') {
			$this->session->set_flashdata('error', 'Data tidak di temukan atau data sedang dalam keadaan non-active');
			redirect('company_setting/roles');
		}else{
			$this->data['title']			= 'Roles';
			$this->data['roles_code']		= $get_roles->roles_code;
			$this->data['get_menu_type']	= $this->Menu_type_m->get_all_active();
			$this->data['get_menu_parent']	= $this->Permision_roles_m->get_menu_parent_permission($roles_code);
			$this->data['get_sub_menu']		= $this->Permision_roles_m->get_sub_menu_permission($roles_code);
			$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
			$this->data['content'] 			= $this->load->view('company_setting/roles/roles_permission',$this->data, TRUE);
			$this->load->view('_sitemaster/home_setting',$this->data);
		}
	}

	public function process_permission(){

		$roles_code 	= $this->input->post('roles_code');
		$is_views 		= $this->input->post('is_views');

		for($i=0;$i<count($is_views);$i++){
			$where		= array(
				'menu_code'		=> substr($is_views[$i], 0, -1),
				'roles_code'	=> $roles_code
			);

			$data 		= array(
				'is_views'		=> substr($is_views[$i], -1),
				'user_update'   => $this->session->userdata('username'),
                'date_update'   => date('Y-m-d H:i:s')
			);

			$this->Permision_roles_m->update_multiple_clause($where,$data);
		}

		foreach ($is_views as $key => $value) {
	      	$is_views[$key] = substr($value, 0, -1);
	    }

	    $array_count = array_count_values($is_views);
	    $array_unique = [];
	    foreach ($array_count as $key => $value) {
	      	if ($value == 1) {
	        	$this->Permision_user_m->delete('owl_user_permision.menu_code',$key,'roles_code',$roles_code);
	      	}
	    }

		$this->session->set_flashdata('success', 'Data permission berhasil di update.');
		redirect('company_setting/permission_roles/'.$roles_code);

	}

	public function user($type = '1'){
		$this->data['link_type']		= $type;
		$this->data['title']			= 'User';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/user/user',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_user_type(){
		$this->data['get_user_type']	= $this->User_type_m->get_all();

		$content 						= $this->load->view('company_setting/user/list_data_user_type',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => "$content"));
		die();
	}

	public function form_user_type(){
		$type_code 							= $this->input->post('type_code');
		$this->data['type_code']			= $type_code;
		
		if ($type_code == "") {
			$this->data['get_user_type']	= "";
			$title 							= 'Form Add User Type';
		}else{
			$this->data['get_user_type']	= $this->User_type_m->get_all_by_id('type_code',$type_code);
			$title 							= 'Form Edit User Type';
		}
		$content 							= $this->load->view('company_setting/user/form_user_type',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_user_type(){
		$this->db->trans_start();

		$type_code 							= $this->input->post('type_code');
		$type_name 							= $this->input->post('type_name');

		if ($type_code == "") {
			$data_ins 						= array(
				'type_name'		=> $type_name,
				'create_user'	=> $this->session->userdata('username'),
				'create_date'	=> date('Y-m-d H:i:s'),
				'is_active'		=> '0',
			);

			$result							= $this->User_type_m->insert($data_ins);
			$ins_id 			= $this->db->insert_id();
        	$char				= 'T';
        	$type_code_fin		= $char.sprintf("%03s", $ins_id);

        	$data_updt_type_user 			= array(
        		'type_code'		=> $type_code_fin
        	);

        	$result 			= $this->User_type_m->update('id',$ins_id,$data_updt_type_user);
		}else{
			$get_user_type				= $this->User_type_m->get_all_by_id('type_code',$type_code);
			if (!$get_user_type) {
				echo json_encode(array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.'));
				die();
			}

			$data_updt 						= array(
				'type_name'			=> $type_name,
				'update_user'		=> $this->session->userdata('username'),
				'last_update_date'	=> date('Y-m-d H:i:s'),
				'is_active'			=> $get_user_type->is_active
			);

			$result 						= $this->User_type_m->update('type_code',$type_code,$data_updt);
		}
		if (!$result) {
			echo json_encode(array('status' => 'error', 'msg' => 'Gagal.'));
		}else{
			echo json_encode(array('status' => 'success', 'msg' => 'Berhasil.'));
		}

		$this->db->trans_complete();
	}

	public function activated_user_type(){
		$type_code 							= $this->input->post('type_code');

		$result 							= $this->User_type_m->activated($type_code);
		echo json_encode($result);
		die();
	}

	public function list_data_user(){
		$this->data['get_user']			= $this->User_m->get_list_data();

		$content 						= $this->load->view('company_setting/user/list_data_user',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => "$content"));
		die();
	}

	public function permission_user($id = ''){
		$get_user						 = $this->User_m->get_all_by_id('id',$id);
		if (!$get_user || $get_user->is_active != '1') {
			$this->session->set_flashdata('error', 'Data tidak di temukan atau data sedang dalam keadaan non-active');
			redirect('company_setting/user/2');
		}else{
			$this->data['title']			= 'User';
			$this->data['id']				= $get_user->id;
			$this->data['get_menu_type']	= $this->Menu_type_m->get_all_active();
			// $this->data['get_menu_parent']	= $this->Permision_roles_m->get_menu_parent_permission($get_user->roles_code);
			// $this->data['get_sub_menu']		= $this->Permision_roles_m->get_sub_menu_permission($get_user->roles_code);
			$this->data['get_menu_parent'] 	= $this->Permision_user_m->get_menu_parent_permission($get_user->id,$get_user->roles_code);
			$this->data['get_sub_menu']		= $this->Permision_user_m->get_sub_menu_permission($get_user->id,$get_user->roles_code);
			$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
			$this->data['content'] 			= $this->load->view('company_setting/user/user_permission',$this->data, TRUE);
			$this->load->view('_sitemaster/home_setting',$this->data);
		}
	}

	public function process_permission_user(){

		$user_id 	= $this->input->post('user_id');
		$is_views 		= $this->input->post('is_views');

		$this->Permision_user_m->delete('user_id',$user_id);

		for($i=0;$i<count($is_views);$i++){

			$data 		= array(
				'menu_code'		=> $is_views[$i],
				'user_id'		=> $user_id,
				'is_views'		=> '1',
				'user_create'   => $this->session->userdata('username'),
                'date_create'   => date('Y-m-d H:i:s')
			);

			$this->Permision_user_m->insert($data);
		}

		$this->session->set_flashdata('success', 'Data permission berhasil di update.');
		redirect('company_setting/permission_user/'.$user_id);

	}

	public function change_password(){
		$this->data['title']			= 'Change Password';

		$this->data['username']			= $this->session->userdata('username');

		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/user/change_password',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function process_change_password(){
		$username 						= $this->input->post('username');
		$password_old 					= $this->input->post('old_password');
		$password_new 					= $this->input->post('new_password');
		$password_re 					= $this->input->post('re_password');

		$get_user 						= $this->User_m->get_login($username,md5($password_old));

		if (!$get_user) {
			$this->session->set_flashdata('error', 'Password lama tidak sesuai.');
			redirect('company_setting/change_password');
		}else{
			if ($password_new != $password_re) {
				$this->session->set_flashdata('error', 'Password tidak sama.');
				redirect('company_setting/change_password');
			}else{
				$data = array(
					'password'			=> md5($password_new),
					'last_update_date'	=> date('Y-m-d H:i:s'),
					'update_user'		=> $username,
					'keterangan_update'	=> ($get_user->keterangan_update == '') ? 'Update Password' : $get_user->keterangan_update.'- Update Password'
				);

				$where = array(
					'username'			=> $username,
					'password'			=> md5($password_old)
				);

				$this->User_m->update_multiple_cond($where,$data);

				$this->session->set_flashdata('success', 'Berhasil merubah password.');
				redirect('company_setting/change_password');
			}
		}
	}

	public function activated_user(){
		$user_id 							= $this->input->post('id');

		$result 							= $this->User_m->activated($user_id);
		echo json_encode($result);
		die();
	}

	public function social_media(){
		$this->data['title']			= 'Social Media';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/social_media/social_media',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_social_media(){
		$this->data['get_social_media']		= $this->Social_media_m->get_all();

		$content 							= $this->load->view('company_setting/social_media/list_data_social_media',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_social_media(){
		$social_media_code 							= $this->input->post('social_media_code');
		$this->data['social_media_code']			= $social_media_code;

		if ($social_media_code == "") {
			$this->data['get_social_media']			= "";
			$title 									= 'Form Add social_media';
		}else{
			$this->data['get_social_media']			= $this->Social_media_m->get_by_id($social_media_code);
			$title 									= 'Form Edit social_media';
		}
		$content 									= $this->load->view('company_setting/social_media/form_social_media',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_social_media(){
		$social_media_code 					= $this->input->post('social_media_code');
		$social_media_name 					= $this->input->post('social_media_name');
		$social_media_logo 					= $this->input->post('social_media_logo');

		$result 							= $this->Social_media_m->save_form_social_media($social_media_code,$social_media_name,$social_media_logo);
		echo json_encode($result);
		die();
	}

	public function activated_social_media(){
		$social_media_code 						= $this->input->post('social_media_code');

		$result 								= $this->Social_media_m->activated($social_media_code);

		echo json_encode($result);
		die();
	}

	public function education(){
		$this->data['title']			= 'Education';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/education/education',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_education(){
		$this->data['get_education']		= $this->Education_m->get_all();

		$content 							= $this->load->view('company_setting/education/list_data_education',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_education(){
		$id 									= $this->input->post('id');
		$this->data['id']						= $id;

		if ($id == "") {
			$this->data['get_education']			= "";
			$title 									= 'Form Add education';
		}else{
			$this->data['get_education']			= $this->Education_m->get_by_id('id',$id);
			$title 									= 'Form Edit education';
		}
		$content 									= $this->load->view('company_setting/education/form_education',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_education(){
		$id 								= $this->input->post('id');
		$education_code 					= $this->input->post('education_code');
		$education_name 					= $this->input->post('education_name');

		$result 							= $this->Education_m->save_form_education($id,$education_code,$education_name);
		echo json_encode($result);
		die();
	}

	public function activated_education(){
		$id 									= $this->input->post('id');

		$result 								= $this->Education_m->activated($id);

		echo json_encode($result);
		die();
	}

	public function relation(){
		$this->data['title']			= 'Relation Of Employee';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/relation_employe/relation_employe',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_relation(){
		$this->data['get_relation']			= $this->Relation_m->get_all();

		$content 							= $this->load->view('company_setting/relation_employe/list_data_relation',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_relation(){
		$relation_code 							= $this->input->post('relation_code');
		$this->data['relation_code']			= $relation_code;

		if ($relation_code == "") {
			$this->data['get_relation']				= "";
			$title 									= 'Form Add relation';
		}else{
			$this->data['get_relation']				= $this->Relation_m->get_by_id($relation_code);
			$title 									= 'Form Edit relation';
		}
		$content 									= $this->load->view('company_setting/relation_employe/form_relation',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_relation(){
		$relation_code 					= $this->input->post('relation_code');
		$relation_name 					= $this->input->post('relation_name');

		$result 							= $this->Relation_m->save_form_relation($relation_code,$relation_name);
		echo json_encode($result);
		die();
	}

	public function activated_relation(){
		$relation_code 							= $this->input->post('relation_code');

		$result 								= $this->Relation_m->activated($relation_code);

		echo json_encode($result);
		die();
	}

	public function status(){
		$this->data['title']			= 'Status';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/status/status',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_status(){
		$this->data['get_status']			= $this->Status_m->get_all();

		$content 							= $this->load->view('company_setting/status/list_data_status',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_status(){
		$status_code 							= $this->input->post('status_code');
		$this->data['status_code']				= $status_code;

		if ($status_code == "") {
			$this->data['get_status']				= "";
			$title 									= 'Form Add status';
		}else{
			$this->data['get_status']				= $this->Status_m->get_by_id($status_code);
			$title 									= 'Form Edit status';
		}
		$content 									= $this->load->view('company_setting/status/form_status',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_status(){
		$status_code 					= $this->input->post('status_code');
		$keterangan 					= $this->input->post('keterangan');

		$result 						= $this->Status_m->save_form_status($status_code,$keterangan);
		echo json_encode($result);
		die();
	}

	public function activated_status(){
		$status_code 							= $this->input->post('status_code');

		$result 								= $this->Status_m->activated($status_code);

		echo json_encode($result);
		die();
	}

	public function form_edit_picture(){
		$company_code 							= $this->input->post('company_code');
		$this->data['company_code']				= $company_code;

		$this->data['get_company']				= $this->Company_m->get_all_by_id('company_code',$company_code);
		$title 									= 'Form Edit Company Logo';

		$content 								= $this->load->view('company_setting/dashboard/form_edit_picture',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}
	public function save_form_edit_picture(){
		$company_code 							= $this->input->post('company_code');

		$result 								= $this->Company_m->edit_picture($company_code);

		echo json_encode($result);
		die();
	}

	public function edit_company($company_code='0'){
		$company 						= $this->Company_m->get_all_by_id('company_code',$company_code);

		if ($company) {
			$this->data['title']		= 'Edit Company';
			$this->data['company']		= $company;
			$this->data['social_media'] = $this->Social_media_m->get_social_media_company(array('company_code'=>$company_code));
			$this->data['get_provinsi']	= $this->Provinsi_m->get_all();
			$this->data['kabupaten_id'] = $company->kabupaten_id;
			$this->data['kecamatan_id'] = $company->kecamatan_id;
			$this->data['kelurahan_id'] = $company->kelurahan_id;
			$this->data['sidebar'] 		= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
			$this->data['content'] 		= $this->load->view('company_setting/dashboard/edit_company',$this->data, TRUE);
			$this->load->view('_sitemaster/home_setting',$this->data);
		}else{
			$this->session->set_flashdata('error', 'Data tidak di temukan.');
			redirect('company_setting/');
		}
	}

	public function get_kabupaten(){
		$provinsi_id 					= $this->input->post('provinsi_id');
		$kabupaten_id 					= $this->input->post('kabupaten_id');

		$get_kabupaten					= $this->Kabupaten_m->get_by_provinsi($provinsi_id);

		if (!$get_kabupaten) {
			echo json_encode(array('status' => 'error', 'msg' => 'data kabupaten tidak di temukan'));
		}

		$option 						= "";
		$option 						.= "<option value=''>Pilih salah satu kabupaten</option>";
		foreach ($get_kabupaten as $row => $val) {
			if ($val->id == $kabupaten_id) {
                $select="selected";
            }else{
                $select="";
            }
			$option 					.= "<option value='$val->id' $select>$val->nama</option>";
		}

		echo json_encode(array('status' => 'success', 'msg' => $option));
	}

	public function get_kecamatan(){
		$kabupaten_id 					= $this->input->post('kabupaten_id');
		$kecamatan_id 					= $this->input->post('kecamatan_id');

		$get_kecamatan					= $this->Kecamatan_m->get_by_kabupaten($kabupaten_id);

		if (!$get_kecamatan) {
			echo json_encode(array('status' => 'error', 'msg' => 'data kecamatan tidak di temukan'));
		}

		$option 						= "";
		$option 						.= "<option value=''>Pilih salah satu kecamatan</option>";
		foreach ($get_kecamatan as $row => $val) {
			if ($val->id == $kecamatan_id) {
                $select="selected";
            }else{
                $select="";
            }
			$option 					.= "<option value='$val->id' $select>$val->nama</option>";
		}

		echo json_encode(array('status' => 'success', 'msg' => $option));
	}

	public function get_kelurahan(){
		$kecamatan_id 					= $this->input->post('kecamatan_id');
		$kelurahan_id 					= $this->input->post('kelurahan_id');

		$get_kelurahan					= $this->Kelurahan_m->get_by_kecamatan($kecamatan_id);

		if (!$get_kelurahan) {
			echo json_encode(array('status' => 'error', 'msg' => 'data kelurahan tidak di temukan'));
		}

		$option 						= "";
		$option 						.= "<option value=''>Pilih salah satu kelurahan</option>";
		foreach ($get_kelurahan as $row => $val) {
			if ($val->id == $kelurahan_id) {
                $select="selected";
            }else{
                $select="";
            }
			$option 					.= "<option value='$val->id' $select>$val->nama</option>";
		}

		echo json_encode(array('status' => 'success', 'msg' => $option));
		die();
	}

	public function form_social_media_company(){
		$id 											= $this->input->post('id');
		$company_code 									= $this->input->post('company_code');
		$this->data['id']								= $id;
		$this->data['company_code']						= $company_code;
		$this->data['get_social_media']					= $this->Social_media_m->get_all_active();

		if ($id == "") {
			$this->data['get_social_media_company']		= "";
			$title 										= 'Form Add Social Media Company';
		}else{
			$where 										= array(
				'a.id'									=> $id
			);
			$this->data['get_social_media_company']		= $this->Social_media_m->get_social_media_company($where);
			$title 										= 'Form Edit Social Media Company';
		}
		$content 									= $this->load->view('company_setting/dashboard/form_social_media_company',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function get_index_social_media(){
		$social_media_code 							= $this->input->post('social_media_code');

		$get_social_media 							= $this->Social_media_m->get_by_id($social_media_code);

		if (!$social_media_code) {
			echo json_encode(array('status' => 'error', 'msg' => 'Data social media tidak di temukan'));
			die();
		}

		echo json_encode(array('status' => 'success', 'msg' => $get_social_media->social_media_logo));
		die();
	}

	public function save_form_social_media_company(){
		$id 							= $this->input->post('id');
		$company_code 					= $this->input->post('company_code');
		$social_media_code 				= $this->input->post('social_media_code');
		$title 			 				= $this->input->post('title');
		$link 			 				= $this->input->post('link');
		$update_date 					= $this->input->post('update_date');
		$update_user 	 				= $this->input->post('update_user');

		$result 						= $this->Social_media_m->save_form_social_media_company($id,$company_code,$social_media_code,$title,$link,$update_date,$update_user);

		echo json_encode($result);
		die();
	}

	public function proses_edit_company(){
		$result 								= $this->Company_m->proses_edit_company();
		echo json_encode($result);
		die();
	}

	public function activated_social_media_company(){
		$id 							= $this->input->post('id');
		$result 						= $this->Social_media_m->activated_social_media_company($id);

		echo json_encode($result);
		die();
	}

	public function banner(){
		$session_relation 				= $this->session->userdata('relation_code');

		$company 						= $this->Company_m->get_all_by_id('company_code',$session_relation);

		if ($company) {
			$this->data['company']			= $company;
			$this->data['is_company']		= '1';
		}else{
			$employe 						= $this->Employe_m->get_all_by_id('employe_code',$session_relation);
			$company_employe 				= $this->Company_m->get_all_by_id('company_code',$employe->company_code);
			$this->data['company']			= $company_employe;
			$this->data['is_company']		= '0';
		}

		$this->data['title']			= 'Banner';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/banner/banner',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_banner(){
		$company_code 					= $this->input->post('company_code');

		if ($company_code == "") {
			echo json_encode(array('status' => 'error', 'msg' => 'data perusahaan tidak terbaca'));
			die();
		}

		$this->data['get_banner']	 		= $this->Picture_m->get_by_params(array('company_code' => $company_code));

		$content 							= $this->load->view('company_setting/banner/list_data_banner',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_banner(){
		$company_code 					= $this->input->post('company_code');

		if ($company_code == "") {
			echo json_encode(array('status' => 'error', 'msg' => 'data perusahaan tidak terbaca'));
			die();
		}

		$this->data['company_code'] 	= $company_code;

		$content 									= $this->load->view('company_setting/banner/form_banner',$this->data, TRUE);
		$title 										= 'Form Add Banner';

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_banner(){
		$company_code 							= $this->input->post('company_code');

		$result 								= $this->Picture_m->add_banner($company_code);

		echo json_encode($result);
		die();
	}

	public function activated_banner(){
		$id 									= $this->input->post('id');

		$result 								= $this->Picture_m->activated($id);

		echo json_encode($result);
		die();
	}

	public function etalase(){
		$this->data['title']			= 'Etalase Pos';
		$this->data['sidebar'] 			= $this->load->view('_sitemaster/sidebar-company-setting',$this->data, TRUE);
		$this->data['content'] 			= $this->load->view('company_setting/etalase/etalase',$this->data, TRUE);
		$this->load->view('_sitemaster/home_setting',$this->data);
	}

	public function list_data_etalase(){
		$this->data['get_etalase']			= $this->Etalase_m->get_all();

		$content 							= $this->load->view('company_setting/etalase/list_data_etalase',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'data' => $content));
		die();
	}

	public function form_etalase(){
		$id 									= $this->input->post('id');
		$this->data['id']						= $id;

		if ($id == "") {
			$this->data['get_etalase']			= "";
			$title 								= 'Form Add etalase';
		}else{
			$this->data['get_etalase']			= $this->Etalase_m->get_by_id('id',$id);
			$title 								= 'Form Edit etalase';
		}
		$content 								= $this->load->view('company_setting/etalase/form_etalase',$this->data, TRUE);

		echo json_encode(array('status' => 'success', 'msg' => '', 'title' => $title, 'form' => $content));
		die();
	}

	public function save_form_etalase(){
		$id 							= $this->input->post('id');
		$etalase_name 					= $this->input->post('etalase_name');

		$result 						= $this->Etalase_m->save_form_etalase($id,$etalase_name);
		echo json_encode($result);
		die();
	}
}

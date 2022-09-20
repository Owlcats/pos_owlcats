<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->model(array(
            'Provinsi_m',
            'Kabupaten_m',
            'Kecamatan_m',
            'Kelurahan_m',
            'User_m',
            'Company_m'
            ));
	}

	public function login()
    {
		$this->load->view('login');
	}

	public function register()
    {
    	$this->data['get_provinsi']	= $this->Provinsi_m->get_all();
		$this->load->view('register',$this->data);
	}

	public function get_kabupaten()
    {
    	$provinsi_id 	= $this->input->post('provinsi_id',TRUE);
    	$data 		 	= $this->Kabupaten_m->get_by_provinsi($provinsi_id);
		echo json_encode($data);
	}
	public function get_kecamatan()
    {
    	$kabupaten_id 	= $this->input->post('kabupaten_id',TRUE);
    	$data 		 	= $this->Kecamatan_m->get_by_kabupaten($kabupaten_id);
		echo json_encode($data);
	}
	public function get_kelurahan()
    {
    	$kecamatan_id 	= $this->input->post('kecamatan_id',TRUE);
    	$data 		 	= $this->Kelurahan_m->get_by_kecamatan($kecamatan_id);
		echo json_encode($data);
	}
	public function proses_register(){
		$response 		= $this->User_m->register();
		echo json_encode($response); 
		die();
	}

	public function send_verifikasi_link($random_code){
		$this->User_m->send_verifikasi_link($random_code);
		$this->session->set_flashdata('success', 'Selamat berhasil registrasi ! Silahkan cek inbox/spam email yang di daftarkan untuk mendapatkan username, password dan link verifikasi untuk mengaktifkan akun kamu agar dapar login');
		redirect('user/login');
	}

	public function verifikasi_akun($random_code){
		$_POST['random_code']	= $random_code;
		$this->User_m->activated_by_random_code();
		$this->session->set_flashdata('success', 'Selamat akun kamu telah aktif ! Silahkan login dengan username dan password yang ada di email');
		redirect('user/login');
	}

	public function do_login(){
    	$username 			= $this->input->post('username');
    	$password 			= $this->input->post('password');

    	$pwd 				= md5($password);
    	$uid 				= $username;
		
		$get_user			= $this->User_m->get_active_by_id('username',$uid);
		if (!$get_user) {
		    $this->session->set_flashdata('error','Username tidak terdaftar.');
		    redirect('user/login');
		}else{
			$get_user_log	= $this->User_m->get_login($uid,$pwd);
			if (!$get_user_log) {
				$this->session->set_flashdata('error','password salah.');
		    	redirect('user/login');
			}else{
				$last_login = array(
									'last_login' 	=> date('Y-m-d h:i:s'),
									'alamat_login' 	=> $this->input->ip_address()
								);
	            $this->db->where('id', $get_user_log->id);
	            $this->db->update('owl_user', $last_login);

	            $data = array (
	                'isLogin'        => 'yes',
	                'user_id'        => $get_user_log->id,
	                'username'       => $get_user_log->username,
	                'roles_code'     => $get_user_log->roles_code,
	                'type_code'      => $get_user_log->type_code,
	                'relation_code'  => $get_user_log->relation_code,
            	);

            	$this->session->set_userdata($data);

            	redirect(base_url(''));
			}
		}       	
    }
    public function do_logout(){
    	$data_session = array(
            'isLogin'       => $this->session->userdata('isLogin'),
            'user_id'       => $this->session->userdata('user_id'),         
            'username'      => $this->session->userdata('username'),
            'roles_code'    => $this->session->userdata('roles_code'),
            'type_code'     => $this->session->userdata('type_code'),
            'relation_code' => $this->session->userdata('relation_code')  
        );

        $this->session->unset_userdata($data_session);
        $this->session->sess_destroy($data_session);

        redirect(base_url(''));
    }
}
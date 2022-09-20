<?php
    class User_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
            	'Company_m',
                'Permision_user_m'
            ));
        }

        public function get_company(){
        	$query = $this->Company_m->get_all_by_id('a.id','13');

        	if ($query) {
        		return $query;
        	}else{
        		return false;
        	}
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_user')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_list_data(){
            $query  = $this->db->select('a.*,b.type_name,c.roles_name')
                                ->from('owl_user as a')
                                ->join('owl_user_type as b','a.type_code=b.type_code')
                                ->join('owl_user_roles as c','a.roles_code=c.roles_code')
                                ->get();
            $result = $query->result();

            if ($result) {
                return $result;
            }else{
                return false;
            }
        }

        public function get_all_by_id($type,$id){
        	$query 	= $this->db->select('*')
        						->from('owl_user')
        						->where($type,$id)
        						->get();

        	$num_rows  = $query->num_rows();

            if ($num_rows > 1) {
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

        public function get_active_by_id($type,$id){
        	$query 	= $this->db->select('*')
        						->from('owl_user')
        						->where($type,$id)
        						->where('is_active',1)
        						->get();

        	$num_rows  = $query->num_rows();

            if ($num_rows > 1) {
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

        public function get_login($uid,$pwd){
        	$query 	= $this->db->select('*')
        						->from('owl_user')
        						->where('username',$uid)
        						->where('password',$pwd)
        						->where('is_active',1)
        						->get();

        	$num_rows  = $query->num_rows();

            if ($num_rows > 1) {
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

        public function get_by_random_code($random_code){
        	$query	= $this->db->query('SELECT * FROM owl_user WHERE md5(concat(username,(id+6679))) = "'.$random_code.'"');

        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function send_verifikasi_link($random_code){
        	$get_user 		= $this->get_by_random_code($random_code);
        	$get_company 	= $this->Company_m->get_all_by_id('company_code',$get_user->relation_code);

        	$attach 	= base_url('assets/logo/logo-owlcats-pict.png');
        	$subject 	= 'Verifikasi Akun | owlcats.com';
        	$message 	= '<p>
        						Haii,
        					</p>
        					<p>
        						Klik <a href="'.base_url('user/verifikasi_akun/').$random_code.'" target="_blank" rel="noopener">disini</a> untuk memverifikasi akun kamu agar kamu dapat login segera.
        					</p>
        					<br/><br/>
        					<p>
        						username = <b>'.$get_user->username.'</b>
        						<br/>
        						password = <b>'.$get_user->username.'</b>
        					</p>
        					<p>
        						Kamu dapat merubah / setting username dan password ulang setlah login.
        					</p>';

        	$config 	= [
				            'mailtype'  	=> 'html',
				            'charset'   	=> 'utf-8',
				            'protocol'  	=> 'smtp',
				            'smtp_host' 	=> 'mail.owlcats.com',
				            'smtp_user' 	=> 'teguh.fitrianto@owlcats.com',
				            'smtp_pass'   	=> 'bhasyinsey166',
				            'smtp_crypto' 	=> 'ssl',
				            'smtp_port'   	=> 465,
				            'crlf'    		=> "\r\n",
				            'newline' 		=> "\r\n"
	        ];

	        $this->load->library('email', $config);

	        $this->email->from('teguh.fitrianto@owlcats.com', 'owlcats.com');

	        $this->email->to($get_company->email);

	        $this->email->attach($attach);

	        $this->email->subject($subject);

	        $this->email->message($message);

	        if ($this->email->send()) {
	            return '1';
	        } else {
	            return '0';
	        }
        }

        public function insert_user(){
        	$relation_code 	= $this->input->post('relation_code');
        	$create_user    = $this->input->ip_address();

        	$data_user		= array(
        							'roles_code'		=> 'R002',
        							'type_code'			=> 'T002',
        							'relation_code'		=> $relation_code,
        							'create_date'		=> date('Y-m-d'),
        							'create_user'		=> $create_user,
        							'is_active'			=> 0
        	);

        	$this->db->insert('owl_user',$data_user);
            $last_id                = $this->db->insert_id();

            $get_user 				= $this->get_all_by_id('id',$last_id);

            $uap 					= substr($relation_code, 0, 2).substr($get_user->roles_code, -1).substr($get_user->type_code, -1).$last_id;

            $this->db->where('id', $last_id);
            $this->db->update('owl_user', array('username' => $uap, 'password' => md5($uap)));

            $get_user_by_username 	= $this->get_all_by_id('username',$uap);

            if ($get_user_by_username) {
            	return $get_user_by_username;
            }else{
            	return false;
            }
        }

        public function register(){

        	$this->db->trans_start();

        	$nomor_telpon           = $this->input->post('nomor_telpon');
            $nomor_handphone        = $this->input->post('nomor_handphone');
            $email                  = $this->input->post('email');

            $get_company_by_email	= $this->Company_m->get_all_by_id('email',$email);
            $get_company_by_hp		= $this->Company_m->get_all_by_id('nomor_handphone',$nomor_handphone);

            if ($get_company_by_email) {
            	$result = array('status' => 'error', 'random_code' => '', 'msg' => 'E-mail sudah terdaftar');
            	return $result;
            }

            if ($get_company_by_hp) {
            	$result = array('status' => 'error', 'random_code' => '', 'msg' => 'Nomor Hp sudah terdaftar');
            	return $result;
            }

        	$insert_company			= $this->Company_m->insert_company();

        	if ($insert_company === false) {
        		$result = array('status' => 'error', 'random_code' => '', 'msg' => 'Gagal membuat company silahkan hubungi admin di email teguh.fitrianto@owlcats.com');
        		return $result;
        	}

        	$_POST['relation_code'] = $insert_company->company_code;

        	$insert_user 			= $this->insert_user();

        	if ($insert_user === false) {
        		$result = array('status' => 'error', 'random_code' => '', 'msg' => 'Gagal membuat user silahkan hubungi admin di email teguh.fitrianto@owlcats.com');
        		return $result;
        	}

        	$user_id 				= (int) $insert_user->id;
        	$username 				= $insert_user->username;
        	$code 					= (int) '6679';

        	$random_code 			= md5($username.($user_id+$code));

        	$this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error', 'random_code' => '', 'msg' => 'Gagal membuat user silahkan hubungi admin di email teguh.fitrianto@owlcats.com');
        		return $result;
            }else{
                $result = array('status' => 'sukses', 'random_code' => $random_code, 'msg' => 'sukses');
        		return $result;
            }
        }

        public function activated_by_random_code(){
        	$random_code 	= $this->input->post('random_code');

        	$this->db->trans_start();

        	$data_activated = array(
        							'is_active' => 1,
        	);

        	$this->db->where('md5(concat(username,(id+6679)))', $random_code);
            $this->db->update('owl_user', $data_activated);

            $get_user 		= $this->get_by_random_code($random_code);

            $this->db->where('company_code', $get_user->relation_code);
            $this->db->update('owl_company', $data_activated);

        	$this->db->trans_complete();
        }

        public function update($field_name,$field_value,$data){
            $this->db->trans_start();
            
            $this->db->where($field_name, $field_value);
            $this->db->update('owl_user', $data);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update_multiple_cond($where,$val){
            $this->db->trans_start();
            
            $this->db->where($where);
            $this->db->update('owl_user', $val);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function activated($id){
            $this->db->trans_start();

            $get_user                       = $this->get_all_by_id('id',$id);
            if (!$get_user) {
                $result = array('status' => 'error', 'msg' => 'Gagal Aktivasi, data yang ingin di aktifkan tidak di temukan.');
                return $result;
            }

            if ($get_user->is_active == '1') {

                $data_updt_user            = array(
                    'is_active'             => '0',
                    'last_update_date'      => date('Y-m-d H:i:s'),
                    'update_user'           => $this->session->userdata('username'),
                    'keterangan_update'  => ($get_user->keterangan_update == '') ? 'Non-Active User' : $get_user->keterangan_update.'- Non-Active User'
                );

                $this->Permision_user_m->delete('user_id',$get_user->id);
            }else{
                $data_updt_user            = array(
                    'is_active'             => '1',
                    'last_update_date'      => date('Y-m-d H:i:s'),
                    'update_user'           => $this->session->userdata('username'),
                    'keterangan_update'  => ($get_user->keterangan_update == '') ? 'Active User' : $get_user->keterangan_update.'- Active User'
                );
            }

            $this->update('id',$id,$data_updt_user);
            
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
<?php
    class Social_media_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'Employe_m',
                'Company_m'
            ));
        }

        public function get_all(){
        	$query 	= $this->db->select('*')
        						->from('owl_social_media')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_social_media')
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

        public function get_by_id($social_media_code){
        	$query 	= $this->db->select('*')
        						->from('owl_social_media')
        						->where('social_media_code',$social_media_code)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }
        public function get_social_media_company($where){
            $query  = $this->db->select('a.*,b.social_media_name,b.social_media_logo')
                                ->from('owl_social_media_company as a')
                                ->join('owl_social_media as b','a.social_media_code=b.social_media_code')
                                ->where($where)
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
        public function get_social_media_employe($where){
            $query  = $this->db->select('*')
                                ->from('owl_social_media_employe')
                                ->where($where)
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
        public function insert($data_ins){
            $this->db->trans_start();
            
            $this->db->insert('owl_social_media', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($type,$social_media_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $social_media_code);
            $this->db->update('owl_social_media', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_social_media($social_media_code,$social_media_name,$social_media_logo){
            $this->db->trans_start();
            
            if ($social_media_code == '') {
            
                $data_ins_social_media      = array(
                    'social_media_name'     => $social_media_name,
                    'social_media_logo'     => $social_media_logo,
                    'is_active'             => '0',
                    'create_user'           => $this->session->userdata('username'),
                    'create_date'           => date('Y-m-d H:i:s')
                );

                $insert_social_media       = $this->insert($data_ins_social_media);

                if (!$insert_social_media) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert social media.');
                    return $result;
                }

                $ins_id                     = $this->db->insert_id();
                $char                       = 'SM';
                $social_meida_code_fin      = $char.sprintf("%02s", $ins_id);

                $data_updt_social_media                = array(
                    'social_media_code'     => $social_meida_code_fin
                );

                $update_social_media        = $this->update('id',$ins_id,$data_updt_social_media);

                if (!$update_social_media) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update social media.');
                    return $result;
                }
            }else{
                $get_social_media           = $this->get_by_id($social_media_code);

                if (!$get_social_media) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                    return $result;
                }

                $data_updt_social_media                 = array(
                    'social_media_name'     => $social_media_name,
                    'social_media_logo'     => $social_media_logo,
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s'),
                    'is_active'             => $get_social_media->is_active
                );

                $update_social_media        = $this->update('social_media_code',$social_media_code,$data_updt_social_media);

                if (!$update_social_media) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update social media.');
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

        public function activated($social_media_code){
            $this->db->trans_start();

            $get_social_media = $this->get_by_id($social_media_code);

            if (!$get_social_media) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                return $result;
            }

            if ($get_social_media->is_active == '1') {

                $where_social_media_company = array(
                    'social_media_code' => $social_media_code
                );

                $get_social_media_company = $this->get_social_media_company($where_social_media_company);
                if ($get_social_media_company) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah mempunyai relasi dengan suatu perusahaan.');
                    return $result;
                }

                $where_social_media_employe = array(
                    'social_media_code' => $social_media_code
                );

                $get_social_media_employe = $this->get_social_media_employe($where_social_media_employe);
                if ($get_social_media_employe) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah mempunyai relasi dengan suatu karyawan dari suatu perusaan.');
                    return $result;
                }

                $data_updt_social_media                 = array(
                    'is_active'             => '0',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }else{
                $data_updt_social_media                 = array(
                    'is_active'             => '1',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }

            $update_social_media        = $this->update('social_media_code',$get_social_media->social_media_code,$data_updt_social_media);

            if (!$update_social_media) {
                $result = array('status' => 'error', 'msg' => 'Gagal update social media.');
                return $result;
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

        public function insert_social_media_company($data_ins){
            $this->db->trans_start();
            
            $this->db->insert('owl_social_media_company', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update_social_media_company($type,$code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $code);
            $this->db->update('owl_social_media_company', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_social_media_company($id,$company_code,$social_media_code,$title,$link,$update_date,$update_user){
            $this->db->trans_start();

            if ($id == "") {
                $data_insert = array(
                    'company_code'      => $company_code,
                    'social_media_code' => $social_media_code,
                    'title'             => $title,
                    'link'              => $link,
                    'update_date'       => $update_date,
                    'update_user'       => $update_user
                );

                $insert_social_media_company = $this->insert_social_media_company($data_insert);
                if (!$insert_social_media_company) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert sosial media.');
                    return $result;
                }
            }else{
                $get_social_media_company = $this->get_social_media_company(array('a.id' => $id));
                if (!$get_social_media_company) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di update tidak di temukan.');
                    return $result;
                }

                $data_update = array(
                    'social_media_code' => $social_media_code,
                    'title'             => $title,
                    'link'              => $link,
                    'update_date'       => $update_date,
                    'update_user'       => $update_user
                );

                $update_social_media_company = $this->update_social_media_company('id',$get_social_media_company->id,$data_update);
                if (!$update_social_media_company) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update sosial media.');
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

        public function activated_social_media_company($id){
            $this->db->trans_start();

            $get_social_media_company = $this->get_social_media_company(array('a.id' => $id));
            if (!$get_social_media_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di update tidak di temukan.');
                return $result;
            }

            if ($get_social_media_company->is_active == '1') {
                $data_update = array(
                    'is_active'         => '0',
                    'update_date'       => date('Y-m-d H:i:s'),
                    'update_user'       => $this->session->userdata('username')
                );
            }else{
                $data_update = array(
                    'is_active'         => '1',
                    'update_date'       => date('Y-m-d H:i:s'),
                    'update_user'       => $this->session->userdata('username')
                );
            }

            $update_social_media_company = $this->update_social_media_company('id',$get_social_media_company->id,$data_update);
            if (!$update_social_media_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal update sosial media.');
                return $result;
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
    }
?>
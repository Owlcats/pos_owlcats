<?php
    class Status_m extends CI_Model 
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
        						->from('owl_status')
                                ->order_by('id','DESC')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_status')
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

        public function get_by_id($status_code){
        	$query 	= $this->db->select('*')
        						->from('owl_status')
        						->where('status_code',$status_code)
        						->get();
        	$result = $query->row();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }
        public function get_status_employe($type,$code){
            $query  = $this->db->select('*')
                                ->from('owl_employe')
                                ->where($type,$code)
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
            
            $this->db->insert('owl_status', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($type,$status_code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $status_code);
            $this->db->update('owl_status', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function save_form_status($status_code,$keterangan){
            $this->db->trans_start();
            
            if ($status_code == '') {
            
                $data_ins_status      = array(
                    'keterangan'            => $keterangan,
                    'is_active'             => '0',
                    'create_user'           => $this->session->userdata('username'),
                    'create_date'           => date('Y-m-d H:i:s')
                );

                $insert_status       = $this->insert($data_ins_status);

                if (!$insert_status) {
                    $result = array('status' => 'error', 'msg' => 'Gagal insert social media.');
                    return $result;
                }

                $ins_id                     = $this->db->insert_id();
                $char                       = 'ST';
                $status_code_fin            = $char.sprintf("%02s", $ins_id);

                $data_updt_status                = array(
                    'status_code'     => $status_code_fin
                );

                $update_status        = $this->update('id',$ins_id,$data_updt_status);

                if (!$update_status) {
                    $result = array('status' => 'error', 'msg' => 'Gagal update social media.');
                    return $result;
                }
            }else{
                $get_status           = $this->get_by_id($status_code);

                if (!$get_status) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                    return $result;
                }

                $data_updt_status                 = array(
                    'keterangan'            => $keterangan,
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s'),
                    'is_active'             => $get_status->is_active
                );

                $update_status        = $this->update('status_code',$status_code,$data_updt_status);

                if (!$update_status) {
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

        public function activated($status_code){
            $this->db->trans_start();

            $get_status = $this->get_by_id($status_code);

            if (!$get_status) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah tidak di temukan.');
                return $result;
            }

            if ($get_status->is_active == '1') {

                $get_status_employe = $this->get_status_employe('status_code',$get_status->status_code);
                if ($get_status_employe) {
                    $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di rubah mempunyai relasi dengan suatu karyawan dari suatu perusaan.');
                    return $result;
                }

                $data_updt_status                 = array(
                    'is_active'             => '0',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }else{
                $data_updt_status                 = array(
                    'is_active'             => '1',
                    'update_user'           => $this->session->userdata('username'),
                    'update_date'           => date('Y-m-d H:i:s')
                );
            }

            $update_status        = $this->update('status_code',$get_status->status_code,$data_updt_status);

            if (!$update_status) {
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
    }
?>
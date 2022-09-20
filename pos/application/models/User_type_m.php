<?php
    class User_type_m extends CI_Model 
    {
        function __construct(){
            parent::__construct();
            $this->load->model(array(
                'User_m',
                'Permision_user_m'
            ));
        }

        public function get_all(){
            $query  = $this->db->select('*')
                                ->from('owl_user_type')
                                ->get();
            $result = $query->result();

            return $result;
        }

        public function get_all_active(){
            $query  = $this->db->select('*')
                                ->from('owl_user_type')
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

        public function get_all_by_id($type,$id){
            $query  = $this->db->select('*')
                                ->from('owl_user_type')
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
            $query  = $this->db->select('*')
                                ->from('owl_user_type')
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
        public function insert($data_ins){
            $this->db->trans_start();
            
            $this->db->insert('owl_user_type', $data_ins);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function update($name_code,$code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($name_code, $code);
            $this->db->update('owl_user_type', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function activated($type_code){
            $this->db->trans_start();
            
            $get_user_type                      = $this->get_all_by_id('type_code',$type_code);
            if (!$get_user_type) {
                $result = array('status' => 'error', 'msg' => 'Gagal Aktivasi, data yang ingin di aktifkan tidak di temukan.');
                return $result;
            }

            if ($get_user_type->type_code == 'T001') {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, karna tipe yang ingin di update adalah administrator.');
                return $result;
            }

            if ($get_user_type->is_active == '1') {
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

                    $update_user                = $this->User_m->update('type_code',$type_code,$data_updt_user);

                    if (!$update_user) {
                        $result = array('status' => 'error', 'msg' => 'Gagal update user.');
                        return $result;
                    }
                }

                $data_updt_user_type            = array(
                    'is_active'             => '0',
                    'last_update_date'      => date('Y-m-d H:i:s'),
                    'update_user'           => $this->session->userdata('username')
                );
            }else{
                $data_updt_user_type            = array(
                    'is_active'             => '1',
                    'last_update_date'      => date('Y-m-d H:i:s'),
                    'update_user'           => $this->session->userdata('username')
                );
            }

            $this->update('type_code',$type_code,$data_updt_user_type);
            
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
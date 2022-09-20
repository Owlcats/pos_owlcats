<?php
    class Company_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
            $this->load->model(array(
                'Social_media_m'
            ));
        }

        public function get_all(){
        	$query 	= $this->db->select('a.*,
                                        b.company_type_name,
                                        c.nama as nama_provinsi,
                                        d.nama as nama_kabupaten,
                                        e.nama as nama_kecamatan,
                                        f.nama as nama_kelurahan'
                                    )
        						->from('owl_company as a')
                                ->join('owl_company_type as b','a.company_type=b.company_type_code')
                                ->join('owl_master_provinsi as c','a.provinsi_id=c.id')
                                ->join('owl_master_kabupaten as d','a.kabupaten_id=d.id')
                                ->join('owl_master_kecamatan as e','a.kecamatan_id=e.id')
                                ->join('owl_master_kelurahan as f','a.kelurahan_id=f.id')
        						->get();
        	$result = $query->result();

        	return $result;
        }

        public function get_all_by_id($type,$id){
        	$query     = $this->db->select('a.*,
                                        b.company_type_name,
                                        c.nama as nama_provinsi,
                                        d.nama as nama_kabupaten,
                                        e.nama as nama_kecamatan,
                                        f.nama as nama_kelurahan'
                                    )
                                ->from('owl_company as a')
                                ->join('owl_company_type as b','a.company_type=b.company_type_code')
                                ->join('owl_master_provinsi as c','a.provinsi_id=c.id')
                                ->join('owl_master_kabupaten as d','a.kabupaten_id=d.id')
                                ->join('owl_master_kecamatan as e','a.kecamatan_id=e.id')
                                ->join('owl_master_kelurahan as f','a.kelurahan_id=f.id')
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
            $query     = $this->db->select('a.*,
                                        b.company_type_name,
                                        c.nama as nama_provinsi,
                                        d.nama as nama_kabupaten,
                                        e.nama as nama_kecamatan,
                                        f.nama as nama_kelurahan'
                                    )
                                ->from('owl_company as a')
                                ->join('owl_company_type as b','a.company_type=b.company_type_code')
                                ->join('owl_master_provinsi as c','a.provinsi_id=c.id')
                                ->join('owl_master_kabupaten as d','a.kabupaten_id=d.id')
                                ->join('owl_master_kecamatan as e','a.kecamatan_id=e.id')
                                ->join('owl_master_kelurahan as f','a.kelurahan_id=f.id')
                                ->where($type,$id)
                                ->where('a.is_active',1)
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

        public function insert_company(){
            $company_name           = $this->input->post('company_name');
            $provinsi_id            = $this->input->post('provinsi_id');
            $kabupaten_id           = $this->input->post('kabupaten_id');
            $kecamatan_id           = $this->input->post('kecamatan_id');
            $kelurahan_id           = $this->input->post('kelurahan_id');
            $alamat                 = $this->input->post('alamat');
            $postal_code            = $this->input->post('postal_code');
            $nomor_telpon           = $this->input->post('nomor_telpon');
            $nomor_handphone        = $this->input->post('nomor_handphone');
            $email                  = $this->input->post('email');
            $fax                    = $this->input->post('fax');
            $visi                   = $this->input->post('visi');
            $misi                   = $this->input->post('misi');
            $create_user            = $this->input->ip_address();

            $this->load->library('image_lib');

            $config['upload_path']          = './assets/logo/company_logo/';
            $config['allowed_types']        = 'jpg|png';
            $config['file_name']            = "LOGO-".$company_name."-PICT-".$nomor_handphone;
            $config['overwrite']            = true;
            $config['max_size']             = 6144; // 3MB

            $this->load->library('upload', $config);

            $picture                        = $this->upload->do_upload('picture');

            if ($picture)
            {
                $image_data =   $this->upload->data();

                $configer =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $image_data['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'width'           =>  90,
                    'height'          =>  90,
                );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

                $picture_inp = $this->upload->data("file_name");
            }else{
                $picture_inp = "";
            }

            $data_company           = array(
                                            'company_name'      => $company_name,
                                            'company_type'      => 'BRZ',
                                            'provinsi_id'       => $provinsi_id,
                                            'kabupaten_id'      => $kabupaten_id,
                                            'kecamatan_id'      => $kecamatan_id,
                                            'kelurahan_id'      => $kelurahan_id,
                                            'alamat'            => $alamat,
                                            'postal_code'       => $postal_code,
                                            'nomor_telpon'      => $nomor_telpon,
                                            'nomor_handphone'   => $nomor_handphone,
                                            'email'             => $email,
                                            'fax'               => $fax,
                                            'visi'              => $visi,
                                            'misi'              => $misi,
                                            'is_active'         => 0,
                                            'create_user'       => $create_user,
                                            'create_date'       => date('Y-m-d'),
                                            'picture'           => $picture_inp
            );

            $this->db->insert('owl_company',$data_company);
            $last_id                = $this->db->insert_id();

            $company_code           = 'C'.$last_id;

            $this->db->where('id', $last_id);
            $this->db->update('owl_company', array('company_code' => $company_code));

            $get_company = $this->get_all_by_id('a.id',$last_id);

            if ($get_company) {
                return $get_company;
            }else{
                return false;
            }
        }

        public function edit_picture($company_code){
            $this->db->trans_start();

            $get_company                    = $this->get_all_by_id('company_code',$company_code);
            if (!$get_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di update tidak di temukan.');
                return $result;
            }

            $this->load->library('image_lib');

            $config['upload_path']          = './assets/logo/company_logo/';
            $config['allowed_types']        = 'jpg|png';
            $config['file_name']            = "UPDATE-LOGO-".$get_company->company_code;
            $config['overwrite']            = true;
            $config['max_size']             = 6144; // 3MB

            $this->load->library('upload', $config);

            $picture                        = $this->upload->do_upload('picture');

            if ($picture)
            {
                $image_data                 =   $this->upload->data();

                $configer                   =  array(
                    'image_library'   => 'gd2',
                    'source_image'    =>  $image_data['full_path'],
                    'maintain_ratio'  =>  TRUE,
                    'width'           =>  90,
                    'height'          =>  90,
                );
                $this->image_lib->clear();
                $this->image_lib->initialize($configer);
                $this->image_lib->resize();

                $picture_inp = $this->upload->data("file_name");
            }else{
                $picture_inp = "";
            }

            $data_updt_company              = array(
                'picture'              => $picture_inp,
                'update_user'          => $this->session->userdata('username'),
                'last_update_date'     => date('Y-m-d H:i:s'),
                'keterangan_update'    => ($get_company->keterangan_update == "") ? "Update picture" : $get_company->keterangan_update." - Update picture"
            );

            $this->db->where('company_code', $get_company->company_code);
            $this->db->update('owl_company', $data_updt_company);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error', 'msg' => 'Gagal.');
                return $result;
            }else{
                $result = array('status' => 'success', 'msg' => 'Berhasil.');
                return $result;;
            }
        }

        public function update($type,$code,$data_updt){
            $this->db->trans_start();
            
            $this->db->where($type, $code);
            $this->db->update('owl_company', $data_updt);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        public function proses_edit_company(){
            $this->db->trans_start();

            $data_social_media              = $this->input->post('data_social_media');
            $company_code                   = $this->input->post('company_code');
            $company_name                   = $this->input->post('company_name');
            $alamat                         = $this->input->post('alamat');
            $provinsi_id                    = $this->input->post('provinsi_id');
            $kabupaten_id                   = $this->input->post('kabupaten_id');
            $kecamatan_id                   = $this->input->post('kecamatan_id');
            $kelurahan_id                   = $this->input->post('kelurahan_id');
            $postal_code                    = $this->input->post('postal_code');
            $nomor_telpon                   = $this->input->post('nomor_telpon');
            $nomor_handphone                = $this->input->post('nomor_handphone');
            $email                          = $this->input->post('email');
            $fax                            = $this->input->post('fax');
            $visi                           = $this->input->post('visi');
            $misi                           = $this->input->post('misi');
            $about                          = $this->input->post('about');

            $get_company                    = $this->get_all_by_id('company_code',$company_code);
            if (!$get_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal Update, data yang ingin di update tidak di temukan.');
                return $result;
            }

            if ($data_social_media != "") {
                $data_decode        = json_decode($data_social_media);

                foreach ($data_decode as $key => $value) {
                    $v = (array)$value;
                    array_splice($v, 7, 8);
                    $insert_social_media_company = $this->Social_media_m->insert_social_media_company($v);
                    if (!$insert_social_media_company) {
                        $result = array('status' => 'error', 'msg' => 'Gagal insert sosial media.');
                        return $result;
                    }
                }
            }

            $data_updt_company = array(
                'company_name'      => $company_name,
                'alamat'            => $alamat,
                'provinsi_id'       => $provinsi_id,
                'kabupaten_id'      => $kabupaten_id,
                'kecamatan_id'      => $kecamatan_id,
                'kelurahan_id'      => $kelurahan_id,
                'postal_code'       => $postal_code,
                'nomor_telpon'      => $nomor_telpon,
                'nomor_handphone'   => $nomor_handphone,
                'email'             => $email,
                'fax'               => $fax,
                'visi'              => $visi,
                'misi'              => $misi,
                'about'             => $about,
                'update_user'       => $this->session->userdata('username'),
                'last_update_date'  => date('Y-m-d H:i:s'),
                'keterangan_update' => ($get_company->keterangan_update == "") ? "Update detail data" : $get_company->keterangan_update." - Update detail data"
            );

            $update_company         = $this->update('company_code',$get_company->company_code,$data_updt_company);
            if (!$update_company) {
                $result = array('status' => 'error', 'msg' => 'Gagal update company.');
                return $result;
            }

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
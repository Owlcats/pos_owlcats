<?php
    class Employe_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }
        public function get_all(){
        	$query 	= $this->db->select('a.*,
                                        c.nama as nama_provinsi,
                                        d.nama as nama_kabupaten,
                                        e.nama as nama_kecamatan,
                                        f.nama as nama_kelurahan'
                                    )
        						->from('owl_employe as a')
                                ->join('owl_master_provinsi as c','a.provinsi_id=c.id')
                                ->join('owl_master_kabupaten as d','a.kabupaten_id=d.id')
                                ->join('owl_master_kecamatan as e','a.kecamatan_id=e.id')
                                ->join('owl_master_kelurahan as f','a.kelurahan_id=f.id')
        						->get();
        	$result = $query->result();

        	if ($result) {
        		return $result;
        	}else{
        		return false;
        	}
        }

        public function get_all_by_id($type,$id){
        	$query     = $this->db->select('a.*,
                                        c.nama as nama_provinsi,
                                        d.nama as nama_kabupaten,
                                        e.nama as nama_kecamatan,
                                        f.nama as nama_kelurahan'
                                    )
                                ->from('owl_employe as a')
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
                                        c.nama as nama_provinsi,
                                        d.nama as nama_kabupaten,
                                        e.nama as nama_kecamatan,
                                        f.nama as nama_kelurahan'
                                    )
                                ->from('owl_employe as a')
                                ->join('owl_master_provinsi as c','a.provinsi_id=c.id')
                                ->join('owl_master_kabupaten as d','a.kabupaten_id=d.id')
                                ->join('owl_master_kecamatan as e','a.kecamatan_id=e.id')
                                ->join('owl_master_kelurahan as f','a.kelurahan_id=f.id')
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
    }
?>
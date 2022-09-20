<?php
    class Ndy_m extends CI_Model 
    {
    	function __construct(){
            parent::__construct();
        }

        public function executing(){
        	$this->db->trans_start();

        	$data = array(
        		'jawaban' => $this->input->post('value'),
        		'tanggal' => date('Y-m-d H:i:s')
        	);

        	$this->db->insert('owl_zi',$data);

        	$this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                $result = array('status' => 'error');
                return $result;
            }else{
                $result = array('status' => 'success');
                return $result;;
            }
        }
    }
?>
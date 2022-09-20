<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ndy extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('Ndy_m'));
    }

    public function index(){
    	$this->data['ndy'] = "";
		$this->load->view('_ndy/ndy',$this->data);
    }

    public function executing(){
    	$result = $this->Ndy_m->executing();
    	echo json_encode($result);
		die();
    }
}
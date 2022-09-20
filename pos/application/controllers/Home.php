<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->model(array(
            'Provinsi_m',
            'Kabupaten_m',
            'Kecamatan_m',
            'Kelurahan_m',
            'User_m',
            'Company_m',
            'Employe_m',
            'Picture_m'
        ));
	}

	public function index()
    {
    	$this->data['title']			             = '';
    	if(!$this->session->userdata('isLogin')){
    		$this->data['navbar'] 		             = $this->load->view('_sitemaster/top-navbar',$this->data, TRUE);
            $this->data['get_picture_company']       = "";
            $this->data['is_company']                = '0';
    	}else{
    		$relation_code 				             = $this->session->userdata('relation_code');
    		$company 					             = $this->Company_m->get_active_by_id('company_code',$relation_code);

    		if (!$company) {
    			$employe 				             = $this->Employe_m->get_active_by_id('employe_code',$relation_code);
    			$this->data['company']               = $company_employe =$this->Company_m->get_active_by_id('company_code',$employe->company_code);
                $this->data['get_picture_company']   = $this->Picture_m->get_for_banner('company_code',$company_employe->company_code);
    			$this->data['is_company']            = '0';
    		}else{
    			$this->data['company'] 	             = $company;
                $this->data['get_picture_company']   = $this->Picture_m->get_for_banner('company_code',$company->company_code);
    			$this->data['is_company'] 	         = '1';
    		}
    		$this->data['navbar'] 		             = $this->load->view('_sitemaster/top-navbar-login',$this->data, TRUE);
    	}
    	$this->data['content'] 			             = $this->load->view('home/home',$this->data, TRUE);
		$this->load->view('_sitemaster/home',$this->data);
	}

    public function offline_site()
    {
        $this->data['title']            = '';
        $this->data['navbar']           = '';
        $this->data['content']          = $this->load->view('_sitemaster/offline_site',$this->data, TRUE);
        $this->load->view('_sitemaster/home',$this->data);
    }
}
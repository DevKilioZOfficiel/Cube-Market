<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->database();
        $this->load->model('auth_model');
        $this->load->model('sessioncheck_model');
        $this->load->model('permissions_model');
        $this->load->model('product_model');
		$this->load->helper('text');
		$this->load->helper('download');
    }

	public function product($product = FALSE){
		$data['product'] = $this->sessioncheck_model->info_product_minecraft($product);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if(empty($data['product'])){
			redirect(base_url('parametres'));
            exit;
		}else{
            if(empty($product)){
		        redirect(base_url('parametres'));
                exit;
            }else{
				if($data['permission']['is_admin'] == 1 OR $data['user']['id'] == $data['product']['user']){
	    			$data['title'] = $data['product']['title'];
	    			$data['description'] = $data['product']['description'];
	    			$data['image'] = $data['product']['image'];
	    			$data["content"] = 'edit/product';
	    			$this->load->view('layouts/secure', $data);
	       			$this->load->view('layouts/default', $data);
				}else{
		            redirect(base_url('parametres#no__permission'));
                    exit;
				}
            }
	    }
	}
	
}

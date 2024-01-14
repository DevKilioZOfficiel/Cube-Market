<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

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
    }
	
	public function index($page = FALSE){
		$data['page'] = $this->sessioncheck_model->info_page($page);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if(empty($data['page'])){
			redirect(base_url('/#no_exist'));
            exit;
		}else{
            if(empty($page)){
		        redirect(base_url('/#no_exist'));
                exit;
            }else{
	    		$data['title'] = $data['page']['name'];
	    		$data['description'] = "";
	    		$data['image'] = "";
	    		$data["content"] = 'page/info';
	        	$this->load->view('layouts/secure', $data);
	        	$this->load->view('layouts/default', $data);
            }
	    }
	}
}

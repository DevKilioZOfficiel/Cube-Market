<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parametres extends CI_Controller {

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
		    $this->load->database();
        $this->load->model('auth_model');
        $this->load->model('sessioncheck_model');
        $this->load->model('permissions_model');
        $this->load->model('product_model');
		 $this->load->helper(array('form', 'url'));
    }


	public function index(){
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		$data['title'] = "Paramètres";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
        $data["content"] = 'parametres/index';
		$this->load->view('layouts/secure', $data);
		$this->load->view('layouts/default', $data);
	}
}

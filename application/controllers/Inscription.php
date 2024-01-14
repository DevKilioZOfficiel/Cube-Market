<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscription extends CI_Controller {

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


	public function index(){
		if ($this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Inscription";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);

        if (isset($_POST['inscription'])){
            $this->load->helper('security');
            $this->form_validation->set_rules('pseudo', 'Pseudo', 'trim|required|min_length[3]|max_length[30]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[6]|max_length[25]');
	        $this->form_validation->set_rules('repeat-password', 'Confirmation du Mot de passe', 'trim|required|min_length[6]|max_length[25]|matches[password]');

            if ($this->form_validation->run() == false) {
                $data['notif_r']['message'] = validation_errors();
                $data['notif_r']['type'] = 'danger';
            }else {
                $data['notif_r'] = $this->auth_model->register();
            }
        }
        $data["content"] = 'inscription/index';
		$this->load->view('layouts/secure', $data);
		$this->load->view('layouts/default', $data);
	}
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deconnexion extends CI_Controller {

    function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->database();
        $this->load->model('auth_model');
        $this->load->model('sessioncheck_model');
        $this->load->model('permissions_model');
		$this->load->helper('text');
    }

    /**
     *     Sara1984
     */
    public function index() {
$this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect(base_url('connexion'));
    }

}

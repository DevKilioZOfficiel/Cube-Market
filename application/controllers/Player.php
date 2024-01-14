<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player extends CI_Controller {

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
		$this->load->helper('text');
    }


	public function index($player = FALSE){
		$data['player'] = $this->sessioncheck_model->info_user_minecraft($player);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if(empty($data['player'])){
      $data['title'] = "Joueurs";
      $data['description'] = "Rechercher un utilisateur";
      $data['image'] = "";
	  
	    if($data['permission']['beta_access'] == 0){
			redirect(base_url('boutique/#no_beta_access'));
		}
	  
      $data["content"] = 'player/search';
      $this->load->view('layouts/secure', $data);
      $this->load->view('layouts/default', $data);
		}else{
      if(empty($player)){
        $data['title'] = "Joueurs";
	   		$data['description'] = "Rechercher un utilisateur";
	   		$data['image'] = "";
	   		$data["content"] = 'player/search';
	   		$this->load->view('layouts/secure', $data);
	   		$this->load->view('layouts/default', $data);
      }else{
	   		$data['title'] = $data['player']['pseudo'];
	   		$data['description'] = "Sans description...";
	   		$data['image'] = "";
	   		$data["content"] = 'player/index';
	   		$this->load->view('layouts/secure', $data);
	   		$this->load->view('layouts/default', $data);
      }
	}
	}
  public function api__search(){
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
	  $this->load->view('player/api__search', $data);
	}
}

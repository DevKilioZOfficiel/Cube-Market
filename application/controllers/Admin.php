<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1){
            $data["content"] = 'admin/index';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	public function users(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT_USER'] == 1){
            $data["content"] = 'admin/users';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	public function staff(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT_USER'] == 1){
            $data["content"] = 'admin/staff';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function configs_site(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_CONFIGURATION_SITE'] == 1){
            $data["content"] = 'admin/configs_site';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	public function navigation(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_CONFIGURATION_SITE'] == 1){
            $data["content"] = 'admin/navigation';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function servers(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_CONFIGURATION_SITE'] == 1){
            $data["content"] = 'admin/servers';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function reunions(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_CONFIGURATION_SITE'] == 1){
            $data["content"] = 'admin/reunions';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function create_reunions(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_CONFIGURATION_SITE'] == 1){
            $data["content"] = 'admin/create_reunions';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function permissions(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_CONFIGURATION_SITE'] == 1){
            $data["content"] = 'admin/permissions';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	// BOUTIQUE
	
	public function store(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__PRODUCT'] == 1){
            $data["content"] = 'admin/store';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function product($product = FALSE){
		$data['product'] = $this->sessioncheck_model->info_product_minecraft($product);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__PRODUCT'] == 1){
		if(empty($data['product'])){
			redirect(base_url('admin/store/#Not_Found'));
            exit;
		}else{
            if(empty($product)){
		        redirect(base_url('admin/store/#Not_Found'));
                exit;
            }else{
	    		$data['title'] = "Panel Admin";
	    		$data['description'] = "";
	    		$data['image'] = "";
	    		$data["content"] = 'admin/store_product';
	    		$this->load->view('layouts/secure', $data);
	       		$this->load->view('layouts/default__admin', $data);
            }
	    }
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	
	public function store_category(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__PRODUCT'] == 1){
            $data["content"] = 'admin/store_category';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	public function store_subcategory(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__PRODUCT'] == 1){
            $data["content"] = 'admin/store_subcategory';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	public function store_add(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__PRODUCT'] == 1){
            $data["content"] = 'admin/store_add';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
		// NEWS
	
	public function news(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_ADD_NEWS'] == 1){
            $data["content"] = 'admin/news';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function news__add(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_ADD_NEWS'] == 1){
            $data["content"] = 'admin/news__add';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function news_id($id = FALSE){
		$data['news'] = $this->sessioncheck_model->info_news($id);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_ADD_NEWS'] == 1){
		if(empty($data['news'])){
			redirect(base_url('admin/news/#Not_Found'));
            exit;
		}else{
            if(empty($product)){
		        redirect(base_url('admin/news/#Not_Found'));
                exit;
            }else{
	    		$data['title'] = "Panel Admin";
	    		$data['description'] = "";
	    		$data['image'] = "";
	    		$data["content"] = 'admin/news_new';
	    		$this->load->view('layouts/secure', $data);
	       		$this->load->view('layouts/default__admin', $data);
            }
	    }
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	//VOTER
	public function votes(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__VOTE'] == 1){
            $data["content"] = 'admin/votes';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	public function votes_sites(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__VOTE'] == 1){
            $data["content"] = 'admin/votes_sites';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	public function votes_rewards(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT__VOTE'] == 1){
            $data["content"] = 'admin/votes_rewards';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	
	public function ajax__reunion(){
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1){
	        $this->load->view('admin/ajax__reunion', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	
	public function page(){
		
		if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
		
		$data['title'] = "Panel Admin";
		$data['description'] = "Sans description...";
		$data['image'] = "";
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_PAGE'] == 1){
            $data["content"] = 'admin/page';
	        $this->load->view('layouts/secure', $data);
	        $this->load->view('layouts/default__admin', $data);
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
	
	public function page_edit($page = FALSE){
		$data['page'] = $this->sessioncheck_model->info_page($page);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if($data['permission']['is_admin'] == 1 && $data['permission']['PERM__ADM_EDIT_PAGE'] == 1){
		if(empty($data['page'])){
			redirect(base_url('admin/store/#Not_Found'));
            exit;
		}else{
            if(empty($page)){
		        redirect(base_url('admin/store/#Not_Found'));
                exit;
            }else{
	    		$data['title'] = "Panel Admin";
	    		$data['description'] = "";
	    		$data['image'] = "";
	    		$data["content"] = 'admin/page_edit';
	    		$this->load->view('layouts/secure', $data);
	       		$this->load->view('layouts/default__admin', $data);
            }
	    }
		}else{
			redirect(base_url('admin/#no_permission'));
		}
	}
}

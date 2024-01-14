<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */

    public function Authentification() {
        $notif = array();
        $pseudo = $this->input->post('pseudo');
        $password = sha1($this->input->post('pass1'));
		//$code = $this->input->post('code');

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('pseudo', $pseudo);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $row = $query->row();
                $sess_data = array(
                    'id' => $row->id,
                    'pseudo' => $row->pseudo
                );
                $this->session->set_userdata('logged_in', $sess_data);
                $this->update_last_login($row->id);
				$_SESSION['id'] = $row->id;
				$_SESSION['pseudo'] = $row->pseudo;
				$_SESSION['last_login'] = $row->last_login;
            
			$notif['message'] = 'Succès! Vous êtes connecté !';
            $notif['type'] = 'success';
        } else {
            $notif['message'] = 'Erreur: Le pseudo ou le mot de passe est incorrecte !';
            $notif['type'] = 'danger';
        }

        return $notif;
    }

    /*
     * 
     */

    private function update_last_login($users_id) {
        $sql = "UPDATE user SET last_login = NOW() WHERE id=" . $this->db->escape($users_id);
        $this->db->query($sql);
    }

    /*
     * 
     */

	public function get_ip() {
	// IP si internet partagé
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
	// IP derrière un proxy
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	// Sinon : IP normale
		else {
			return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
		}
	}
	
	
    public function register() {
		$this->load->helper('url');
        $notif = array();
		
		
		$this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('pseudo', $this->input->post('pseudo'));
        $this->db->limit(1);
		$query = $this->db->get();
		
        if ($query->num_rows() == 0) {
        $data = array(		
            'pseudo' => $this->input->post('pseudo'),
            'email' => $this->input->post('email'),
            'password' => sha1($this->input->post('repeat-password')),
			'ip' => $_SERVER['REMOTE_ADDR'],
			'url' => url_title($this->input->post('pseudo'), 'dash', TRUE)
        );
        $this->db->insert('user', $data);
				
				
                $notif['message'] = 'Inscription avec succès !';
                $notif['type'] = 'success';
		}else{
			$notif['message'] = 'Erreur: Ce compte existe déjà !';
                $notif['type'] = 'danger';
		}
            unset($_POST);
        
        return $notif;
    }
	
	
	public function register_devtime() {
		$this->load->helper('url');
        $notif = array();
		
		$json = file_get_contents("https://dev-time.eu/api/api__secure__login?slug=".$this->input->post('password')."");

		$parsed_json = json_decode($json);
		if($parsed_json->{'data'}->{'code_type'} == "OK"){
		$pseudo = $parsed_json->{'data'}->{'pseudo'};
		$error = "";
		}else{
			$pseudo = "";
			$error = $parsed_json->{'data'}->{'error'};
		}
		
		$json_api_login = file_get_contents("https://dev-time.eu/api/api__login?slug=".$pseudo."");

		$parsed_json_api_login = json_decode($json_api_login);
		if($parsed_json->{'data'}->{'code_type'} == "OK"){
		$pseudo_api_login = $parsed_json_api_login->{'data'}->{'pseudo'};
		$avatar_api_login = $parsed_json_api_login->{'data'}->{'avatar'};
		$error_api_login = "";
		}else{
			$pseudo_api_login = "";
			$avatar_api_login = "";
			$error_api_login = $parsed_json_api_login->{'data'}->{'error'};
		}
		
		$this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('pseudo', $this->input->post('last_name'));
        $this->db->limit(1);
		$query = $this->db->get();
		
        if ($query->num_rows() == 0) {
			
		if($error == ""){
		if($error_api_login == ""){			
        $data = array(		
            'email' => $this->input->post('email'),
			'image' => $avatar_api_login,
            'pseudo' => $this->input->post('last_name'),
            'mdp' => sha1($this->input->post('password')),
			'ip' => $_SERVER['REMOTE_ADDR'],
            'etat' => 0,
			'date_petit' => date('Y-m'),
			'annee' => date('Y'),
			'mois' => date('m'),
			'jour' => date('d'),
			'url' => url_title($this->input->post('last_name'), 'dash', TRUE),
			'devtime_id' => $pseudo_api_login
        );
        $this->db->insert('user', $data);
				
				
                $notif['message'] = 'Inscription avec succès !';
                $notif['type'] = 'success';
		}else{ 
		        $notif['message'] = $error_api_login;
                $notif['type'] = 'danger';
		}
		}else{ 
		        $notif['message'] = $error;
                $notif['type'] = 'danger';
		}
		}else{
			$notif['message'] = 'Erreur: Ce compte existe déjà !';
                $notif['type'] = 'danger';
		}
            unset($_POST);
        
        return $notif;
    }

    /*
     * 
     */

    public function check_email($email) {
        $sql = "SELECT * FROM user WHERE email = " . $this->db->escape($email);
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row;
        }
        return null;
    }

}

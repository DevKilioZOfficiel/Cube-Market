<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Permissions_model extends CI_Model{
		
        public function __construct()
        {
                $this->load->database();
        }
		public function count($table){
            return $this->db->count_all($table);
        }
		public function get_permissions($id = FALSE){
            if ($id === FALSE){
                $query = $this->db->get('permissions');
                return $query->result_array();
            }
        	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
        	//return $query->result();
			$query = $this->db->get_where('permissions', array('id_grade' => $id));
            return $query->row_array();
    	}
		
		public function get_permissions__list($id = FALSE){
            if ($id === FALSE){
                $query = $this->db->get('permissions');
                return $query->result_array();
            }
        	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
        	//return $query->result();
			$this->db->select($id);
            $query = $this->db->get('permissions');
            return $query->result_array();
    	}
		
		public function get_permissions__list2($name = FALSE, $id = FALSE){
            if ($id === FALSE && $name === FALSE){
                $query = $this->db->get('permissions');
                return $query->result_array();
            }
        	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
        	//return $query->result();
			$this->db->select($name);
			$this->db->where('id',$id);
            $query = $this->db->get('permissions');
            return $query->result_array();
    	}
		
		
		
		public function get_config($id = FALSE){
            if ($id === FALSE){
                $query = $this->db->get('config');
                return $query->result_array();
            }
        	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
        	//return $query->result();
			$query = $this->db->get_where('config', array('name' => $id));
            return $query->row_array();
    	}
		
		public function NotificationsPush($english_title,$french_title,$english_message,$french_message,$app_id,$segments){
		$content = array(
			"en" => $english_message,
			"fr" => $french_message
		);
			
		$title = array(
			"en" => $english_title,
			"fr" => $french_title
		);
		
		$hashes_array = array();
		    array_push($hashes_array, array(
		        "id" => "dev-time",
		        "text" => "Notre site",
		        "icon" => "https://statics.dev-time.eu/images/devtimee/devtime-icon.png",
		        "url" => "https://dev-time.eu/"
 		   ));
 		   array_push($hashes_array, array(
 		       "id" => "like-button-2",
 		       "text" => "Se connecter",
 		       "icon" => "https://statics.dev-time.eu/images/devtimee/devtime-icon.png",
 		       "url" => "https://dev-time.eu/auth/login"
 		   ));
		
		$fields = array(
			'app_id' => $app_id,
			'included_segments' => array($segments),
			'data' => array("foo" => "bar"),
			'headings' => $title,
			'contents' => $content,
			'web_buttons' => $hashes_array
		);
		
		$fields = json_encode($fields);
    	//print("\nJSON sent:\n");
    	//print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic Y2VhM2IwYjAtYzBjZi00NGFmLWIyOTQtNGEwNjAyMjFmMDY2'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		//return $response;
	}
		
		
    }
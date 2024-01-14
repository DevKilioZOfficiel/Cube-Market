<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Sessioncheck_model extends CI_Model{
		
        public function __construct()
        {
                $this->load->database();
        }
		public function count($table){
            return $this->db->count_all($table);
        }
		public function user_info($id){
		    $query = $this->db->get_where("user WHERE id = '$id'");
            return $query->row_array();
		}
		public function get_user($id = FALSE){
            if ($id === FALSE){
                $query = $this->db->get('user');
                return $query->result_array();
            }
        	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
        	//return $query->result();
			$query = $this->db->get_where('user', array('id' => $id));
            return $query->row_array();
    	}	
	
	
	public function info_user($id = FALSE){
            if ($id === FALSE){
                $query = $this->db->get('user');
                return $query->result_array();
            }
        	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
        	//return $query->result();
			$query = $this->db->get_where('user', array('url' => $id));
            return $query->row_array();
    	}
		
	public function certified_member($id = FALSE){
            if ($id === FALSE){
                $query = $this->db->get('user');
                return $query->result_array();
            }
        	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
        	//return $query->result();
			$query = $this->db->get_where('user', array('pseudo' => $id));
            $donnees = $query->row_array();
			
			if($donnees['certified'] == 1){
				return "<span data-toggle='myToolTip' data-placement='top' title='Ce compte est vérifié par Dev-Time'><i class='far fa-badge-check' style='color: #33FFFF;'></i></span>";
			}else{
				
			}
    	}
		
    	public function info_user_minecraft($id = FALSE){
                if ($id === FALSE){
                    $query = $this->db->get('user');
                    return $query->result_array();
                }
            	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
            	//return $query->result();
    			$query = $this->db->get_where('user', array('pseudo' => $id));
                return $query->row_array();
        	}
			
			
			public function info_page($id = FALSE){
                if ($id === FALSE){
                    $query = $this->db->get('page');
                    return $query->result_array();
                }
            	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
            	//return $query->result();
    			$query = $this->db->get_where('page', array('url' => $id));
                return $query->row_array();
        	}
			
		public function info_product_minecraft($id = FALSE){
                if ($id === FALSE){
                    $query = $this->db->get('products__list');
                    return $query->result_array();
                }
            	//$query = $this->db->query("SELECT * FROM user WHERE id = '".$id."'");
            	//return $query->result();
    			$query = $this->db->get_where('products__list', array('url' => $id));
                return $query->row_array();
        	}
		
		
		// ADMIN
		
		public function LastInscrit(){
                $query = $this->db->select('*')
                //->where('slug', $slug)
				->order_by('id', 'DESC')
                ->limit(5)
                ->get('user');
                return $query->result_array();
        }
		public function Staff(){
                $query = $this->db->select('*')
				->order_by('id', 'DESC')
                //->limit(5)
                ->get('user');
                return $query->result_array();
        }
		
		public function Inscrits(){
		    return $this->db->count_all('user');
		}
		public function Stats($type){
		    if($type = "Month"){
				$this->db->like('date', ''.date('Y').'-'.date('m').'');
				$this->db->from('user');
				return  $this->db->count_all_results();
		    }	
		}
	
	public function Statistiques_vues($url,$ip) {
		$this->load->helper('url');
		$notif = array();
		
			$this->db->select('*');
        	$this->db->from('views');
			$this->db->where('url', $url);
        	$this->db->where('ip', $ip);
        	$this->db->limit(1);
			$query2 = $this->db->get();
				if ($query2->num_rows() == 0) {
				$data2 = array(
				    'url' => $url,
					'ip' => $ip,
					'date_petit' => "".date('Y')."-".date('m')."",
					'mois' => date('m'),
					'jour' => date('d'),
					'annee' => date('Y')
        		);
		
						$this->db->insert('views', $data2); 
				}else{
				}
	}
    }
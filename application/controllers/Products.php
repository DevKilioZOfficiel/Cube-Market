<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

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
		$this->load->helper('download');
    }


	public function index(){
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
        $data['title'] = "Nos produits";
	   	$data['description'] = "Découvrez notre boutique";
	   	$data['image'] = "";
	   	$data["content"] = 'boutique/index';
	   	$this->load->view('layouts/secure', $data);
	   	$this->load->view('layouts/default', $data);
	}

	public function p($product = FALSE){
		$data['product'] = $this->sessioncheck_model->info_product_minecraft($product);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if(empty($data['product'])){
			redirect(base_url('boutique'));
            exit;
		}else{
            if(empty($product)){
		        redirect(base_url('boutique'));
                exit;
            }else{
	    		$data['title'] = $data['product']['title'];
	    		$data['description'] = $data['product']['description'];
	    		$data['image'] = $data['product']['image'];
	    		$data["content"] = 'boutique/product';
	    		$this->load->view('layouts/secure', $data);
	       		$this->load->view('layouts/default', $data);
            }
	    }
	}
    public function paypal($product = FALSE){
		$data['product'] = $this->sessioncheck_model->info_product_minecraft($product);
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		if(empty($data['product'])){
			redirect(base_url('boutique'));
            exit;
		}else{
            if(empty($product)){
		        redirect(base_url('boutique'));
                exit;
            }else{
	    		$data['title'] = $data['product']['title'];
	    		$data['description'] = $data['product']['description'];
	    		$data['image'] = $data['product']['image'];
	    		$this->load->view('layouts/secure', $data);
	       		$this->load->view('boutique/paypal', $data);
            }
	    }
	}

    public function payement(){
		//$data['product'] = $this->sessioncheck_model->info_product_minecraft__id($this->input->get('pid'));
		$data['user'] = $this->sessioncheck_model->get_user($this->session->userdata('id'));
		$data['permission'] = $this->permissions_model->get_permissions($data['user']['grade']);
		
		
		if(!empty($this->input->get('paymentID')) && !empty($this->input->get('payerID')) && !empty($this->input->get('token')) && !empty($this->input->get('pid'))){
			$this->db->where('id', $this->input->get('pid'));
			$query = $this->db->get('products__list');

			foreach ($query->result() as $row){
			$this->db->where('id', $row->user);
			$query__user = $this->db->get('user');

			foreach ($query__user->result() as $row__user){
				
				
				$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.paypal.com/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $row__user->paypal__client.":".$row__user->paypal__secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
		//echo "response:<br>";
		//echo $response;
        curl_close($ch);
        
        if(empty($response)){
            echo "Erreur...";
        }else{
            $jsonData = json_decode($response);
            $curl = curl_init('https://api.paypal.com/v1/payments/payment/'.$this->input->get('paymentID'));
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
			//echo "<br>response 2:<br>";
			//echo $response;
            curl_close($curl);
            
            // Transaction data
            $result = json_decode($response);
			
			foreach ($result->transactions as $transactions){
				foreach($transactions->related_resources as $related_resources){
		        	if($related_resources->sale->state == "completed"){
			    $data = array(
        		    'user' => $data['user']['id'],
         		   'product_id' => $this->input->get('pid'),
        		    'paymentID' => $this->input->get('paymentID'),
					'payerID' => $this->input->get('payerID'),
					'token' => $this->input->get('token'),
					'price' => $this->input->get('price')
        		);
        		$this->db->insert('paiement__paypal', $data);
		
		
				$data__payement = array(
				    'id_product' => $this->input->get('pid'),
				    'user' => $data['user']['id'],
				    'price' => $this->input->get('price'),
				    'type' => "PAYEMENT",
				    'product__version' => "1.0.0"
				);
				$this->db->insert('products__payements', $data__payement);
		
				redirect('parametres?paypal=success?paymentID='.$this->input->get('paymentID'));
					
			       	}else{
			          	echo "Erreur 400";
			       	}
				}
			}
        }
			}
			}
			
			}else{
				echo "Erreur 401";
			}
		
	}	
	
}

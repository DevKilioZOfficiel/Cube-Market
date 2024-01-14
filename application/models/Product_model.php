<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Product_model extends CI_Model{
		
        public function __construct()
        {
                $this->load->database();
        }
		public function image(){
			$notif = array();
			$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $config['upload_path']          = './uploads/images/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048; //2Mo
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')){
				$notif['message'] = "L'image n'est pas uploadée suite à une extension non autorisée ou la taille du fichier";
                $notif['type'] = "error";
            }else{
				$notif['message'] = "L'image est uploadée avec succès";
                $notif['type'] = "success";
				$notif['file'] = $this->upload->data('file_name');				
            }
			return $notif;
        }
		public function product(){
			$notif = array();
			$this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $config['upload_path']          = './uploads/produits/';
            $config['allowed_types']        = 'zip';
            $config['max_size']             = 500125; //500Mo
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('product')){
				$notif['message'] = "Le fichier n'est pas uploadé suite à une extension non autorisée ou la taille du fichier";
                $notif['type'] = "error";
            }else{
				$notif['message'] = "Fichier uploadé avec succès";
                $notif['type'] = "success";
                $notif['file'] = $this->upload->data('file_name');
            }
			return $notif;
        }
		
    }
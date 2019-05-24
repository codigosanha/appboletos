<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
	}
	public function index()
	{
		if ($this->session->userdata("login")) {
			if ($this->session->userdata("rol") == 1) {
				redirect(base_url()."dashboard", "refresh");
			}
			redirect(base_url()."gestionar/ventas");
		}
		else{
			$this->load->view("backend/login");
		}
		

	}

	public function login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$res = $this->Usuarios_model->login($username, sha1($password));

		if (!$res) {
			$this->session->set_flashdata("error","El usuario y/o contraseña son incorrectos");
			redirect(base_url());
		}
		else{
			$data  = array(
				'id' => $res->id, 
				'nombre' => $res->nombres,
				'rol' => $res->rol_id,
				'terminal' => $res->terminal_id,
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			if ($res->rol_id == 1) {
				redirect(base_url()."dashboard");
			}else{
				$permiso = $this->Backend_model->getPermiso($res->rol_id);
				redirect(base_url().$permiso->link);
			}
			
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

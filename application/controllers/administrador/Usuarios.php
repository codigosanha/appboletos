<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Usuarios_model");
		$this->load->model("Terminales_model");
	}

	public function index()
	{
		$contenido_interno  = array(
			'usuarios' => $this->Usuarios_model->getUsuarios(), 
			'permisos' => $this->permisos,
		);
		$contenido_exterior = array(
            'title'     => 'Usuarios',
            'contenido' => $this->load->view('backend/usuarios/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function add()
	{
		$contenido_interno  = array(
			'roles' => $this->Usuarios_model->getRoles(),
			'terminales' => $this->Terminales_model->getTerminales(), 
		);
		$contenido_exterior = array(
            'title'     => 'Usuarios',
            'contenido' => $this->load->view('backend/usuarios/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function store(){

		$nombres = $this->input->post("nombres");
		$apellidos = $this->input->post("apellidos");
		$telefono = $this->input->post("telefono");
		$dni = $this->input->post("dni");
		$email = $this->input->post("email");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$rol = $this->input->post("rol");
		$terminal = $this->input->post("terminal");

		$data  = array(
			'nombres' => $nombres, 
			'apellidos' => $apellidos,
			'dni' => $dni,
			'telefono' => $telefono,
			'email' => $email,
			'username' => $username,
			'password' => sha1($password),
			'rol_id' => $rol,
			'terminal_id' => $terminal,
			
		);

		if ($this->Usuarios_model->save($data)) {
			redirect(base_url()."administrador/usuarios");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/usuarios/add");
		}

		
	}

	public function view(){
		$idusuario = $this->input->post("idusuario");
		$data = array(
			"usuario" => $this->Usuarios_model->getUsuario($idusuario)
		);
		$this->load->view("admin/usuarios/view",$data);
	}

	public function edit($id)
	{
		$contenido_interno  = array(
			'roles' => $this->Usuarios_model->getRoles(), 
			'usuario' => $this->Usuarios_model->getUsuario($id),
			'terminales' => $this->Terminales_model->getTerminales(),
		);
		$contenido_exterior = array(
            'title'     => 'usuarios',
            'contenido' => $this->load->view('backend/usuarios/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function update(){
		$idusuario = $this->input->post("idusuario");
		$nombres = $this->input->post("nombres");
		$apellidos = $this->input->post("apellidos");
		$dni = $this->input->post("dni");
		$telefono = $this->input->post("telefono");
		$email = $this->input->post("email");
		$username = $this->input->post("username");

		$rol = $this->input->post("rol");
		$terminal = $this->input->post("terminal");


		$data  = array(
			'nombres' => $nombres, 
			'apellidos' => $apellidos,
			'dni' => $dni,
			'telefono' => $telefono,
			'email' => $email,
			'username' => $username,
			'terminal_id' => $terminal,
			'rol_id' => $rol,
		);

		if ($this->Usuarios_model->update($idusuario,$data)) {
			redirect(base_url()."administrador/usuarios");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/usuarios/edit/".$idusuario);
		}

		
	}

	public function delete($id)
	{
		/*if ($this->Usuarios_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "administrador/usuarios";
        } 
*/
        $data  = array(
            'estado' => "0", 
        );
        $this->Usuarios_model->update($id,$data);
        echo "administrador/usuarios";
	}

	public function changepassword(){
		$id = $this->input->post("idusuario");
		$newpassword = $this->input->post("newpassword");
		$repeatpassword = $this->input->post("repeatpassword");
		$data = array(
			"password" => sha1($newpassword)
		);

		if ($this->Usuarios_model->update($id,$data)) {
			echo "administrador/usuarios";
		}

	}

}
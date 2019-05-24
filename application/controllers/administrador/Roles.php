<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Roles_model");
	}

	public function index()
	{
		$contenido_interno  = array(
			'roles' => $this->Roles_model->getRoles(), 
			'permisos' => $this->permisos,
		);
		$contenido_exterior = array(
            'title'     => 'roles',
            'contenido' => $this->load->view('backend/roles/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function add()
	{
		$contenido_exterior = array(
            'title'     => 'roles',
            'contenido' => $this->load->view('backend/roles/add', '', true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$data  = array(
			'nombre' => $nombre, 
			'descripcion' => $descripcion,
			
		);

		if ($this->Roles_model->save($data)) {
			redirect(base_url()."administrador/roles");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/roles/add");
		}

		
	}


	public function edit($id)
	{
		$contenido_interno  = array(
			'rol' => $this->Roles_model->getRol($id),
		);
		$contenido_exterior = array(
            'title'     => 'roles',
            'contenido' => $this->load->view('backend/roles/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function update(){
		$idrol = $this->input->post("idrol");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$data  = array(
			'nombre' => $nombre, 
			'descripcion' => $descripcion,
		);

		if ($this->Roles_model->update($idrol,$data)) {
			redirect(base_url()."administrador/roles");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/roles/edit/".$idrol);
		}

		
	}

	public function delete($id)
	{
		if ($this->Roles_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "administrador/roles";
        } 
	}

}
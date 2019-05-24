<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Permisos_model");
		$this->load->model("Roles_model");
	}

	public function index(){

		$contenido_interno  = array(
			'permisos' => $this->Permisos_model->getPermisos(),
			'permits' => $this->permisos,
		);
		$contenido_exterior = array(
            'title'     => 'Roles',
            'contenido' => $this->load->view('backend/permisos/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function add(){
		$contenido_interno  = array(
			'roles' => $this->Roles_model->getRoles(), 
			'menus' => $this->Permisos_model->getMenus(), 
		);
		$contenido_exterior = array(
            'title'     => 'Roles',
            'contenido' => $this->load->view('backend/permisos/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function store(){
		$menu = $this->input->post("menu");
		$rol = $this->input->post("rol");
		$insert = $this->input->post("insert");
		$read = $this->input->post("read");
		$update = $this->input->post("update");
		$delete = $this->input->post("delete");

		$data = array(
			"menu_id" => $menu,
			"rol_id" => $rol,
			"read" => $read,
			"insert" => $insert,
			"update" => $update,
			"delete" => $delete,
		);

		if ($this->Permisos_model->save($data)) {
			redirect(base_url()."administrador/permisos");
		}else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrado/permisos/add");
		}
		
	}

	public function edit($id){

		$contenido_interno  = array(
			'roles' => $this->Roles_model->getRoles(), 
			'menus' => $this->Permisos_model->getMenus(), 
			'permiso' => $this->Permisos_model->getPermiso($id)
		);
		$contenido_exterior = array(
            'title'     => 'Permisos',
            'contenido' => $this->load->view('backend/permisos/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function update(){
		$idpermiso = $this->input->post("idpermiso");
		$menu = $this->input->post("menu");
		$rol = $this->input->post("rol");
		$insert = $this->input->post("insert");
		$read = $this->input->post("read");
		$update = $this->input->post("update");
		$delete = $this->input->post("delete");

		$data = array(
			"read" => $read,
			"insert" => $insert,
			"update" => $update,
			"delete" => $delete,
		);

		if ($this->Permisos_model->update($idpermiso,$data)) {
			redirect(base_url()."administrador/permisos");
		}else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/permisos/edit/".$idpermiso);
		}
	}

	public function delete($id){

		if ($this->Permisos_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "administrador/permisos";
        } 
	}
}
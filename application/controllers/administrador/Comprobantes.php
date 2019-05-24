<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprobantes extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Comprobantes_model");
		$this->load->model("Terminales_model");

	}

	public function index()
	{
		$contenido_interno  = array(
			'comprobantes' => $this->Comprobantes_model->getComprobantes(), 
			'permisos' => $this->permisos,
		);
		$contenido_exterior = array(
            'title'     => 'Comprobantes',
            'contenido' => $this->load->view('backend/comprobantes/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function add()
	{
		$contenido_interno  = array(
			'terminales' => $this->Terminales_model->getTerminales(), 
			'tipocomprobantes' => $this->Comprobantes_model->getTipoComprobantes(), 
			'permisos' => $this->permisos,
		);
		$contenido_exterior = array(
            'title'     => 'Agregar Comprobante',
            'contenido' => $this->load->view('backend/comprobantes/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function store(){

		$terminal = $this->input->post("terminal");
		$tipocomprobante = $this->input->post("tipocomprobante");
		$serie = $this->input->post("serie");
		$igv = $this->input->post("igv");

		$data  = array(
			'terminal_id' => $terminal, 
			'tipo_comprobante_id' => $tipocomprobante, 
			'serie' => $serie,
			'cantidad' => 0,
			'igv' => $igv
			
		);

		if ($this->Comprobantes_model->save($data)) {
			redirect(base_url()."administrador/comprobantes");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/comprobantes/add");
		}

		
	}

	public function edit($id)
	{
		$contenido_interno  = array(
			'comprobante' => $this->Comprobantes_model->getComprobante($id), 
			'terminales' => $this->Terminales_model->getTerminales(), 
			'tipocomprobantes' => $this->Comprobantes_model->getTipoComprobantes()
			
		);
		$contenido_exterior = array(
            'title'     => 'Editar Comprobantes',
            'contenido' => $this->load->view('backend/comprobantes/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}

	public function update(){
		$idcomprobante = $this->input->post("idcomprobante");
		$terminal = $this->input->post("terminal");
		$tipocomprobante = $this->input->post("tipocomprobante");
		$serie = $this->input->post("serie");
		$igv = $this->input->post("igv");

		$data  = array(
			'terminal_id' => $terminal, 
			'tipo_comprobante_id' => $tipocomprobante,  
			'serie' => $serie,
			'igv' => $igv

		);

		if ($this->Comprobantes_model->update($idcomprobante,$data)) {
			redirect(base_url()."administrador/comprobantes");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."administrador/comprobantes/edit/".$idcomprobante);
		}

		
	}

	public function delete($id)
	{
		if ($this->Comprobantes_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "administrador/comprobantes";
        } 
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas2 extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Ventas_model");
	}

	public function index()
	{
	
		$fechainicio = $this->input->post("fechainicio");
		$fechafin = $this->input->post("fechafin");

		if ($this->input->post("buscar")) {
			$ventas = $this->Ventas_model->getVentas($fechainicio,$fechafin);
		}
		else{
			$ventas = $this->Ventas_model->getVentas();
		}

		$contenido_interno = array(
			"ventas" => $ventas,
			"fechainicio" => $fechainicio,
			"fechafin" => $fechafin
		);

		$contenido_exterior = array(
            'title'     => 'Reportes de Ventas',
            'contenido' => $this->load->view('backend/reportes/ventas2', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}
}
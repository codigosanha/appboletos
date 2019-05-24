<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasajeros extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Pasajeros_model");
		$this->load->model("Rutas_model");
		$this->load->model("Viajes_model");
		$this->load->model("Ventas_model");
	}

	public function index()
	{
	
		$fecha = $this->input->post("fecha");
		$ruta = $this->input->post("ruta");
		$hora = $this->input->post("horas");
		
		if ($this->input->post("buscar")) {
			$viaje = $this->Pasajeros_model->getViaje($ruta,$fecha,$hora);
			if (!$viaje) {
				$pasajeros = "";
			}else{
				$pasajeros = $this->Ventas_model->getPasajeros($viaje->id);
			}
			
		}
		else{
			$pasajeros = $this->Ventas_model->getPasajeros();
		}

		$contenido_interno = array(
			"pasajeros" => $pasajeros,
			"ruta_e" => $ruta,
			"fecha" => $fecha,
			"hora" => $hora,
			"rutas" => $this->Rutas_model->getRutas(),
		);

		$contenido_exterior = array(
            'title'     => 'Reportes de Pasajeros',
            'contenido' => $this->load->view('backend/reportes/pasajeros', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
	}
}
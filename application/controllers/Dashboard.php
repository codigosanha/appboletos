<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    private $permisos;
    public function __construct()
    {
        parent::__construct();
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Usuarios_model");
        $this->load->model("Buses_model");
        $this->load->model("Terminales_model");
        $this->load->model("Usuarios_model");
        $this->load->model("Ventas_model");

    }

    public function index()
    {   
        $contenido_interno  = array(
		    "cantUsuarios" => $this->Backend_model->rowCount("usuarios"),
			"cantTerminales" => $this->Backend_model->rowCount("terminales"),
            "cantBuses" => $this->Backend_model->rowCount("buses"),
            "cantConductores" => $this->Backend_model->rowCount("choferes"),
            "cantVentas" => $this->Backend_model->rowCount("ventas"),
            "cantPasajeros" => $this->Backend_model->rowCount("pasajeros"),
            'years' => $this->Ventas_model->years(),
            "ventas" => $this->Ventas_model->getVentasDashboard(),
            "salidas" => $this->Backend_model->cantidadsalidas(),
        );
        $data = array(
            'title'     => 'Tablero Principal',
            'contenido' => $this->load->view('backend/dashboard', $contenido_interno, true),
        );

        $this->load->view('backend/template', $data);
    }

    public function getData(){
        $year = $this->input->post("year");
        $resultados = $this->Ventas_model->montos($year);
        echo json_encode($resultados);
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafico extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
   
        $this->load->model("Ventas_model");

    }

	public function getData(){
        $year = $this->input->post("year");
        $resultados = $this->Ventas_model->montos($year);
        echo json_encode($resultados);
    }
}

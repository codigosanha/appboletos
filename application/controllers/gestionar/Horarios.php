<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Horarios extends CI_Controller
{
    private $permisos;
	public function __construct()
    {
        parent::__construct();
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Buses_model");
        $this->load->model("Rutas_model");
        $this->load->model("Ventas_model");
        $this->load->model("Choferes_model");
        $this->load->model("Viajes_model");
        $this->load->model("Comprobantes_model");
    }

    public function registrar(){
        $rutas = $this->input->post("rutah");
        $fechas = $this->input->post("fechah");
        $horas = $this->input->post("horah");
        $buses = $this->input->post("bush");
        $choferes = $this->input->post("choferh");
        $copilotos = $this->input->post("copilotoh");

        for ($i=0; $i < count($rutas); $i++) { 
            $data  = array(
                "ruta_id" => $rutas[$i],
                "fecha" => $fechas[$i],
                "hora" => $horas[$i],
                "bus_id" => $buses[$i],
                "chofer_id" => $choferes[$i],
                "copiloto_id" => $copilotos[$i],
            );
            $this->Viajes_model->save($data);
        }
        redirect(base_url()."gestionar/horarios");
    }

    public function index(){
    	$contenido_interno = array(
            'viajes' => $this->Viajes_model->getViajes(),
            'permisos' => $this->permisos,

        );

        $contenido_exterior = array(
            'title'     => 'Viajes',
            'contenido' => $this->load->view('backend/viajes/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {

        $contenido_interno = array(
            'rutas' => $this->Rutas_model->getRutas(),
            'buses' => $this->Buses_model->getBuses(),
            'choferes' => $this->Choferes_model->getChoferes(),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Viaje',
            'contenido' => $this->load->view('backend/viajes/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function store()
    {
        $ruta = $this->input->post("rutah");
        $fecha = $this->input->post("fechah");
        $hora = $this->input->post("horah");
        $bus = $this->input->post("bush");
        $chofer = $this->input->post("choferh");
        $copiloto = $this->input->post("copilotoh");
        //consultar la existencia del bus y chofer
        $data = array();
        if ($this->Viajes_model->ve_chofer($fecha,$hora,$chofer) !== false) {
            $data[] = "El chofer ya fue seleccionado a esa fecha y hora";
        }
        if ($this->Viajes_model->ve_bus($fecha,$hora,$bus) !== false) {
            $data[] = "El bus ya fue seleccionado a esa fecha y hora";
        }

        if ($this->Viajes_model->ve_copiloto($fecha,$hora,$copiloto) !== false) {
            $data[] = "El copiloto ya fue seleccionado a esa fecha y hora";
        }

        if (!empty($data)) {
            echo json_encode($data);
        }
        else{
            $datos = [
                "ruta_id" => $ruta,
                "fecha" => $fecha,
                "hora" => $hora,
                "bus_id" => $bus,
                "chofer_id" => $chofer,
                "copiloto_id" => $copiloto,
            ];
            if ($this->Viajes_model->save($datos)) {
                //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
                echo "1";
            } else {
                //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
                echo "0";
            }
        }
        
        
        
    }

    public function edit($id)
    {

        $contenido_interno = array(
        	'viaje' => $this->Viajes_model->getViaje($id),
            'rutas' => $this->Rutas_model->getRutas(),
            'buses' => $this->Buses_model->getBuses(),
            'choferes' => $this->Choferes_model->getChoferes(),
            "copilotos"=> $this->Choferes_model->getCopilotos()
        );

        $contenido_exterior = array(
            'title'     => 'Editar Viaje',
            'contenido' => $this->load->view('backend/viajes/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
    	$idviaje = $this->input->post("idviaje");
        $ruta = $this->input->post("ruta");
        $fecha = $this->input->post("fecha");
        $hora = $this->input->post("hora");
        $bus = $this->input->post("bus");
        $chofer = $this->input->post("chofer");
        $copiloto = $this->input->post("copiloto");

        $data = array();
        if ($this->Viajes_model->ve_chofer($fecha,$hora,$chofer,$idviaje) !== false) {
            $data[] = "El conductor ya fue seleccionado a esa fecha y hora";
        }
        if ($this->Viajes_model->ve_bus($fecha,$hora,$bus,$idviaje) !== false) {
            $data[] = "El bus ya fue seleccionado a esa fecha y hora";
        }
        if ($chofer != $copiloto) {
            if ($this->Viajes_model->ve_copiloto($fecha,$hora,$copiloto,$idviaje) !== false && $this->Viajes_model->ve_chofer($fecha,$hora,$copiloto,$idviaje) !== false) {
            $data[] = "El copiloto ya fue seleccionado a esa fecha y hora";
            }
        }
        else{
            $data[] = "El conductor no puede ser copiloto";
        }
        

        if (!empty($data)) {
            echo json_encode($data);
        }
        else{
            $datos = [
                "ruta_id" => $ruta,
                "fecha" => $fecha,
                "hora" => $hora,
                "bus_id" => $bus,
                "chofer_id" => $chofer,
                "copiloto_id" => $copiloto,
            ];
            if ($this->Viajes_model->update($idviaje, $datos)) {
                //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
                echo "1";
            } else {
                //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
                echo "0";
            }
        }
        
        
    }
    public function venta($id)
    {
    	$viaje = $this->Viajes_model->infoViaje($id);
    	$data['asientos'] = $this->Ventas_model->getAsientos($id);
    	$contenido_interno = array(
        	'viaje' => $viaje,
        	'comprobantes' => $this->Comprobantes_model->getComprobantes(),
            'bus' => $this->load->view('backend/modelo_buses/bus_'.$viaje->asientos,$data,true),

        );

        $contenido_exterior = array(
            'title'     => 'Editar Viaje',
            'contenido' => $this->load->view('backend/viajes/ventas', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function getbuses(){
        $fecha = $this->input->post("fecha");
        $hora = $this->input->post("hora");
        $resp = $this->Viajes_model->getBusID($fecha, $hora);
        if (!$resp) {
            $buses = $this->Viajes_model->getBuses();
        }else{
            $buses = $this->Viajes_model->getBuses($resp->bus_id);
        }
        
        echo json_encode($buses);
    }


    public function getchoferes(){
        $fecha = $this->input->post("fecha");
        $hora = $this->input->post("hora");
        $resp = $this->Viajes_model->getChoferID($fecha, $hora);
        if (!$resp) {
            $choferes = $this->Viajes_model->getChoferes();
        }else{
            $choferes = $this->Viajes_model->getChoferes($resp->chofer_id);
        }
        
        echo json_encode($choferes);
    }

    public function getdata(){
        $hora = $this->input->post("hora");
        $mes = $this->input->post("mes");
        $ruta = $this->input->post("ruta");
        $year = $this->input->post("year");
        $data["mes"] = $mes;
        $data["hora"] = $hora;
        $data["year"] = $year;

        $data["ruta"] = $this->Rutas_model->getRutaForm($ruta);
        $data["buses"] = $this->Buses_model->getBuses();
        $data["choferes"] = $this->Choferes_model->getChoferes();
        $data["copilotos"] = $this->Choferes_model->getCopilotos();
        $this->load->view("backend/viajes/form",$data);
    }

    public function delete($id)
    {
        /*if ($this->Choferes_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "mantenimiento/conductores";
        } */

        $data  = array(
            'estado' => "0", 
        );
        $this->Viajes_model->update($id,$data);
        echo "gestionar/horarios";
    }
}
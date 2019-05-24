<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buses extends CI_Controller
{
    private $permisos;
    public function __construct()
    {
        parent::__construct();
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Buses_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $contenido_interno = array(
            'permisos' => $this->permisos,
            'buses' => $this->Buses_model->getBuses(),

        );

        $contenido_exterior = array(
            'title'     => 'Buses',
            'contenido' => $this->load->view('backend/buses/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {
        $data = array(
            'title'     => 'Agregar Bus',
            'contenido' => $this->load->view('backend/buses/add', '', true),
        );

        $this->load->view('backend/template', $data);
    }

    public function store()
    {
        $placa = $this->input->post("placa");
        $modelo = $this->input->post("modelo");
        $marca = $this->input->post("marca");
        $asientos = $this->input->post("asientos");
        $tipo = $this->input->post("tipo");
        $costo_bus_cama = $this->input->post("servicio");
        $soat = $this->input->post("soat");
        $revision = $this->input->post("revision");
        $fecha_emision = $this->input->post("emision");
        $fecha_caducidad = $this->input->post("caducidad");


        $datos = [
            "placa" => $placa,
            "modelo" => $modelo,
            "marca" => $marca,
            'asientos' => $asientos,
            'tipo' => $tipo,
            'costo_cama' => $costo_bus_cama,
            'soat' => $soat,
            'revision' => $revision,
            'fecha_emision' => $fecha_emision,
            'fecha_caducidad' => $fecha_caducidad,
        ];
        if ($this->Buses_model->save($datos)) {
            //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
            redirect(base_url() . "mantenimiento/buses");
        } else {
            //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
            redirect(base_url() . "mantenimiento/buses/add");
        }
        
    }

    public function edit($id)
    {
        $contenido_interno = array(
            'bus' => $this->Buses_model->getBus($id),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Bus',
            'contenido' => $this->load->view('backend/buses/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idbus = $this->input->post("idbus");
        $placa = $this->input->post("placa");
        $modelo = $this->input->post("modelo");
        $marca = $this->input->post("marca");
        $asientos = $this->input->post("asientos");
        $tipo = $this->input->post("tipo");
        $costo_bus_cama = $this->input->post("servicio");
        $soat = $this->input->post("soat");
        $revision = $this->input->post("revision");
        $fecha_emision = $this->input->post("emision");
        $fecha_caducidad = $this->input->post("caducidad");

 /*       if (empty($rev_actual)) {
            $fecha ="";
        }else{
            $fecha_db = explode("-",$rev_actual);

            $fecha_cambiada = mktime(0,0,0,$fecha_db[1]+6,$fecha_db[2],$fecha_db[0]);
            $fecha = date("Y-m-d", $fecha_cambiada);
        }
*/
        $datos = [
            "placa" => $placa,
            "modelo" => $modelo,
            "marca" => $marca,
            'asientos' => $asientos,
            'tipo' => $tipo,
            'costo_cama' => $costo_bus_cama,
            'soat' => $soat,
            'revision' => $revision,
            'fecha_emision' => $fecha_emision,
            'fecha_caducidad' => $fecha_caducidad,
        ];
        if ($this->Buses_model->update($idbus, $datos)) {
            //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
            redirect(base_url() . "mantenimiento/buses");
        } else {
            //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
            redirect(base_url() . "mantenimiento/buses/edit/" . $idarea);
        }
        

    }

    public function delete($id)
    {
        /*if ($this->Buses_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "mantenimiento/buses";
        } */

        $data  = array(
            'estado' => "0", 
        );
        $this->Buses_model->update($id,$data);
        echo "mantenimiento/buses";
    }

    public function getBuses(){
        $buses = $this->Buses_model->getBuses();
        echo json_encode($buses);
    }

}

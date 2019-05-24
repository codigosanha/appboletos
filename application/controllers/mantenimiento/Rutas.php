<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rutas extends CI_Controller
{
    private $permisos;
    public function __construct()
    {
        parent::__construct();
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Rutas_model");
        $this->load->model("Terminales_model");
        $this->load->model("Buses_model");
        $this->load->model("Choferes_model");

        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $contenido_interno = array(
            'rutas' => $this->Rutas_model->getRutas(),
            'permisos' => $this->permisos,
        );

        $contenido_exterior = array(
            'title'     => 'Rutas',
            'contenido' => $this->load->view('backend/rutas/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {
        $contenido_interno = array(
            'terminales' => $this->Terminales_model->getTerminales(),
            'buses' => $this->Buses_model->getBuses(),
        );

        $contenido_exterior = array(
            'title'     => 'Agregar Ruta',
            'contenido' => $this->load->view('backend/rutas/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function store()
    {
        $origen = $this->input->post("origen");
        $destino = $this->input->post("destino");
        $precio = $this->input->post("precio");
        $color = $this->input->post("color");
        
        $datos = [
            "origen" => $origen,
            "destino" => $destino,
            "precio" => $precio,
            "color" => $color,

        ];
        if ($this->Rutas_model->save($datos)) {
            //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
            redirect(base_url() . "mantenimiento/rutas");
        } else {
            //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
            redirect(base_url() . "mantenimiento/rutas/add");
        }
        
    }

    public function edit($id)
    {
        $contenido_interno = array(
            'ruta' => $this->Rutas_model->getRuta($id),
            'terminales' => $this->Terminales_model->getTerminales(),

        );

        $contenido_exterior = array(
            'title'     => 'Editar Ruta',
            'contenido' => $this->load->view('backend/rutas/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idruta = $this->input->post("idruta");
        $origen = $this->input->post("origen");
        $destino = $this->input->post("destino");
        $precio = $this->input->post("precio");
        $color = $this->input->post("color");
        
        $datos = [
            "origen" => $origen,
            "destino" => $destino,
            "precio" => $precio,
            "color" => $color,

        ];
        if ($this->Rutas_model->update($idruta, $datos)) {
            //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
            redirect(base_url() . "mantenimiento/rutas");
        } else {
            //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
            redirect(base_url() . "mantenimiento/rutas/edit/" . $idruta);
        }
        

    }

    public function delete($id)
    {
        /*if ($this->Rutas_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "mantenimiento/rutas";
        } */

        $data  = array(
            'estado' => "0", 
        );
        $this->Rutas_model->update($id,$data);
        echo "mantenimiento/rutas";
    }

}

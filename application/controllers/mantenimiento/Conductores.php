<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Conductores extends CI_Controller
{
    private $permisos;
    public function __construct()
    {
        parent::__construct();
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Choferes_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $contenido_interno = array(
            'permisos' => $this->permisos,
            'choferes' => $this->Choferes_model->getChoferes(),
        );

        $contenido_exterior = array(
            'title'     => 'choferes',
            'contenido' => $this->load->view('backend/conductores/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {
        $data = array(
            'title'     => 'Agregar Chofer',
            'contenido' => $this->load->view('backend/conductores/add', '', true),
        );

        $this->load->view('backend/template', $data);
    }

    public function store()
    {
        $brevete = $this->input->post("brevete");
        $dni = $this->input->post("dni");
        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $edad = $this->input->post("edad");
        $telefono = $this->input->post("telefono");
        
        $datos = [
            "brevete" => $brevete,
            "dni" => $dni,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "edad" => $edad,
            "telefono" => $telefono,
        ];
        if ($this->Choferes_model->save($datos)) {
            //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
            redirect(base_url() . "mantenimiento/conductores");
        } else {
            //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
            redirect(base_url() . "mantenimiento/conductores/add");
        }
        
    }

    public function edit($id)
    {
        $contenido_interno = array(
            'chofer' => $this->Choferes_model->getChofer($id),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Chofer',
            'contenido' => $this->load->view('backend/conductores/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idchofer = $this->input->post("idchofer");
        $brevete = $this->input->post("brevete");
        $dni = $this->input->post("dni");
        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $edad = $this->input->post("edad");
        $telefono = $this->input->post("telefono");
        
        $datos = [
            "brevete" => $brevete,
            "dni" => $dni,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "edad" => $edad,
            "telefono" => $telefono,
        ];

        if ($this->Choferes_model->update($idchofer, $datos)) {
            //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
            redirect(base_url() . "mantenimiento/conductores");
        } else {
            //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
            redirect(base_url() . "mantenimiento/conductores/edit/" . $idarea);
        }
        

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
        $this->Choferes_model->update($id,$data);
        echo "mantenimiento/conductores";
    }

}

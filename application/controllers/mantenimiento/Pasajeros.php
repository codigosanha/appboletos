<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasajeros extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Pasajeros_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $contenido_interno = array(
            'pasajeros' => $this->Pasajeros_model->getPasajeros(),
        );

        $contenido_exterior = array(
            'title'     => 'Pasajeros',
            'contenido' => $this->load->view('backend/pasajeros/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {
        $data = array(
            'title'     => 'Agregar Pasajero',
            'contenido' => $this->load->view('backend/pasajeros/add', '', true),
        );

        $this->load->view('backend/template', $data);
    }

    public function store()
    {
        $dni = $this->input->post("dni");
        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $edad = $this->input->post("edad");
        $telefono = $this->input->post("telefono");
        $ruc = $this->input->post("ruc");
        $razon = $this->input->post("razon");
        $direccion = $this->input->post("direccion");
        $tel_empresa = $this->input->post("tel_empresa");
        $sexo = $this->input->post("sexo");
        $datos = [
            "dni" => $dni,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "edad" => $edad,
            "telefono" => $telefono,
            "ruc" => $ruc,
            "razon" => $razon,
            "direccion" => $direccion,
            "tel_empresa" => $tel_empresa,
            "sexo" => $sexo,
            'pasajeros_estadoreg' => 1,
            'pasajeros_idusucrea' => $this->session->userdata("id"),
            'pasajeros_fecusucrea' => date("Y-m-d H:i:s"),
        ];
        if ($this->Pasajeros_model->save($datos)) {
            //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
            redirect(base_url() . "mantenimiento/pasajeros");
        } else {
            //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
            redirect(base_url() . "mantenimiento/pasajeros/add");
        }
        
    }

    public function edit($id)
    {
        $contenido_interno = array(
            'pasajero' => $this->Pasajeros_model->getPasajero($id),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Pasajero',
            'contenido' => $this->load->view('backend/pasajeros/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idpasajero = $this->input->post("idpasajero");
        $dni = $this->input->post("dni");
        $nombres = $this->input->post("nombres");
        $apellidos = $this->input->post("apellidos");
        $edad = $this->input->post("edad");
        $telefono = $this->input->post("telefono");
        $ruc = $this->input->post("ruc");
        $razon = $this->input->post("razon");
        $direccion = $this->input->post("direccion");
        $tel_empresa = $this->input->post("tel_empresa");
        $sexo = $this->input->post("sexo");
        $datos = [
            "dni" => $dni,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "edad" => $edad,
            "telefono" => $telefono,
            "ruc" => $ruc,
            "razon" => $razon,
            "direccion" => $direccion,
            "tel_empresa" => $tel_empresa,
            "sexo" => $sexo,
            'pasajeros_idusumod' => $this->session->userdata("id"),
            'pasajeros_idfecusumod  ' => date("Y-m-d H:i:s"),
        ];
        if ($this->Pasajeros_model->update($idpasajero, $datos)) {
            //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
            redirect(base_url() . "mantenimiento/pasajeros");
        } else {
            //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
            redirect(base_url() . "mantenimiento/pasajeros/edit/" . $idpasajero);
        }
        

    }

    public function delete($id)
    {

        $data  = array(
            'pasajeros_estadoreg' => "0", 
            'pasajeros_idusumod' => $this->session->userdata("id"),
            'pasajeros_idfecusumod  ' => date("Y-m-d H:i:s"), 
        );
        $this->Pasajeros_model->update($id,$data);
        echo "mantenimiento/pasajeros";
    }

}

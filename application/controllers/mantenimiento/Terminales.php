<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Terminales extends CI_Controller
{
    private $permisos;
    public function __construct()
    {
        parent::__construct();
        $this->permisos = $this->backend_lib->control();
        $this->load->model("Terminales_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $contenido_interno = array(
            'terminales' => $this->Terminales_model->getterminales(),
            'permisos' => $this->permisos,
        );

        $contenido_exterior = array(
            'title'     => 'terminales',
            'contenido' => $this->load->view('backend/terminales/list', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {
        $contenido_interno = array(
            'deps' => $this->Terminales_model->getDepartamentos()
        );
        $contenido_exterior = array(
            'title'     => 'Agregar Terminal',
            'contenido' => $this->load->view('backend/terminales/add', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function store()
    {
        $ciudad = $this->input->post("ciudad");
        $direccion = $this->input->post("direccion");
        $departamento = $this->input->post("iddep");
        $provincia = $this->input->post("idprov");
        $distrito = $this->input->post("iddist");
        $telefono1 = $this->input->post("telefono1");
        $telefono2 = $this->input->post("telefono2");
        $telefono3 = $this->input->post("telefono3");
        $telefono4 = $this->input->post("telefono4");
        $datos = [
            "ciudad" => $ciudad,
            "direccion" => $direccion,
            "departamento" => $departamento,
            "provincia" => $provincia,
            "distrito" => $distrito,
            "telefono1" => $telefono1,
            "telefono2" => $telefono2,
            "telefono3" => $telefono3,
            "telefono4" => $telefono4,
        ];
        if ($this->Terminales_model->save($datos)) {
            //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
            redirect(base_url() . "mantenimiento/terminales");
        } else {
            //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
            redirect(base_url() . "mantenimiento/terminales/add");
        }
        
    }

    public function edit($id)
    {
        $terminal = $this->Terminales_model->getTerminal($id);
        $contenido_interno = array(
            'terminal' => $terminal,
            'deps' => $this->Terminales_model->getDepartamentos(),
            'provs' => $this->Terminales_model->getProvincias($terminal->departamento),
            'dists' => $this->Terminales_model->getDistritos($terminal->provincia),
        );

        $contenido_exterior = array(
            'title'     => 'Editar terminal',
            'contenido' => $this->load->view('backend/terminales/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idterminal = $this->input->post("idterminal");
        $ciudad = $this->input->post("ciudad");
        $direccion = $this->input->post("direccion");
         $departamento = $this->input->post("iddep");
        $provincia = $this->input->post("idprov");
        $distrito = $this->input->post("iddist");
        $telefono1 = $this->input->post("telefono1");
        $telefono2 = $this->input->post("telefono2");
        $telefono3 = $this->input->post("telefono3");
        $telefono4 = $this->input->post("telefono4");
        
        $datos = [
            "ciudad" => $ciudad,
            "direccion" => $direccion,
            "departamento" => $departamento,
            "provincia" => $provincia,
            "distrito" => $distrito,
            "telefono1" => $telefono1,
            "telefono2" => $telefono2,
            "telefono3" => $telefono3,
            "telefono4" => $telefono4,
        ];
        if ($this->Terminales_model->update($idterminal, $datos)) {
            //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
            redirect(base_url() . "mantenimiento/terminales");
        } else {
            //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
            redirect(base_url() . "mantenimiento/terminales/edit/" . $idarea);
        }
        

    }

    public function delete($id)
    {
        /*if ($this->Terminales_model->delete($id)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "mantenimiento/terminales";
        } */

        $data  = array(
            'estado' => "0", 
        );
        $this->Terminales_model->update($id,$data);
        echo "mantenimiento/terminales";
    }

    public function getProvincias(){
        $iddep = $this->input->post("id");

        $provincias = $this->Terminales_model->getProvincias($iddep);

        echo json_encode($provincias);
    }

    public function getDistritos(){
        $idprov = $this->input->post("id");

        $distritos = $this->Terminales_model->getDistritos($idprov);

        echo json_encode($distritos);
    }

}

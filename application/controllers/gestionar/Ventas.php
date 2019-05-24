<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas extends CI_Controller
{
    private $permisos;
	public function __construct(){
		parent::__construct();
        $this->permisos = $this->backend_lib->control();
		$this->load->model("Rutas_model");
		$this->load->model("Ventas_model");
		$this->load->model("Viajes_model");
		$this->load->model("Comprobantes_model");
        $this->load->model("Pasajeros_model");
        $this->load->model("Terminales_model");
	}

	public function index()
	{
    	
		$contenido_interno  = array(
            'terminales' => $this->Ventas_model->getTerminales(),
			'rutas' => $this->Rutas_model->getRutas(), 
			'comprobantes' => $this->Comprobantes_model->comprobatesTerminales($this->session->userdata("terminal")),
		);
        $contenido_exterior = array(
            'title'     => 'Viajes',
            'contenido' => $this->load->view('backend/viajes/ventas', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }
    public function manifiesto(){
        $id = $this->input->post("id");
        $data["viaje"] = $this->Viajes_model->getViajeManifiestoVenta($id);
        $data["pasajeros"] = $this->Ventas_model->getPasajeros($id);
        $this->load->view('backend/ventas/manifiesto', $data);

    }
    public function getinfoboleto(){
        $idventa = $this->input->post("id");
        $venta = $this->Ventas_model->getVenta($idventa);
        $data["venta"] = $venta;
        $data["cantidadviajes"] = $this->Pasajeros_model->cantidadViajes($venta->pasajero_id);
        echo json_encode($data);
    }

    public function getPasajero()
    {
        $dni = $this->input->post("dni");
        $pasajero = $this->Ventas_model->getPasajero($dni);
        if (!$pasajero) {
            echo "0";
        }else {
            $data["pasajero"] = $pasajero;
            $data["viajes"] = $this->Pasajeros_model->cantidadViajes($pasajero->id);
            echo json_encode($data);
        }
    }

    public function infoviaje(){
    	$fecha = $this->input->post("fecha_horario");
		$ruta = $this->input->post("ruta");
		$hora = $this->input->post("horas");

		$viaje = $this->Ventas_model->getViaje($ruta,$fecha,$hora);
        //echo json_encode($viaje);
		if (!$viaje) {
			echo "0";
		}else{
			$detalleViaje = $this->Viajes_model->infoViaje($viaje->id);
			echo json_encode($detalleViaje);
		}
    }

    public function asientos($idViaje){
        $viaje = $this->Viajes_model->infoViajeBus($idViaje);

        //$data["costo"] = $viaje->costo_cama;
        //$data['asientos'] = $this->Ventas_model->getAsientos($idViaje);
        $this->load->view('backend/modelo_buses/bus_'.$viaje->asientos);
    }

    public function asientosvendidos($idViaje){
        $viaje = $this->Viajes_model->infoViajeBus($idViaje);
        $data["costo"] = $viaje->costo_cama;
        $data["color"] = $viaje->color;
        $data["cantidadasientos"] = $viaje->asientos;
        $data['asientos'] = $this->Ventas_model->getAsientos($idViaje);
        echo json_encode($data);
    }

    public function store()
    {
    	$idventa = $this->input->post("venta");
        $idpasajero = $this->input->post("boleto-idpasajero");
        $idviaje = $this->input->post("boleto-idviaje");
        $num_asiento = $this->input->post("asiento");
        $operacion = $this->input->post("operacion");
        $fecha_venta = $this->input->post("boleto_fecha_venta");
        $importe = $this->input->post("precio");
        $tipocomprobante = $this->input->post("boleto-comprobante");
        $subida = $this->input->post("subida");
        $bajada = $this->input->post("bajada");
        $horapago = $this->input->post("hora-pago");

        $dni = $this->input->post("boleto-dni");
        $nombres = $this->input->post("boleto-nombres");
        $apellidos = $this->input->post("boleto-apellidos");
        $edad = $this->input->post("boleto-edad");
        $telefono = $this->input->post("boleto-telefono");
        $ruc = $this->input->post("boleto-ruc");
        $razon = $this->input->post("boleto-razon");
        $direccion = $this->input->post("boleto-direccion");
        $tel_empresa = $this->input->post("boleto-telefono-emp");
        $sexo = $this->input->post("sexo");

        $dataPasajero = array(
            'dni' => $dni,
            'nombres' => $nombres, 
            'apellidos' => $apellidos, 
            'edad' => $edad, 
            'telefono' => $telefono, 
            'ruc' => $ruc, 
            'razon' => $razon, 
            'direccion' => $direccion,  
            'tel_empresa' => $tel_empresa, 
            'sexo' => $sexo, 
        );
        if ($idpasajero == "") {
            $idpasajero = $this->Ventas_model->savePasajero($dataPasajero);
        }else{
            $this->Pasajeros_model->update($idpasajero,$dataPasajero);
        }

        

            $comprobante = $this->Comprobantes_model->getComprobante($tipocomprobante);
            $numero = $this->generarnumero($comprobante->cantidad);
            $this->updateComprobante($comprobante->id, $comprobante->cantidad);

            $data  = array(
                'viaje_id' => $idviaje, 
                'pasajero_id' => $idpasajero,
                'num_asiento' => $num_asiento,
                'operacion' => $operacion,
                'fecha_venta' =>date("Y-m-d"),
                'importe' => $importe,
                'comprobante_id' => $comprobante->id,
                'numero' => $numero,
                'usuario_id' => $this->session->userdata('id'),
                "ventas_estadoreg" => $operacion,
                'subida' => $subida,
                "bajada" => $bajada,
                "horapago" => $horapago,
                'ventas_idusucrea' => $this->session->userdata('id'),
                'ventas_fecusucrea' => date("Y-m-d H:i:s"),
                'ventas_idusumod' => $this->session->userdata('id'),
                'ventas_fecusumod' => date("Y-m-d H:i:s"),

            );
            if (!$this->Ventas_model->update($idventa,$data)) {
                echo "0";
            }else{
                
                $this->eliminarReservas($idviaje);
                $data = array(
                    'venta' => $this->Ventas_model->infoVenta($idventa)
                );
                if($operacion=="reservado"){
                    echo "R";
                }else{
                    $this->load->view("backend/ventas/ticket", $data);
                }
                
            }
        

        
    }

    protected function updateComprobante($idcomprobante,$cantidad){
        
        $data  = array(
            'cantidad' => $cantidad + 1, 
        );
        $this->Comprobantes_model->update($idcomprobante,$data);
    }

    public function getHoras(){
        $ruta = $this->input->post("idruta");
        $fecha = $this->input->post("fechaviaje");
        $horas = $this->Viajes_model->getHoras($ruta,$fecha);
        echo json_encode($horas);
    }

    protected function ultimoComprobante($idcomprobante){
        $comprobante = $this->Comprobantes_model->getComprobante($idcomprobante);
        return $this->generarnumero($comprobante->cantidad);

    }
    protected function generarnumero($numero){
        if ($numero>= 99999 && $numero< 999999) {
            return $numero+1;
        }
        if ($numero>= 9999 && $numero< 99999) {
            return "0".($numero+1);
        }
        if ($numero>= 999 && $numero< 9999) {
            return "00".($numero+1);
        }
        if ($numero>= 99 && $numero< 999) {
            return "000".($numero+1);
        }
        if ($numero>= 9 && $numero< 99) {
            return "0000".($numero+1);
        }
        if ($numero < 9 ){
            return "00000".($numero+1);
        }
    }

    public function infocomprobante(){
        $idcomprobante = $this->input->post("id");
        $comprobante = $this->Comprobantes_model->getComprobante($idcomprobante);
        echo json_encode($comprobante);
    }

    public function detalleviaje(){
        $id = $this->input->post("id");
        $data["vendidos"] = $this->Ventas_model->boletosVendidos($id);
        $data["terminal"] = $this->Terminales_model->getTerminal($this->session->userdata("terminal"));
        $data["viaje"] =  $this->Viajes_model->viajedetalle($id);
        $this->load->view("backend/viajes/view", $data);
    }


    public function infoboleto(){
        $serie = $this->input->post("serie-postergar");
        $tipocomprobante = $this->input->post("comprobante-postergar");
        $numero_comprobante = $this->input->post("doc_numero");

        $comprobante = $this->Comprobantes_model->getIdComprobante($tipocomprobante,$serie);

        $databoleto = $this->Ventas_model->dataBoleto($comprobante->id,$numero_comprobante);
        if (!$databoleto) {
            echo "0";
        }
        else{
            echo json_encode($databoleto);
        }
        
    }

    public function updateinfoboleto(){
        $idventa = $this->input->post("idventa");
        $asiento = $this->input->post("asiento-postergar");
        $viaje = $this->input->post("idviaje_postergar");


        $data = array(
            "num_asiento" => $asiento,
            "viaje_id" => $viaje,
            'ventas_estadoreg'=> 'postergado',
            'usuario_id' => $this->session->userdata('id'),
            'ventas_idusumod' => $this->session->userdata('id'),
            'ventas_fecusumod' => date("Y-m-d H:i:s"),
        );

        if (!$this->Ventas_model->existenciaBoleto($viaje,$asiento)){
            $this->Ventas_model->update($idventa, $data);
            echo "1";
        } else {
            echo "0";
        }

       /* if ($this->Ventas_model->update($idventa, $data)) {
            echo "1";
        }
        else{
            echo "0";
        }*/
    }

    public function anular(){
        $idventa = $this->input->post("id");

        $data = array(
            "ventas_estadoreg" => "anulado",
            'usuario_id' => $this->session->userdata('id'),
            'ventas_idusumod' => $this->session->userdata('id'),
            'ventas_fecusumod' => date("Y-m-d H:i:s"),
        );
        if ($this->Ventas_model->update($idventa,$data)) {
            echo "1";
        }
        else{
            echo "0";
        }
        
    }
    public function pagar(){
        $idventa = $this->input->post("id");

        $data = array(
            "ventas_estadoreg" => "activo",
            'usuario_id' => $this->session->userdata('id'),
            'ventas_idusumod' => $this->session->userdata('id'),
            'ventas_fecusumod' => date("Y-m-d H:i:s"),
        );
        if ($this->Ventas_model->update($idventa,$data)) {
            echo "1";
        }
        else{
            echo "0";
        }
        
    }
    public function delete(){
        $idventa = $this->input->post("id");

        if ($this->Ventas_model->delete($idventa)) {
            echo "1";
        }
        else{
            echo "0";
        }
        
    }

    public function remota(){
    	$dni = $this->input->post("dni-remoto");
    	$fecha = $this->input->post("fecha-remoto");
    	$databoleto = $this->Ventas_model->ventaremota($dni,$fecha);
    	if ($databoleto != false) {
    		$data = array(
                'venta' => $this->Ventas_model->infoVenta($databoleto->id)
            );
            $this->load->view("backend/ventas/ticket", $data);
    	}
    	else{
    		echo "0";
    	}
    }

    public function marcar(){
    	$venta = $this->input->post("venta");
    	$asiento = $this->input->post("asiento");
    	$idviaje = $this->input->post("idviaje");

    	$data = array(
    		"num_asiento" => $asiento,
    		"viaje_id" => $idviaje,
   			"ventas_estadoreg" => "activo",
            'usuario_id' => $this->session->userdata('id'),
            'ventas_idusucrea' => $this->session->userdata('id'),
            'ventas_fecusucrea' => date("Y-m-d H:i:s"),
    	);

    	if ($venta!= "") {
    		$this->Ventas_model->update($venta, $data);
    		$idventa = $venta;
    	}else{

    		$idventa = $this->Ventas_model->save($data);
    	}
    	echo $idventa;
    }

    public function asientosocupados($idviaje){
        $viaje = $this->Viajes_model->infoViajeBus($idviaje);

        $data["color"] = $viaje->color;
    	$data['asientos'] = $this->Ventas_model->getAsientos($idviaje);
        $data['asientospendientes'] = $this->Ventas_model->getAsientosPendientes($idviaje);
        echo json_encode($data);
    }
    public function infoviajepostergar(){
        $fecha = $this->input->post("fecha-postergar");
        $ruta = $this->input->post("ruta-postergar");
        $hora = $this->input->post("horas-postergar");

        $viaje = $this->Ventas_model->getViaje($ruta,$fecha,$hora);
        //echo json_encode($viaje);
        if (!$viaje) {
            echo "0";
        }else{
            $detalleViaje = $this->Viajes_model->infoViaje($viaje->id);
            echo json_encode($detalleViaje);
        }
    }

    public function asientosvendidospostergar($idViaje){
        $viaje = $this->Viajes_model->infoViajeBus($idViaje);
        $data["costo"] = $viaje->costo_cama;
        $data["color"] = $viaje->color;
        $data["cantidadasientos"] = $viaje->asientos;
        $data['asientos'] = $this->Ventas_model->getAsientos($idViaje);
        echo json_encode($data);
    }

    public function eliminarReservas($idviaje){
        $fecha = date("Y-m-d");
        $horaactual = date("H:i");
        $viaje = $this->Viajes_model->getViaje($idviaje);
        if ($viaje->fecha == $fecha) {
            $this->Ventas_model->deleteReservas($horaactual,$idviaje);
        }
    }
}

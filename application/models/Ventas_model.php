<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_model extends CI_Model {

	public function getVentas($fechainicio = false,$fechafin = false)
	{
		$this->db->select("v.*,p.nombres,p.apellidos,tc.nombre, t.ciudad,c.serie");
		$this->db->from("ventas v");
		$this->db->join("pasajeros p", "v.pasajero_id = p.id");
		$this->db->join("comprobantes c", "v.comprobante_id = c.id");
		$this->db->join("tipo_comprobantes tc", "c.tipo_comprobante_id = tc.id");
		$this->db->join("usuarios u", "v.usuario_id = u.id");
		$this->db->join("terminales t", "u.terminal_id = t.id");
		if ($fechainicio!=false  && $fechafin != false) {
			$this->db->where("v.fecha_venta >=",$fechainicio);
			$this->db->where("v.fecha_venta <=",$fechafin);
		}
		$this->db->where("v.ventas_estadoreg !=","reservado");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
		
	}
	public function getVentasDashboard()
	{
		$this->db->select("v.*,p.nombres,p.apellidos,tc.nombre, t.ciudad");
		$this->db->from("ventas v");
		$this->db->join("pasajeros p", "v.pasajero_id = p.id");
		$this->db->join("comprobantes c", "v.comprobante_id = c.id");
		$this->db->join("tipo_comprobantes tc", "c.tipo_comprobante_id = tc.id");
		$this->db->join("usuarios u", "v.usuario_id = u.id");
		$this->db->join("terminales t", "u.terminal_id = t.id");
		$this->db->order_by("v.fecha_venta","DESC");
		$this->db->limit(5);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		} else {
			return false;
		}
		
	}
	public function getVenta($id)
	{
		$this->db->select("v.*,p.nombres,p.apellidos,p.dni, t.ciudad as origen, tr.ciudad as destino,vi.fecha,vi.hora,c.serie,ts.ciudad as subidap,tb.ciudad as bajadap,c.serie,tc.nombre");
		$this->db->from("ventas v");
		$this->db->join("pasajeros p", "v.pasajero_id = p.id");
		$this->db->join("comprobantes c", "v.comprobante_id = c.id");
		$this->db->join("tipo_comprobantes tc", "c.tipo_comprobante_id = tc.id");
		$this->db->join("viajes vi", "v.viaje_id = vi.id");
		$this->db->join("rutas r", "vi.ruta_id = r.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->join("terminales ts", "v.subida = ts.id");
		$this->db->join("terminales tb", "v.bajada = tb.id");
		$this->db->where("v.id", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}
	public function getBus($idhorario)
	{
		$this->db->select("b.asientos");
		$this->db->from("horarios h");

		$this->db->join("rutas r", "h.ruta_id = r.id");
		$this->db->join("buses b", "r.bus_id = b.id");
		
		$this->db->where("h.id", $idhorario);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		} else {
			return false;
		}
		
	}

	public function countBoletos(){
		$resultados = $this->db->get("boletos");
		return $resultados->num_rows();
	}

	public function getHorarios($ruta)
	{
		$this->db->where("ruta_id", $ruta);
		$this->db->order_by("hora", "ASC");
		$resultados = $this->db->get("horarios");
		return $resultados->result();
	}

	public function getPasajero($dni)
	{
		$this->db->where("dni", $dni);
		$this->db->where("pasajeros_estadoreg","1");
		$resultados = $this->db->get("pasajeros");
		return $resultados->row();
	}

	public function getViaje($ruta,$fecha,$hora){
		
		$this->db->where("fecha",$fecha);
		$this->db->where("hora",$hora);
		$this->db->where("ruta_id",$ruta);
		$resultados = $this->db->get("viajes");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		} else {
			return false;
		}
		

	}

	public function save($data)
	{
		if ($this->db->insert("ventas", $data)) {
			return $this->db->insert_id();
		}else {
			return false;
		}
	}

	public function getAsientos($idviaje){
		$this->db->select('ve.id,ve.num_asiento,ve.ventas_estadoreg,p.sexo');//04, 06, 08
		$this->db->from("ventas ve");
		$this->db->join("viajes v", "ve.viaje_id = v.id");
		$this->db->join("pasajeros p", "ve.pasajero_id = p.id");
		$this->db->where('ve.viaje_id', $idviaje);
		$this->db->where('ve.ventas_estadoreg !=', "anulado");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}else{
			return false;
		}
		
	}
	public function getAsientosPendientes($idviaje){
		$this->db->select('ve.num_asiento');//04, 06, 08
		$this->db->from("ventas ve");
		$this->db->join("viajes v", "ve.viaje_id = v.id");
		$this->db->where('ve.viaje_id', $idviaje);
		$this->db->where('ve.pasajero_id', NULL);
		$this->db->where('ve.ventas_estadoreg !=', "anulado");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}else{
			return false;
		}
		
	}

	public function getPasajeros($idviaje = false)
	{
		$this->db->select("p.*, vi.hora, vi.fecha, t.ciudad as origen, tr.ciudad as destino,v.num_asiento,tu.ciudad as lugar,c.serie,v.numero,v.importe");
		$this->db->from("ventas v");
		$this->db->join("viajes vi", "v.viaje_id = vi.id");
		$this->db->join("pasajeros p ", "v.pasajero_id = p.id");
		$this->db->join("comprobantes c ", "v.comprobante_id = c.id");
		$this->db->join("rutas r", "vi.ruta_id = r.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->join("usuarios u", "v.usuario_id = u.id");
		$this->db->join("terminales tu", "u.terminal_id = tu.id");
		$this->db->where('v.ventas_estadoreg !=', "anulado");
		if ($idviaje != false) {
			$this->db->where('v.viaje_id', $idviaje);
		}
		
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}else {
			return false;
		}
		
	}

	public function savePasajero($data)
	{
		if ($this->db->insert("pasajeros", $data)) {
			return $this->db->insert_id();
		}else {
			return false;
		}
	}

	public function getPunto($iduser)
	{
		$this->db->select("t.ciudad");
		$this->db->from("usuarios u");
		$this->db->join("terminales t", "u.terminal_id = t.id");
		$this->db->where("u.id", $iduser);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function infoVenta($id)
	{
		$this->db->select("ve.*, p.*, vi.fecha, vi.hora, t.ciudad as origen, tr.ciudad as destino, r.precio, u.nombres as usuario, tc.nombre,c.serie");
		$this->db->from("ventas ve");
		$this->db->join("pasajeros p", "ve.pasajero_id = p.id");
		$this->db->join("viajes vi", "ve.viaje_id = vi.id");
		$this->db->join("comprobantes c", "ve.comprobante_id = c.id");
		$this->db->join("tipo_comprobantes tc", "c.tipo_comprobante_id = tc.id");
		$this->db->join("usuarios u", "ve.usuario_id = u.id");
		$this->db->join("rutas r", "vi.ruta_id = r.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->where("ve.id",$id);
		$resultados = $this->db->get();

		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else {
			return false;
		}
	}
	public function getinfoVenta($id)
	{
		
		$this->db->where("id",$id);
		$resultados = $this->db->get("ventas");

		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else {
			return false;
		}
	}

	public function existenciaBoleto($idviaje,$numero){
		$this->db->where("viaje_id", $idviaje);
		$this->db->where("num_asiento", $numero);
		$this->db->where("ventas_estadoreg !=", "anulado");
		$resultado = $this->db->get("ventas");
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}else{
			return false;
		}
	}

	public function years(){
		$this->db->select("YEAR(fecha_venta) as year");
		$this->db->from("ventas");
		$this->db->group_by("year");
		$this->db->order_by("year","desc");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function montos($year){
		$this->db->select("MONTH(fecha_venta) as mes, SUM(importe) as monto");
		$this->db->from("ventas");
		$this->db->where("fecha_venta >=",$year."-01-01");
		$this->db->where("fecha_venta <=",$year."-12-31");
		$this->db->where("ventas_estadoreg !=","anulado");
		$this->db->group_by("mes");
		$this->db->order_by("mes");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function boletosVendidos($id){

		$this->db->where('ventas_estadoreg', "activo");
		$this->db->where('viaje_id', $id);
		$resultados = $this->db->get("ventas");
		if ($resultados->num_rows() > 0) {
			return $resultados->num_rows();
		}else{
			return false;
		}
	}
	public function dataBoleto($comprobante_id,$num_doc){
		$this->db->select("ve.*,p.nombres, p.apellidos, p.dni");
		$this->db->from("ventas ve");
		$this->db->join("pasajeros p", "ve.pasajero_id = p.id");
		$this->db->where("ve.numero",$num_doc);
		$this->db->where("ve.comprobante_id",$comprobante_id);
		$this->db->where('ve.ventas_estadoreg', "activo");
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}else{
			return false;
		}
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("ventas",$data);
	}

	public function ventaremota($dni, $fecha){
		$this->db->select("ve.*");
		$this->db->from("ventas ve");
		$this->db->join("pasajeros p", "ve.pasajero_id = p.id");
		$this->db->where("p.dni",$dni);
		$this->db->where("ve.fecha_venta",$fecha);
		$this->db->where('ve.ventas_estadoreg', "activo");
		$resultado = $this->db->get();
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("ventas");
	}

	public function getTerminales(){
		$this->db->select("t.*,ud.departamento,up.provincia,udi.distrito");
		$this->db->join("ubdepartamento ud", "t.departamento = ud.idDepa");
		$this->db->join("ubprovincia up", "t.provincia = up.idProv");
		$this->db->join("ubdistrito udi", "t.distrito = udi.idDist");
		$resultados = $this->db->get("terminales t");
		return $resultados->result();
	}


	public function deleteReservas($hora, $viaje){
		$this->db->where("ventas_estadoreg","reservado");
		$this->db->where("horapago <",$hora);
		$this->db->where("viaje_id",$viaje);
		$this->db->delete("ventas");
	}
}

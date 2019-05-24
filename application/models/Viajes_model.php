<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viajes_model extends CI_Model {

	public function getViajes(){
		$this->db->select("v.*, b.placa,b.asientos,b.tipo, t.ciudad as origen, tr.ciudad as destino, r.precio, c.nombres, c.apellidos,c.brevete,ch.nombres as nombresc,ch.apellidos as apellidosc,ch.brevete as brevetec");
		$this->db->from("viajes v");
		
		$this->db->join("rutas r", "v.ruta_id = r.id");
		$this->db->join("buses b", "v.bus_id = b.id");
		$this->db->join("choferes c", "v.chofer_id = c.id");
		$this->db->join("choferes ch", "v.copiloto_id = ch.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->where("v.fecha >=", date("Y-m-d"));
		$this->db->where("v.estado", "1");
		$resultados = $this->db->get();

		return $resultados->result();
	}
	public function getViajeManifiesto($ruta,$fecha,$hora){
		$this->db->select("v.*, b.placa,b.asientos,b.marca, t.ciudad as origen, tr.ciudad as destino, r.precio, c.nombres, c.apellidos,c.brevete,co.nombres as nombresc,co.apellidos as apellidosc,co.brevete as brevetec");
		$this->db->from("viajes v");
		
		$this->db->join("rutas r", "v.ruta_id = r.id");
		$this->db->join("buses b", "v.bus_id = b.id");
		$this->db->join("choferes c", "v.chofer_id = c.id");
		$this->db->join("choferes co", "v.copiloto_id = co.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");

		$this->db->where("v.ruta_id",$ruta);
		$this->db->where("v.fecha",$fecha);
		$this->db->where("v.hora",$hora);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		} else {
			return false;
		}
		
	}

	public function save($data){
		return $this->db->insert("viajes",$data);
	}
	public function getViaje($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("viajes");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("viajes",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("viajes");
	}
	
	public function infoViaje($id)
	{
		$this->db->select("v.*, r.origen as subida,r.destino as bajada,t.ciudad as origen, tr.ciudad as destino, r.precio");

		$this->db->join("rutas r", "v.ruta_id = r.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->where("v.id",$id);
		$resultados = $this->db->get("viajes v");
		return $resultados->row();
	}

	public function viajedetalle($id){
		$this->db->select("v.*, b.placa,b.asientos,c.nombres, c.apellidos");

		$this->db->join("buses b", "v.bus_id = b.id");
		$this->db->join("choferes c", "v.chofer_id = c.id");
		$this->db->where("v.id",$id);
		$resultados = $this->db->get("viajes v");
		return $resultados->row();
	}

	public function infoViajeBus($id){
		$this->db->select("b.*,r.color");
		$this->db->join("rutas r", "v.ruta_id = r.id");
		$this->db->join("buses b", "v.bus_id = b.id");
		$this->db->where("v.id",$id);
		$resultados = $this->db->get("viajes v");
		return $resultados->row();
	}

	public function getHoras($ruta,$fecha){

		$this->db->where("fecha",$fecha);
		$this->db->where("ruta_id",$ruta);

		$resultados = $this->db->get("viajes");

		return $resultados->result();
	}

	public function ve_chofer($fecha,$hora,$chofer, $idviaje = false){

		$this->db->where("fecha",$fecha);
		$this->db->where("hora",$hora);
		$this->db->where("chofer_id",$chofer);
		if ($idviaje != false) {
			$this->db->where("id !=", $idviaje);
		}
		$resultados = $this->db->get("viajes");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else{
			return false;
		}
		
	}

	public function ve_copiloto($fecha,$hora,$copiloto, $idviaje = false){

		$this->db->where("fecha",$fecha);
		$this->db->where("hora",$hora);
		$this->db->where("copiloto_id",$copiloto);
		if ($idviaje != false) {
			$this->db->where("id !=", $idviaje);
		}
		$resultados = $this->db->get("viajes");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else{
			return false;
		}
		
	}
	public function ve_bus($fecha,$hora,$bus,$idviaje = false){

		$this->db->where("fecha",$fecha);
		$this->db->where("hora",$hora);
		$this->db->where("bus_id",$bus);
		if ($idviaje != false) {
			$this->db->where("id !=", $idviaje);
		}
		$resultados = $this->db->get("viajes");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else{
			return false;
		}
		
	}

	public function getViajeManifiestoVenta($id){
		$this->db->select("v.*, b.placa,b.asientos,b.marca, t.ciudad as origen, tr.ciudad as destino, r.precio, c.nombres, c.apellidos,c.brevete,co.nombres as nombresc,co.apellidos as apellidosc,co.brevete as brevetec");
		$this->db->from("viajes v");
		
		$this->db->join("rutas r", "v.ruta_id = r.id");
		$this->db->join("buses b", "v.bus_id = b.id");
		$this->db->join("choferes c", "v.chofer_id = c.id");
		$this->db->join("choferes co", "v.copiloto_id = co.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");

		$this->db->where("v.id",$id);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		} else {
			return false;
		}
		
	}



}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasajeros_model extends CI_Model {

	/*public function getPasajeros(){
		
		$resultados = $this->db->get("pasajeros");
		return $resultados->result();
	}*/

	public function getPasajeros()
	{
	    $query = $this->db->get('pasajeros');
	    $return = array();

	    foreach ($query->result() as $pasajero)
	    {
	        $return[$pasajero->id] = $pasajero;
	        $return[$pasajero->id]->subs = $this->cantidadViajes($pasajero->id); // Get the categories sub categories
	    }

	    return $return;
	}


	public function cantidadViajes($idpasajero){
		$this->db->select("COUNT(id) as total");
		$this->db->where("pasajero_id",$idpasajero);
		$resultado = $this->db->get("ventas");
		return $resultado->row();

	}

	public function save($data){
		return $this->db->insert("pasajeros",$data);
	}
	public function getPasajero($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("pasajeros");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("pasajeros",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("pasajeros");
	}

	public function getViaje($ruta,$fecha,$hora){
		$this->db->where("ruta_id",$ruta);
		$this->db->where("fecha",$fecha);
		$this->db->where("hora",$hora);
		$resultados = $this->db->get("viajes");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		} else {
			return false;
		}
		

	}

	
}

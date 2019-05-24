<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas_model extends CI_Model {

	public function getRutas(){
		$this->db->select("r.*, t.ciudad as origen, tr.ciudad as destino");
		$this->db->from("rutas r");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->where("r.estado","1");
		$resultado = $this->db->get();
		return $resultado->result();
	}

	public function save($data){
		return $this->db->insert("rutas",$data);
	}

	public function getRuta($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("rutas");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("rutas",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("rutas");
	}

	public function getRutaForm($id){
		$this->db->select("r.*, t.ciudad as origen, tr.ciudad as destino");
		$this->db->from("rutas r");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->where("r.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

}

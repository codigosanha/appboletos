<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses_model extends CI_Model {

	public function getBuses(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("buses");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("buses",$data);
	}

	public function saveHorario($data){
		return $this->db->insert("horarios",$data);
	}
	public function getBus($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("buses");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("buses",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("buses");
	}
}

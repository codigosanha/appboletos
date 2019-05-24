<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Choferes_model extends CI_Model {

	public function getChoferes(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("choferes");
		return $resultados->result();
	}
	public function getCopilotos(){
		$this->db->where("estado","1");
		$this->db->order_by("id","DESC");
		$resultados = $this->db->get("choferes");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("choferes",$data);
	}
	public function getChofer($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("choferes");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("choferes",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("choferes");
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminales_model extends CI_Model {

	public function getTerminales(){
		$this->db->select("t.*,ud.departamento,up.provincia,udi.distrito");
		$this->db->join("ubdepartamento ud", "t.departamento = ud.idDepa");
		$this->db->join("ubprovincia up", "t.provincia = up.idProv");
		$this->db->join("ubdistrito udi", "t.distrito = udi.idDist");
		$this->db->where("t.estado","1");
		$resultados = $this->db->get("terminales t");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("terminales",$data);
	}
	public function getTerminal($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("terminales");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("terminales",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("terminales");
	}

	public function getDepartamentos(){
		return $this->db->get("ubdepartamento")->result();
	}

	public function getProvincias($iddep){
		$this->db->where("idDepa", $iddep);
		return $this->db->get("ubprovincia")->result();
	}

	public function getDistritos($idprov){
		$this->db->where("idProv", $idprov);
		return $this->db->get("ubdistrito")->result();
	}
}

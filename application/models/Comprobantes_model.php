<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprobantes_model extends CI_Model {

	public function getComprobantes(){
		$this->db->select("c.*,t.ciudad, tc.nombre");
		$this->db->from("comprobantes c");
		$this->db->join("terminales t","c.terminal_id = t.id");
		$this->db->join("tipo_comprobantes tc","c.tipo_comprobante_id = tc.id");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getTipoComprobantes(){
		$this->db->order_by("nombre");
		$resultados = $this->db->get("tipo_comprobantes");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("comprobantes",$data);
	}
	public function getComprobante($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("comprobantes");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("comprobantes",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("comprobantes");
	}

	public function getInfoComprobante($terminal, $tipocomprobante){
		$this->db->where("terminal_id", $terminal);
		$this->db->where("tipo_comprobante_id", $tipocomprobante);
		$resultado = $this->db->get("comprobantes");
		return $resultado->row();
	}
	public function getIdComprobante($tipocomprobante,$serie){
		$this->db->where("tipo_comprobante_id", $tipocomprobante);
		$this->db->where("serie", $serie);
		$resultado = $this->db->get("comprobantes");
		return $resultado->row();
	}

	public function comprobatesTerminales($terminal){
		$this->db->select("c.id,tc.nombre");
		$this->db->join("terminales t", "c.terminal_id = t.id");
		$this->db->join("tipo_comprobantes tc", "c.tipo_comprobante_id = tc.id");
		$this->db->where("terminal_id",$terminal);
		$this->db->order_by("tc.nombre");
		$resultados = $this->db->get("comprobantes c"); 
		return $resultados->result();
	}
}

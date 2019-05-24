<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {
	public function cantidadsalidas()
	{
		$this->db->select(" b.placa,t.ciudad as origen, tr.ciudad as destino,COUNT(v.id) as total");
		$this->db->from("viajes v");
		
		$this->db->join("rutas r", "v.ruta_id = r.id");
		$this->db->join("buses b", "v.bus_id = b.id");
		$this->db->join("terminales t", "r.origen = t.id");
		$this->db->join("terminales tr", "r.destino = tr.id");
		$this->db->group_by(array("v.bus_id","v.ruta_id"));
		$resultados = $this->db->get();

		return $resultados->result();
	}
	public function getID($link){
		$this->db->like("link",$link);
		$resultado = $this->db->get("menus");
		return $resultado->row();
	}

	public function getPermisos($menu,$rol){
		$this->db->where("menu_id",$menu);
		$this->db->where("rol_id",$rol);
		$resultado = $this->db->get("permisos");
		return $resultado->row();
	}

	public function getPermiso($rol){
		$this->db->select("m.link");
		$this->db->from("permisos p");
		$this->db->join("menus m", "p.menu_id = m.id");
		$this->db->where("p.rol_id",$rol);
		$this->db->where("m.link !=","#");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->first_row();
		}
		else{
			return false;
		}
	}

	public function getParents($rol)
	{
		$this->db->select("m.*");
		$this->db->from("menus m");
		$this->db->join("permisos p", "p.menu_id = m.id");
		$this->db->where("p.rol_id",$rol);
		$this->db->where("p.read","1");
		$this->db->where("m.parent","0");
		$this->db->order_by("m.orden");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}
		else{
			return false;
		}
	}

	public function getChildren($rol,$idMenu)
	{
		$this->db->select("m.*");
		$this->db->from("menus m");
		$this->db->join("permisos p", "p.menu_id = m.id");
		$this->db->where("p.rol_id",$rol);
		$this->db->where("p.read","1");
		$this->db->where("m.parent",$idMenu);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}
		else{
			return false;
		}
	}

	public function rowCount($tabla)
	{
		$resultados = $this->db->get($tabla);
		return $resultados->num_rows();
	}	
}
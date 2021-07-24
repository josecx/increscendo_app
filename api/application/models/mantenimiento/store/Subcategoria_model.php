<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategoria_model extends CI_Model {

	public function buscar($args=[])
	{
		return $this->db
		->select("
            a.*,
			DATE_FORMAT(a.fecha_sys, '%m-%d-%Y %H:%i') AS fecha_sys,
			b.nombre as ncategoria")
		->join("categoria b", "a.categoria_id = b.id", "LEFT")
		->order_by("a.categoria_id", "DESC")
        ->where("a.activo", 1)
		->where("b.activo", 1)
		->get("subcategoria a")->result();
	}

	public function guardar($args = [], $id ="")
	{	
		if (!empty($id)) {
			if ($this->db->where("id", $id)->update("subcategoria", $args)) {
				return true;
			} else {
				return false;
			}
		} else{
			if ($this->db->insert("subcategoria", $args)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

	public function buscar($args=[])
	{
		return $this->db
		->select("
            a.*,
			DATE_FORMAT(a.fecha_sys, '%m-%d-%Y %H:%i') AS fecha_sys,
			b.nombre as ncategoria,
            c.nombre as nsubcategoria")
		->join("categoria b", "a.categoria_id = b.id", "LEFT")
        ->join("subcategoria c", "a.subcategoria_id = c.id", "LEFT")
		->order_by("a.categoria_id", "DESC")
        ->where("a.activo", 1)
		->where("b.activo", 1)
        ->where("c.activo", 1)
		->get("producto a")->result();
	}

	public function guardar($args = [], $id ="")
	{	
		if (!empty($id)) {
			if ($this->db->where("id", $id)->update("producto", $args)) {
				return true;
			} else {
				return false;
			}
		} else{
			if ($this->db->insert("producto", $args)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

}

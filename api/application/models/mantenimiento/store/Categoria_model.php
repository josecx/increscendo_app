<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {

	public function buscar($args=[])
	{
		return $this->db
		->select("
            *,
			DATE_FORMAT(fecha_sys, '%m-%d-%Y %H:%i') AS fecha_sys")
		->order_by("fecha_sys", "DESC")
        ->where("activo", 1)
		->get("categoria")->result();
	}

	public function guardar($args = [], $id ="")
	{	
		if (!empty($id)) {
			if ($this->db->where("id", $id)->update("categoria", $args)) {
				return true;
			} else {
				return false;
			}
		} else{
			if ($this->db->insert("categoria", $args)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

}

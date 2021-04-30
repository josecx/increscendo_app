<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacion_model extends CI_Model {

	public function guardar($args = [], $id ="")
	{	
		if (!empty($id)) {
			if ($this->db->where("id", $id)->update("publicacion", $args)) {
				return true;
			} else {
				return false;
			}
		} else{
			if ($this->db->insert("publicacion", $args)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

	public function getPublicaciones($args=[])
	{
		return $this->db
		->select("
			a.*,
			DATE_FORMAT(a.fecha_sys, '%m-%d-%Y %H:%i') AS fecha_publicado,
			b.nombre as tipo,
			b.icono")
		->join("tipo_recurso b", "a.tipo_recurso_id = b.id")
		->order_by("a.fecha_sys", "DESC")
		->get("publicacion a")->result();
	}
}

/* End of file Publicacion_model.php */
/* Location: ./application/models/mantenimiento/Publicacion_model.php */
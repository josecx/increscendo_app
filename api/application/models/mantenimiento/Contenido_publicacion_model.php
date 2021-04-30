<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contenido_publicacion_model extends CI_Model {

	public function guardar($args = [], $id ="")
	{	
		if (!empty($id)) {
			if ($this->db->where("id", $id)->update("contenido_publicacion", $args)) {
				return true;
			} else {
				return false;
			}
		} else{
			if ($this->db->insert("contenido_publicacion", $args)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

	public function getPublicacion($args=[])
	{
		$method = "result";

		if (elemento($args, "termino")) {
			$termino = $args["termino"];
			$this->db
			->where("(nombre like '%$termino%' or descripcion like '%$termino%')");

		}

		return $this->db
		->select("
			a.*,
			DATE_FORMAT(a.fecha_sys, '%m-%d-%Y %H:%i') AS fecha_publicado,
			b.nombre as recurso,
			b.icono
		")
		->join("tipo_recurso b", "b.id = a.tipo_recurso_id")
		->get("contenido_publicacion a")->$method();
	}

	public function guardarDocente($args=[])
	{
		$row = $this->db->where("contenido_id", $args->contenido_id)->get("contenido_docente")->row();
		if ($row) {
			if ($this->db->where("contenido_id", $row->id)->update("contenido_docente", $args)) {
				return true;
			}
		} elseif ($this->db->insert("contenido_docente", $args)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

}

/* End of file Contenido_publicacion_model.php */
/* Location: ./application/models/mantenimiento/Contenido_publicacion_model.php */
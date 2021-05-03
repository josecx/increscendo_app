<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contenido_model extends CI_Model {

	public function guardar($args = [], $id ="")
	{	
		if (!empty($id)) {
			if ($this->db->where("id", $id)->update("contenido", $args)) {
				return true;
			} else {
				return false;
			}
		} else{
			if ($this->db->insert("contenido", $args)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

	public function getContenidos($args=[])
	{
		$method = "result";

		if (elemento($args, "termino")) {
			$termino = $args["termino"];
			$this->db
			->where("(a.nombre like '%$termino%' or a.descripcion like '%$termino%')");
		}

		if (elemento($args, "rol")) {
			switch ($args["rol"]) {
				case 2:
					$this->db->where("b.usuario_id", $args["usuario"]);
					break;
				case 3:
					$this->db->where("d.usuario_id", $args["usuario"]);
					break;
			}
		}

		return $this->db
		->select("
			a.*,
			c.apellido as adocente,
			c.nombre as ndocente
		")
		->join("contenido_docente b", "b.contenido_id = a.id", "left")
		->join("usuario c", "b.usuario_id = c.id", "left")
		->join("contenido_padres d", "d.contenido_id = a.id", "left")
		->group_by("a.id")
		->get("contenido a")->$method();
	}

}

/* End of file Contenido_model.php */
/* Location: ./application/models/mantenimiento/Contenido_model.php */
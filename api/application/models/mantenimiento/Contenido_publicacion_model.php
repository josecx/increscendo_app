<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contenido_publicacion_model extends General_model {
	public $contenido_id;
	public $nombre;
	public $descripcion;
	public $recurso;
	public $tipo_recurso_id=3;
	public $activo=1;
	public $usuario_id;
	public $recurso_link;
	public $link=0;

	public function __construct($id="")
	{
		parent::__construct();
		
		if (!empty($id)) {
			$this->cargar($id);
		}
	}

	public function getPublicacion($args=[])
	{
		$method = "result";

		if (elemento($args, "contenido")) {
			$this->db->where("a.contenido_id", $args["contenido"]);
		}

		if (elemento($args, "termino")) {
			$termino = $args["termino"];
			$this->db
			->where("(nombre like '%$termino%' or descripcion like '%$termino%')");

		}

		return $this->db
		->select("
			a.*,
			DATE_FORMAT(a.fecha_sys, '%m-%d-%Y %H:%i') AS fecha_publicado,
			b.nombre as recurso_nombre,
			b.icono
		")
		->join("tipo_recurso b", "b.id = a.tipo_recurso_id")
		->where("a.activo",1)
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

	public function activarPadres($args=[])
	{
		$row = $this->db
					->where("contenido_id", $args["contenido_id"])
					->where("usuario_id", $args["usuario_id"])
					->get("contenido_padres")->row();
		if (empty($row)) {
			if ($this->db->insert("contenido_padres", $args)) {
				return true;
			}
		}
	}

}

/* End of file Contenido_publicacion_model.php */
/* Location: ./application/models/mantenimiento/Contenido_publicacion_model.php */
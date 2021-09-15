<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacion_model extends General_model {
	public $nombre;
	public $descripcion;
	public $recurso;
	public $activo=1;
	public $usuario_id;
	public $tipo_recurso_id;

	public function __construct($id="")
	{
		parent::__construct();
		
		if (!empty($id)) {
			$this->cargar($id);
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
		->where("a.activo", 1)
		->get("publicacion a")->result();
	}
}

/* End of file Publicacion_model.php */
/* Location: ./application/models/mantenimiento/Publicacion_model.php */
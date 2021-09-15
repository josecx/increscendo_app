<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends General_model {
	public $nombre;
	public $descripcion;
	public $activo=1;
	public $usuario_id;

	public function __construct($id="")
	{
		parent::__construct();
		
		if (!empty($id)) {
			$this->cargar($id);
		}
	}

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

}

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategoria_model extends General_model {
	public $categoria_id;
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
            a.*,
			DATE_FORMAT(a.fecha_sys, '%m-%d-%Y %H:%i') AS fecha_sys,
			b.nombre as ncategoria")
		->join("categoria b", "a.categoria_id = b.id", "LEFT")
		->order_by("a.categoria_id", "DESC")
        ->where("a.activo", 1)
		->where("b.activo", 1)
		->get("subcategoria a")->result();
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends General_model {
	public $nombre;
	public $codigo;
	public $subcategoria_id;
	public $categoria_id;
	public $descripcion;
	public $imagen;
	public $imagen_link;
	public $usuario_id;
	public $activo = 1;
	public $precio_compra;
	public $precio_venta;
	public $favorito;

	public function __construct($id="")
	{
		parent::__construct();
		
		if (!empty($id)) {
			$this->cargar($id);
		}
	}

	public function buscar($args=[])
	{
		if(elemento($args, "subcategoria")){
			$this->db->where("c.id", $args["subcategoria"]);
		}

		if(elemento($args, "producto_id")){
			$this->db->where("a.id", $args["producto_id"]);
		}

		$tmp =  $this->db
		->select("
            a.*,
			DATE_FORMAT(a.fecha_sys, '%m-%d-%Y %H:%i') AS fecha_sys,
			b.nombre as ncategoria,
            c.nombre as nsubcategoria")
		->from("producto a")
		->join("categoria b", "a.categoria_id = b.id", "LEFT")
        ->join("subcategoria c", "a.subcategoria_id = c.id", "LEFT")
		->order_by("a.categoria_id", "DESC")
		->group_by("a.id")
        ->where("a.activo", 1)
		->where("b.activo", 1)
        ->where("c.activo", 1)
		->get();

		return verConsulta($tmp, $args);
	}

	public function buscar_producto_imagen($args=[])
	{
		if (elemento($args, "producto_id")) {
			$this->db->where("producto_id", $args["producto_id"]);
		}

		return $this->db
			->where("activo", 1)
			->get("producto_imagen")
			->result();
	}

	public function guardar_producto_imagen($args=[], $idx="")
	{
		if (!empty($idx)) {
			if ($this->db->where("id", $idx)->update("producto_imagen", ["activo" => 0])) {
				return true;
			}
		} else {
			if ($this->db->insert("producto_imagen", $args)) {
				return true;
			}
		}

		return false;
	}

}

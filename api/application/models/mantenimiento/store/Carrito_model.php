<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito_model extends General_model {
    public $usuario_id;
    public $producto_id;
    public $cantidad;
    public $total;
    public $activo=1;
	public $comprado=0;

	public function __construct($id="")
	{
		parent::__construct();
		$this->usuario = $this->session->userdata('usuario');
		if (!empty($id)) {
			$this->cargar($id);
		}
	}


	public function buscar($args=[])
	{

		if(elemento($args, "producto_id")){
			$this->db->where("a.producto_id", $args["producto_id"]);
		}

		$tmp = $this->db
		->select("a.*, 
			b.nombre as nproducto,
			b.codigo,
			b.imagen_link")
		->join("producto b", "b.id = a.producto_id", "left")
		->where("a.activo", 1)
		->where("a.usuario_id", $this->usuario->id)
		->order_by("a.fecha_sys","desc")
		->get("carrito a");

		return verConsulta($tmp, $args);
	}

    public function validarProducto()
    {
		if (!empty($this->producto_id) && !empty($this->usuario_id)) {
			if ($this->getPK()) {
				$this->db->where('id <>', $this->getPK());
			}

			$tmp = $this->db
			->where('producto_id', $this->producto_id)
            ->where('usuario_id', $this->usuario_id)
			->where('activo', 1)
			->get('carrito');

			if ($tmp->num_rows() > 0) {
				return $tmp->id;
			}
		}

		return false;
    }
}
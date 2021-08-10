<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mante_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function _getrol()
	{
		return $this->db->get("rol")->result();
	}

	public function _getsexo()
	{
		return $this->db->get("sexo")->result();
	}

	public function _gettipo_recurso()
	{
		return $this->db->get("tipo_recurso")->result();
	}

	public function _getusuario_root()
	{
		return $this->db->where("rol_id <>",3)->get("usuario")->result();
	}

	public function _getpadres()
	{
		return $this->db->select("nombre, id, concat(apellido, ' ', nombre) as nombre_completo")->where("rol_id", 3)->get("usuario")->result();
	}

	public function _getcategoria()
	{
		return $this->db->where("activo",1)->get("categoria")->result();
	}
	public function _getsubcategoria()
	{
		return $this->db->where("activo",1)->get("subcategoria")->result();
	}
}

/* End of file Mante_model.php */
/* Location: ./application/models/mantenimiento/Mante_model.php */
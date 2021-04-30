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
		return $this->db->where("id <>",3)->get("usuario")->result();
	}
}

/* End of file Mante_model.php */
/* Location: ./application/models/mantenimiento/Mante_model.php */
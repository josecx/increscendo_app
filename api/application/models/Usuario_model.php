<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function validarCorreo($correo)
	{
		return $this->db->where("correo", $correo)->get("usuario")->row();
	}

	public function login($args=[])
	{
		if (elemento($args, "usuario") && elemento($args, "password")) {
			return $this->db
						->where("usuario", $args["usuario"])
						->where("password", $args["password"])
						->get("usuario")
						->row();
		}
	}

	public function getRoles()
	{
		return $this->db->get("rol")->result();
	}

	public function guardar($args = [])
	{
		if ($this->db->insert("usuario", $args)) {
			return true;
		} else{
			return false;
		}
	}
}

/* End of file Usuario_model.php */
/* Location: ./application/models/Usuario_model.php */
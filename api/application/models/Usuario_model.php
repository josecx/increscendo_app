<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getUsuario($args=[])
	{
		return $this->db
			->select(
				"id,
				 apellido,
				 nombre,
				 usuario,
				 correo,
				 rol_id,
				 sexo_id,
				 activo
				"
			)
			->from("usuario")
			->where("activo", 1)
			->get()
			->result();
	}

	public function validarCorreo($correo)
	{
		return $this->db
			->select(
				"id,
				apellido,
				nombre,
				usuario,
				correo,
				token_pass,
				activo,
				rol_id"
			)
			->from("usuario")
			->where("correo", $correo)
			->get()
			->row();
	}

	public function login($args=[])
	{
		if (elemento($args, "usuario") && elemento($args, "password")) {
			return $this->db
			->select(
				"id,
				apellido,
				nombre,
				usuario,
				correo,
				token_pass,
				activo,
				rol_id"
			)
			->from("usuario")
			->where("usuario", $args["usuario"])
			->where("password", $args["password"])
			->get()
			->row();
		}
	}

	public function getRoles()
	{
		return $this->db->get("rol")->result();
	}

	public function getSexo()
	{
		return $this->db->get("sexo")->result();
	}

	public function guardar($args = [], $id ="")
	{	
		if (!empty($id)) {
			if ($this->db->where("id", $id)->update("usuario", $args)) {
				return true;
			} else {
				return false;
			}
		} else{
			if ($this->db->insert("usuario", $args)) {
				return $this->db->insert_id();
			} else {
				return false;
			}
		}
	}

	public function eliminarUsuario($id)
	{
		$this->db->where("id", $id)->delete("usuario");
	}
}

/* End of file Usuario_model.php */
/* Location: ./application/models/Usuario_model.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
	}

	public function getRol()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Usuario_model->getRoles($_GET)
		]));
	}

	public function guardar()
	{
		$data  = ['exito' => 0];
		$datos = json_decode(file_get_contents('php://input'));
		if (isset($datos->correo)) {
			if ($this->Usuario_model->validarCorreo($datos->correo)) {
				$data['mensaje'] = "el correo que intentas introducir ya existe";
			} else {
				$password = randomPassword();
				$datos_guardar = [
					"apellido"  => (isset($datos->apellido)) ? $datos->apellido : '',
					"nombre"    => (isset($datos->nombre))   ? $datos->nombre   : '',
					"usuario"   => (isset($datos->usuario))  ? $datos->usuario  : '',
					"correo"    => $datos->correo,
					"password"  => sha1($password),
					"estado_id" => '1'
 				];

 				if ($this->Usuario_model->guardar($datos_guardar)) {
					enviarEmail([
						"to_email" 	 => $datos->correo,
						"to_name" 	 => "ELSEÑOR",
						"subject"	 => "SIGNUP",
						"html" 		 => $password
					]);
					$data['mensaje'] = "si se pudo";
 				}
			}
		}

		$this->output->set_output(json_encode($data));
	}

	public function login()
	{
		$response = ["exito" => 0, "mensaje" => "usuario y/o contraseña incorrectos"];
		$datos = json_decode(file_get_contents('php://input'));
		if (isset($datos->usuario) && isset($datos->password)) {
			$args = [
				"usuario"  => $datos->usuario,
				"password" => sha1($datos->password)
			];

			if ($this->Usuario_model->login($args)) {
				$response["mensaje"] = "logueado correctamente";
			}
		}
		$this->output->set_output(json_encode($response));
	}

}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */
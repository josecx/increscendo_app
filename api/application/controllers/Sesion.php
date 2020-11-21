<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->t_sesion = 14400;
	}

	public function login()
	{
		$response = [
			"exito"   => false, 
			"mensaje" => "usuario y/o contraseña incorrectos"
		];

		$datos = json_decode(file_get_contents('php://input'));
		
		if (isset($datos->usuario) && isset($datos->password)) {
			$args = [
				"usuario"  => $datos->usuario,
				"password" => sha1($datos->password)
			];
			$logued = $this->Usuario_model->login($args);
			if ($logued) {
				$this->load->library('Token');
				$token = new Token();

				$t_vida  = time() + $this->t_sesion;

				$s_token = $token->_setToken_([
					"expira" => time()+7200,
					"data"   => $logued
				]);

				$response["token"]    = $s_token;
				$response["mensaje"]  = "logueado correctamente";
				$response["exito"]    = true;
				$response["expira"]   = $this->t_sesion;
				$response["registro"] = $logued;
			}
		}
		$this->output->set_output(json_encode($response));
	}
}

/* End of file Sesion.php */
/* Location: ./application/controllers/Sesion.php */
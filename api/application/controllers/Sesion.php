<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->t_sesion = 300;
	}

	public function login()
	{
		$response = ["exito" => false, "warning" => false];

		$datos = json_decode(file_get_contents('php://input'));
		
		if (verPropiedad($datos, "usuario") && verPropiedad($datos, "password")) {
			$usuario = $this->Usuario_model->getUsuario(['usuario' => $datos->usuario]);
			if ($usuario) {
				if (sha1($datos->password) == $usuario->password) {
					$this->load->library(['Token','user_agent']);
					$token = new Token();

					$t_vida  = time() + $this->t_sesion;

					$s_token = $token->_setToken_([
						"expira" => time()+7200,
						"data"   => $usuario
					]);
					$this->session->set_userdata(['usuario' => $usuario]);
					$response["token"]    = $s_token;
					$response["mensaje"]  = "Bienvenido ".$usuario->nombre;
					$response["exito"]    = true;
					$response["expira"]   = $this->t_sesion;
					$response["registro"] = $usuario;
				} else {
					$response["mensaje"] = "Contraseña incorrecta";
				}
			} else {
				$response["mensaje"] = "El usuario '".$datos->usuario."' no existe";
			}
		}else{
			$response["warning"] = true;
			$response["mensaje"] = "Hacen falta datos para continuar";
		}
		$this->output->set_output(json_encode($response));
	}
}

/* End of file Sesion.php */
/* Location: ./application/controllers/Sesion.php */
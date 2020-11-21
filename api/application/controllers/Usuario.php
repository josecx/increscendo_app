<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->t_sesion = 14400;
	}

	public function getRol()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Usuario_model->getRoles($_GET)
		]));
	}

	public function getSexo()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Usuario_model->getSexo($_GET)
		]));
	}

	public function validarCorreo()
	{	
		$response = ["exito" => false];
		$correo = $this->Usuario_model->validarCorreo($_GET["correo"]);
		if ($correo) {
			$response["exito"]    = true;
			$response["mensaje"]  = "Ya existe una cuenta registrada con el correo ".$_GET["correo"];
			$response["registro"] = $correo;
		}
		$this->output->set_output(json_encode($response));
	}

	public function guardar()
	{
		$response = ['exito' => 0];
		$datos    = json_decode(file_get_contents('php://input'));
		if (isset($datos->correo)) {
			if ($this->Usuario_model->validarCorreo($datos->correo)) {
				$response['mensaje'] = "el correo que intentas introducir ya existe";
			} else {
				$password = randomPassword(20);
				$datos_guardar = [
					"apellido"  => (isset($datos->apellido)) 	 ? $datos->apellido 	: '',
					"nombre"    => (isset($datos->nombre))   	 ? $datos->nombre   	: '',
					"usuario"   => (isset($datos->usuario))      ? $datos->usuario  	: '',
					"sexo_id"	=> (isset($datos->sexo_id['0'])) ? $datos->sexo_id['0'] : '',
					"correo"    => $datos->correo,
					"password"  => sha1($password),
					"estado_id" => '1',
 				];
 				$insert_id = $this->Usuario_model->guardar($datos_guardar);
 				if ($insert_id) {
					$mail = enviarEmail([
						"to_email" 	 => $datos_guardar['correo'],
						"to_name" 	 => $datos_guardar['nombre']." ".$datos_guardar['apellido'],
						"subject"	 => "Bienvenido a Increscendo App",
						"html" 		 => $password
					]);

					if ($mail) {
						$response['mensaje'] = "Usuario creado correctamente. Hemos enviado un correo con tu contraseña";
						$response['exito']	 = true;
					} else {
						$this->Usuario_model->eliminarUsuario($insert_id);
						$response['mensaje'] = "Ha ocurrido un error al enviar el correo de confirmación. Intenta nuevamenta.";
						$response['exito']	 = false;
					}
 				}
			}
		}

		$this->output->set_output(json_encode($response));
	}

	public function recuperarPassword()
	{
		$response = [
			'exito'   => 0, 
			'mensaje' => 'Hacen falta datos para continuar.'
		];
		$datos = json_decode(file_get_contents('php://input'));
		if (isset($datos->correo)) {
			$password = randomPassword(20);
			$datos_update = [
				"password" => sha1($password)
			];

			if ($this->Usuario_model->guardar($datos_update, $datos->registro->id)) {
				$mail = enviarEmail([
					"to_email" 	 => $datos->correo,
					"to_name" 	 => $datos->registro->nombre." ".$datos->registro->apellido,
					"subject"	 => "Reenvio de contraseña",
					"html" 		 => $password
				]);

				if ($mail) {
					$response['mensaje'] = "Hemos enviado un correo con tu nueva contraseña.";
					$response['exito']	 = true;
				} else {
					$response['mensaje'] = "Ha ocurrido un error al completar el proceso. Intenta nuevamenta.";
					$response['exito']	 = false;
				}
			}

		}
		$this->output->set_output(json_encode($response));	
	}

	public function cambiarPassword()
	{
		$datos = json_decode(file_get_contents('php://input'));
		if (isset($datos->pass_actual) && 
			isset($datos->pass_nuevo) && 
			isset($datos->usuario)) {
			$args = [
				"usuario"  => $datos->usuario->usuario,
				"password" => $datos->pass_actual
			];
			if ($this->Usuario_model->login($args)) {
				$datos_update = [
					"password" => $datos->pass_nuevo
				];
				if ($this->Usuario_model->guardar($datos_update, $datos->usuario->id)) {
					$response["mensaje"]  = "Contraseña actualizada correctamente";
					$response["exito"]    = true;					
				} else {
					$response["mensaje"]  = "Algo salió mal, intentalo nuevamente";
					$response["exito"]    = false;
				}
			} else {
				$response["mensaje"]  = "Asegurate de ingresar tu contraseña actual para poder continuar";
				$response["exito"]    = false;
			}
		}
		$this->output->set_output(json_encode($response));
	}

}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */
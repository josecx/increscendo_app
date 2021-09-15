<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model');
		$this->load->model('Usuario_demo_model');
		
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

	public function getLista()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Usuario_model->getUsuario($_GET)
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

	public function guardar($id = "")
	{
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = json_decode(file_get_contents('php://input'));
		$mail = false;
		if (isset($datos->correo)) {
			$usuario = $this->Usuario_model->validarCorreo($datos->correo);
			if ($usuario && !$id) {
				$response['warning'] = true;
				$response['mensaje'] = "Este correo ya está registrado. Usuario: ".$usuario->usuario;
			} else {
				$password = randomPassword(20);
				$datos_guardar = [
					"apellido"  => (isset($datos->apellido)) ? $datos->apellido : '',
					"nombre"    => (isset($datos->nombre))   ? $datos->nombre   : '',
					"usuario"   => (isset($datos->usuario))  ? $datos->usuario  : '',
					"rol_id"	=> (isset($datos->rol_id))   ? $datos->rol_id   : '3',
					"correo"    => $datos->correo,
					"estado_id" => '1',
 				];
				if (!$id)
					$datos_guardar["password"] = sha1($password);

 				$insert_id = $this->Usuario_model->guardar($datos_guardar, $id);
 				if ($insert_id) {

					if (!$id) {
						$mail = enviarEmail([
							"to_email" 	 => $datos_guardar['correo'],
							"to_name" 	 => $datos_guardar['nombre']." ".$datos_guardar['apellido'],
							"subject"	 => "Bienvenido a Increscendo App",
							"html" 		 => $this->load->view('mail/bienvenido_mail',
											[
												'password' => $password,
												'usuario'  => $datos_guardar
											],
											true)
						]);
					}

					if ($mail) {
						$response['mensaje'] = "Usuario creado correctamente. Hemos enviado un correo con la contraseña";
						$response['exito']	 = true;
					} elseif ($id) {
						$response['mensaje'] = "Usuario actualizado exitosamente";
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
			'warning' => false
		];
		$datos = json_decode(file_get_contents('php://input'));
		if (verPropiedad($datos, "correo")) {
			$usuario = $this->Usuario_model->getUsuario(['correo' => $datos->correo]);
			if ($usuario) {
				$password = randomPassword(20);
				$datos_update = [
					"password" => sha1($password)
				];

				if ($this->Usuario_model->guardar($datos_update, $usuario->id)) {
					$mail = enviarEmail([
						"to_email" 	 => $usuario->correo,
						"to_name" 	 => $usuario->nombre." ".$usuario->apellido,
						"subject"	 => "Reenvio de contraseña",
						"html" 		 => $this->load->view('mail/recuperarPass_mail',
										[
											'password' => $password,
											'usuario'  => $usuario
										],
										true)
					]);

					if ($mail) {
						$response['mensaje'] = "Hemos enviado un correo con una nueva contraseña";
						$response['exito']	 = true;
					} else {
						$response['mensaje'] = "Ha ocurrido un error al completar el proceso. Intenta nuevamenta";
						$response['warning'] = true;
					}
				}
			} else {
				$response["mensaje"] = "Ningún usuario está registrado con el correo: '".$datos->correo;
			}
		} else {
			$response["warning"] = true;
			$response["mensaje"] = "Ingresa tu correo para continunar";
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

	public function usuario_demo()
	{
		$response = [
			'exito'   => 0, 
			'warning' => false
		];
		$datos = json_decode(file_get_contents('php://input'));
		
		if(isset($datos->correo)){			
			if($this->Usuario_demo_model->guardar($datos)){
				$response['exito']   = 1;
			}
		}else {
			$response['warning'] = true;
			$response['mensaje'] = 'Es necesario ingresar el correo para poder continuar';
		}
		$this->output->set_output(json_encode($response));
	}

}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */
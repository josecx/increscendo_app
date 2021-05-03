<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contenido extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('/mantenimiento/Contenido_model');
		$this->usuario = $this->session->userdata('usuario');
	}

	public function guardar($id = "")
	{
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = json_decode(file_get_contents('php://input'));
		$datos->usuario_id = $this->usuario->id;
		$result = $this->Contenido_model->guardar($datos, $id);
		if ($result) {
			$accion = (!empty($id)) ? "actualizado" : "creado";
			$response['exito']   = true;
			$response['mensaje'] = "Se ha {$accion} correctamente el contenido: {$datos->nombre}";
		} else {
			$response['exito']   = 2;
			$response["Ha ocurrido un error, intenta nuevamente"];
		}

		$this->output->set_output(json_encode($response));
	}

	public function getLista()
	{
		if (!empty($this->usuario)) {
			$_GET["rol"] 	 = $this->usuario->rol_id;
			$_GET["usuario"] = $this->usuario->id;
		}
		$this->output->set_output(json_encode([
			'lista' => $this->Contenido_model->getContenidos($_GET)
		]));
	}

}

/* End of file Contenido.php */
/* Location: ./application/controllers/mantenimiento/Contenido.php */
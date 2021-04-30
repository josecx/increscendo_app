<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('/mantenimiento/Publicacion_model');
		$this->usuario = $this->session->userdata('usuario');
	}

	public function guardar($id = "")
	{
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = json_decode(file_get_contents('php://input'));
		$datos->usuario_id = $this->usuario->id;

		if ($datos->tipo_recurso_id == 1) {
			$datos->recurso = getUrlVideo($datos->recurso);
		}

		$result = $this->Publicacion_model->guardar($datos, $id);
		if ($result) {
			$accion = (!empty($id)) ? "actualizado" : "publicado";
			$response['exito']   = true;
			$response['mensaje'] = "Se ha {$accion} correctamente: {$datos->nombre}";
		} else {
			$response['exito']   = 2;
			$response["Ha ocurrido un error, intenta nuevamente"];
		}

		$this->output->set_output(json_encode($response));
	}

	public function getLista()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Publicacion_model->getPublicaciones($_GET)
		]));
	}

}

/* End of file Publicacion.php */
/* Location: ./application/controllers/mantenimiento/Publicacion.php */
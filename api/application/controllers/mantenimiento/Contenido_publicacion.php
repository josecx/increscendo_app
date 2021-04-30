<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contenido_publicacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('/mantenimiento/Contenido_publicacion_model');
		$this->usuario = $this->session->userdata('usuario');
	}

	public function guardar($id = "")
	{
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = json_decode(file_get_contents('php://input'));
		$datos->usuario_id   = $this->usuario->id;
		if ($datos->tipo_recurso_id == 1) {
			$datos->recurso = getUrlVideo($datos->recurso);
		}
		$result = $this->Contenido_publicacion_model->guardar($datos, $id);
		if ($result) {
			$accion = (!empty($id)) ? "actualizado" : "creado";
			$response['exito']   = true;
			$response['mensaje'] = "Se ha {$accion} correctamente la publicación: {$datos->nombre}";
		} else {
			$response['exito']   = 2;
			$response["Ha ocurrido un error, intenta nuevamente"];
		}

		$this->output->set_output(json_encode($response));
	}

	public function guardarDocente()
	{
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = json_decode(file_get_contents('php://input'));
		$result = $this->Contenido_publicacion_model->guardarDocente($datos);
		if ($result) {
			$response['exito']   = true;
			$response['mensaje'] = "Se ha asignado correctamente el docente";
		} else {
			$response['exito']   = 2;
			$response["Ha ocurrido un error, intenta nuevamente"];
		}

		$this->output->set_output(json_encode($response));
	}

	public function getLista()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Contenido_publicacion_model->getPublicacion($_GET)
		]));
	}


}

/* End of file Contenido_publicacion.php */
/* Location: ./application/controllers/mantenimiento/Contenido_publicacion.php */
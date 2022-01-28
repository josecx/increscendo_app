<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', '0');
class Contenido_publicacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('/mantenimiento/Contenido_publicacion_model');
		$this->usuario = $this->session->userdata('usuario');
	}

	public function guardar($id = "")
	{
		$response  = ['exito' => 0, 'warning' => 0];
		$datos     = (object)$_POST;
		$continuar = true;
		$publicacion = new Contenido_publicacion_model($id);
		if (isset($_FILES["archivo"]) && !empty($_FILES["archivo"]["tmp_name"])) {
			$_FILES["archivo"]["carpeta"] = "Contenido";
			$archivo = subirArchivo($_FILES["archivo"]);

			if ($archivo->exito ==1) {
				$datos->recurso_link = $archivo->link;
				$datos->recurso = $archivo->key;
				$datos->tipo_recurso_id = getTipoRecurso($archivo->tipo);
			} else {
				$continuar = false;
				$response["mensaje"] = "No fue posible guardar el archivo, por favor intenta de nuevo";
			}
		} else if(
			isset($datos->link) && 
			$datos->link == 1 &&
			isset($datos->activo) && 
			$datos->activo == 1
			){
			$datos->recurso_link = $datos->archivo;
			$datos->recurso = getUrlRecurso($datos->archivo);
		}

		if ($continuar) {
			if ($publicacion->guardar($datos)) {
				$accion = (!empty($id)) ? "actualizado" : "guardando";
				if (isset($datos->activo) && $datos->activo == 0) {
					$accion = "eliminado";
				}
				$response['exito']   = true;
				$response['mensaje'] = "Se ha {$accion} correctamente la publicación: {$datos->nombre}";
			} else {
				$response['exito']   = 2;
				$response["mensaje"] = $publicacion->getMensaje();
			}
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
			$response["mensaje"] = "Ha ocurrido un error, intenta nuevamente";
		}

		$this->output->set_output(json_encode($response));
	}

	public function activarPadres()
	{
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = json_decode(file_get_contents('php://input'));
		if (isset($datos->usuarios)) {
			foreach ($datos->usuarios as $row) {
				$args = ['contenido_id' => $datos->contenido_id, 'usuario_id' => $row->id];
				$this->Contenido_publicacion_model->activarPadres($args);
			}
			$response['exito']  = 1;
			$response['mensaje']  = "Proceso completado exitosamente";
		} else {
			$response['exito'] = 3;
			$response['mensaje'] = "Ha ocurrido un error, intenta nuevamente";
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
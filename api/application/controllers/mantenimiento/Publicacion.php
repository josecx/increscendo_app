<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 7200);
ob_implicit_flush(true);
class Publicacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('/mantenimiento/Publicacion_model');
		$this->usuario = $this->session->userdata('usuario');
	}

	public function guardar($id = "")
	{
		set_time_limit(0);
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = (object)$_POST;
		if (isset($this->usuario->id)) {
			$datos->usuario_id = $this->usuario->id;
			$continuar = true;
			$publicacion = new Publicacion_model($id);
			if (isset($datos->activo) && $datos->activo == 1) {
				if (isset($_FILES["archivo"]) && !empty($_FILES["archivo"]["tmp_name"])) {
					$_FILES["archivo"]["carpeta"] = "Contenido";
					$archivo = subirArchivo($_FILES["archivo"]);
		
					if ($archivo) {
						$datos->recurso_link = $archivo->link;
						$datos->recurso = $archivo->key;
						$datos->tipo_recurso_id = getTipoRecurso($archivo->tipo);
					} else {
						$continuar = false;
						$response["mensaje"] = "No fue posible guardar el archivo, por favor intenta de nuevo";
					}
				} else if(isset($datos->link) && $datos->link == 1){
					$datos->recurso = getUrlRecurso($datos->archivo);
				}
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
		} else {
			$response["exito"] = 3;
			$response["mensaje"] = "Ha ocurrido un error con la información de su usuario, intente iniciar sesión nuevamente";
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
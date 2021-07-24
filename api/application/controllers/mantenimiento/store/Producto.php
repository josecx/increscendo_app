<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('/mantenimiento/store/Producto_model');
        $this->usuario = $this->session->userdata('usuario');
        
    }

	public function getLista()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Producto_model->buscar($_GET)
		]));
	}

    public function guardar($id = "")
	{
		$response = ['exito' => 0, 'warning' => 0];
		$datos    = json_decode(file_get_contents('php://input'));

        $datos->imagen_link = getUrlRecurso($datos->imagen);
        
		if (isset($this->usuario->id)) {
			$datos->usuario_id = $this->usuario->id;

			$result = $this->Producto_model->guardar($datos, $id);
			if ($result) {
				$accion = (!empty($id)) ? "actualizado" : "guardando";
				$response['exito']   = true;
				$response['mensaje'] = "Se ha {$accion} correctamente: {$datos->nombre}";
			} else {
				$response['exito']   = 2;
				$response["mensaje"] = "Ha ocurrido un error, intenta nuevamente";
			}
		} else {
			$response["exito"] = 3;
			$response["mensaje"] = "Ha ocurrido un error con la información de su usuario, intente iniciar sesión nuevamente";
		}
		$this->output->set_output(json_encode($response));
	}
}

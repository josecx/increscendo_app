<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('/mantenimiento/store/Producto_model');
		$this->output->set_content_type('application/json');
        $this->usuario = $this->session->userdata('usuario');
        
    }

	public function getLista()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Producto_model->buscar($_GET)
		]));
	}
	
	public function getProductoImagen()
	{
		$this->output->set_output(json_encode([
			"lista" => $this->Producto_model->buscar_producto_imagen($_GET)
		]));
	}

    public function guardar($id = "")
	{
		$response  = ['exito' => 0, 'warning' => 0];
		$datos 	   = (object)$_POST;
		$continuar = true;
		$producto  = new Producto_model($id);

		if (isset($_FILES["archivo"]) && !empty($_FILES["archivo"]["tmp_name"])) {
			$_FILES["archivo"]["carpeta"] = "Store";
			$imagen = subirArchivo($_FILES["archivo"]);

			if ($imagen) {
				$datos->imagen_link = $imagen->link;
				$datos->imagen = $imagen->key;	
			} else {
				$continuar = false;
				$response["mensaje"] = "No fue posible guardar la imagen, por favor intenta de nuevo";
			}
		}

		if ($continuar) {
			if ($producto->guardar($datos)) {
				$accion = (!empty($id)) ? "actualizado" : "guardando";
				$response['exito']   = true;
				$response['mensaje'] = "Se ha {$accion} correctamente: {$datos->nombre}";
			} else {
				$response['exito']   = 2;
				$response["mensaje"] = $producto->getMensaje();
			}
		}
		$this->output->set_output(json_encode($response));
	}

	public function productoImagen($id="")
	{
		$response  = ['exito' => 0, 'warning' => 0];
		$continuar = true;
		$producto  = new Producto_model();
		$datos 	   = new stdClass();
		$datos->producto_id = $id;

		if (isset($_FILES["archivo"]) && !empty($_FILES["archivo"]["tmp_name"])) {
			$_FILES["archivo"]["carpeta"] = "Store";
			$imagen = subirArchivo($_FILES["archivo"]);

			if ($imagen) {
				$datos->imagen_link = $imagen->link;
				$datos->imagen = $imagen->key;	
			} else {
				$continuar = false;
				$response["mensaje"] = "No fue posible guardar la imagen, por favor intenta de nuevo";
			}
		}

		if ($continuar) {
			if ($producto->guardar_producto_imagen($datos)) {
				$accion = (!empty($id)) ? "actualizado" : "guardando";
				$response['exito']   = true;
				$response['mensaje'] = "Se ha {$accion} correctamente";
			} else {
				$response['exito']   = 2;
				$response["mensaje"] = "Error en BD";
			}
		}
		$this->output->set_output(json_encode($response));
	}
}

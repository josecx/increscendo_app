<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mantenimiento/store/Carrito_model');
		$this->output->set_content_type('application/json');
	}

    public function index()
    {
        die("Acceso denegado");
    }

	public function getLista()
	{
		$this->output->set_output(json_encode([
			'lista' => $this->Carrito_model->buscar($_GET)
		]));
	}	

	public function guardar($id='')
	{
		$datos = json_decode(file_get_contents('php://input'));
		$data  = ['exito' => 0];

        $producto = $this->Carrito_model->buscar([
            "producto_id" => $datos->producto_id,
            "uno" => true
        ]);

        if($producto){
            $datos->cantidad += $producto->cantidad;
            $datos->total += $producto->total;
            $id = $producto->id;
        }
        
        $carrito = new Carrito_model($id);

        if ($carrito->guardar($datos)) {
            $data['exito'] = 1;
            $texto = empty($id) ? 'añadido':'actualizado';
            $data['mensaje'] = "Se ha {$texto} el producto:";
            $data['linea'] = $carrito->buscar([
                'id' => $carrito->getPK(),
                '_uno' => true
            ]);
        } else {
            $data['mensaje'] = $carrito->getMensaje();
        }

		$this->output->set_output(json_encode($data));
	}

}

/* End of file Controllername.php */

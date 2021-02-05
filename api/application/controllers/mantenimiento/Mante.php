<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mante extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('/mantenimiento/Mante_model');
	}

	public function getSelect()
	{
		$lista = [];
		$datos = json_decode(file_get_contents('php://input'));
		$datos = $datos->params;
		foreach ($datos->funcion as $key => $value) {
			$funcion = "_get".$value;
			$lista[$value] = $this->Mante_model->$funcion();
		}
		
		$this->output->set_output(json_encode([
			'lista' => $lista
		]));
	}

}

/* End of file Mante.php */
/* Location: ./application/controllers/mantenimiento/Mante.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdenVenta extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->output->set_content_type('application/json');
        $this->usuario = $this->session->userdata('usuario');
        
    }

    public function guardar()
    {
        $data = ["exito" => 0];
        if (!empty($this->session->userdata('usuario'))) {
            $datos = json_decode(file_get_contents('php://input'));
        } else {
            $data["mensaje"] = "Sesión inválida, intente cerrar sesión e intentarlo de nuevo";
        }
    }
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdenVenta_model extends General_model {
    public $usuario_id;
    public $orden_venta_status_id;
    public $metodo_pago_id = 1;
    public $departamento_id;
    public $municipio_id;
    public $nombre;
    public $correo;
    public $direccion;
    public $telefono;
    public $nit;
    public $observaciones;

	public function __construct($id="")
	{
		parent::__construct();
		$this->usuario = $this->session->userdata('usuario');
		if (!empty($id)) {
			$this->cargar($id);
		}
	}

}
?>
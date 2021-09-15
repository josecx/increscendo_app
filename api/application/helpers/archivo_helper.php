<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('subirArchivo'))
{
	function subirArchivo($datos=[])
	{
		$data = ['exito' => 0];

		if (elemento($datos, 'tmp_name') &&
			elemento($datos, 'type') &&
			elemento($datos, 'name')) {

			$archivo = new Drive();
			if (!isset($datos['carpeta'])) {
				$datos['carpeta'] = 'varios';
			}

			$archivo->set_subcarpeta($datos['carpeta']);

			$fileId = $archivo->subirArchivo([
				'name' => $datos['name'],
				'type' => $datos['type'],
				'tmp_name' => file_get_contents($datos['tmp_name'])
			]);

		    $documento = $archivo->getArchivo($fileId);

		    $data['exito']  = 1;
			$data['key']    = $documento->getId();
			$data['nombre'] = $documento->getName(); 
			$data['tipo'] = $documento->getMimeType(); 
			$data['link']   = "https://drive.google.com/open?id={$documento->id}";
		} else {
			$data['mensaje'] = 'Hacen falta datos obligatorios.';
		}

		return (object) $data;
	}
}
?>
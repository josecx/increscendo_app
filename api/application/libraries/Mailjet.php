<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Mailjet\Resources;

class Mailjet
{
	protected $ci;
	protected $cli;

	private $MJ_APIKEY_PUBLIC    = "7dd36ec5b228303c9d8ba969b2a56e1e";
	private $MJ_APIKEY_PRIVATE   = "f945db07177cf901d143690765fef1fc";
	private $MJ_CORREO_ORIGEN	 = "josechocojxinico@gmail.com";
	private $MJ_NOMBRE_REMITENTE = "APIMAIL";



	public function __construct()
	{
        $this->ci =& get_instance();
        $this->crearCliente();
	}

	public function crearCliente()
	{
		$this->cli = new \Mailjet\Client(
			$this->MJ_APIKEY_PUBLIC, 
			$this->MJ_APIKEY_PRIVATE,
			true,
			['version' => "v3.1"]
		);
	}

	public function enviarEmail($args=[])
	{
		$from_email = elemento($args, "from_email", $this->MJ_CORREO_ORIGEN);
		$from_name  = elemento($args, "from_name",  $this->MJ_NOMBRE_REMITENTE);
		$to_email   = elemento($args, "to_email", "");
		$to_name    = elemento($args, "to_name", "");

		$body = [
		    'Messages' => [
		        [
		            'From' => [
		                'Email' => $from_email,
		                'Name'  => $from_name
		            ],
		            'To' => [
		                [
		                    'Email' => $to_email,
		                    'Name'  => $to_name
		                ]
		            ],
		            'Subject'  => elemento($args, "subject", ""),
		            'HTMLPart' => elemento($args, "html", "")
		        ]
		    ]
		];
		$response = $this->cli->post(Resources::$Email, ['body' => $body]);
		return $response->success() ? $response->getData(): false;
	}

}

/* End of file Mail.php */
/* Location: ./application/libraries/Mail.php */

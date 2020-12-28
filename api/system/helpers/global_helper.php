<?php 
if (!function_exists('elemento'))
{
	function elemento($dato, $indice, $valor=false) 
	{
		if (array_key_exists($indice, $dato) && 
			!empty($dato[$indice])) {
			
			return $dato[$indice];
		}

		return $valor;
	}
}

if (!function_exists('enviarEmail'))
{
	function enviarEmail($args=[]) 
	{
		$mj = new Mailjet();

		return $mj->enviarEmail($args);
	}
}

if (!function_exists('randomPassword')) {
	function randomPassword($size) 
	{
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $password = array(); 
	    $alpha_length = strlen($alphabet) - 1; 
	    for ($i = 0; $i < $size; $i++) 
	    {
	        $n = rand(0, $alpha_length);
	        $password[] = $alphabet[$n];
	    }
	    return implode($password); 
	}
}
?>
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

if (!function_exists('verPropiedad')) {
	function verPropiedad($objeto, $propiedad, $return=false)
	{
		if (property_exists($objeto, $propiedad) &&!empty($objeto->$propiedad)) {
			return $objeto->$propiedad;
		}

		return $return;
	}
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

if (!function_exists('getUrlRecurso')) {
	function getUrlRecurso($urlOriginal)
	{
		if (str_contains($urlOriginal, 'youtu')) {
			$url = "https://www.youtube.com/embed/";
			if (str_contains($urlOriginal, 'https://www.youtube.com/watch?v=')) { return str_replace("https://www.youtube.com/watch?v=", $url, $urlOriginal);}
			if (str_contains($urlOriginal, 'www.youtube.com/watch?v=')) {return str_replace("www.youtube.com/watch?v=", $url, $urlOriginal);}
			if (str_contains($urlOriginal, 'https://youtu.be/')) {return str_replace("https://youtu.be/", $url, $urlOriginal);}
			if (str_contains($urlOriginal, 'youtu.be/')) {return str_replace("youtu.be/", $url, $urlOriginal);}
		}

		if (str_contains($urlOriginal, 'vimeo')) {
			$url = "https://player.vimeo.com/video/";
			if (str_contains($urlOriginal, 'https://vimeo.com/')) {return str_replace("https://vimeo.com/", $url, $urlOriginal);}
			if (str_contains($urlOriginal, 'vimeo.com/')) {return str_replace("vimeo.com/", $url, $urlOriginal);}
		}

		if (str_contains($urlOriginal, 'drive')) {
			$url = "https://drive.google.com/uc?id=";
			if (str_contains($urlOriginal, 'https://drive.google.com/file/d/')) {
				$tmp = str_replace("https://drive.google.com/file/d/", $url , $urlOriginal);
				if (str_contains($tmp, "/view?usp=sharing")) {
					$tmp = str_replace("/view?usp=sharing", "", $tmp);
				}
				return $tmp;
			}
		}

		return false;
	}
}

if (!function_exists('verConsulta'))
{
	function verConsulta($datos, $args)
	{
		if ($datos->num_rows() > 0) {
			if (isset($args['uno'])) {
				return $datos->row();
			} else {
				return $datos->result();
			}
		}

		return [];
	}
}
?>
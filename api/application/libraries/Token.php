<?php 
use Firebase\JWT\JWT;

class Token{
	protected $CI;
	private $secret_key = 'increscendoApp_@';
    private $encrypt    = ['HS256'];

    public function __construct()
    {
    	$this->CI =& get_instance();
    }

    public function _setToken_($data=[])
    {
    	$token = [
    		"live" => time(),
    		"exp"  => $data["expira"],
    		"data" => $data["data"]
    	];

		return JWT::encode($token, $this->secret_key);
    }

    public function token_activo($token)
    {
        if (is_string($token) && !empty($token)) {
            try {
                $decoded = JWT::decode($token, $this->secret_key, $this->encrypt);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }   
}

?>
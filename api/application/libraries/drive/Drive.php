<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drive
{
	public $service;
	protected $carpeta    = '1Ilivr8Ut81dzvTgkO9dvSqYssZEefYaU';
    protected $subcarpeta = '1gizvrG7Eqwm6FPc9fMGV-CGiIy8twjmF';
    protected $correo     = 'backup@increscendo.com.gt';

	public function __construct()
	{
        $this->service = new Google_Service_Drive($this->getCliente());
	}

    public function set_subcarpeta($nombre)
    {
        $this->subcarpeta = $nombre;
    }

	private function getCliente()
	{
        $client = new Google_Client();
        $client->setApplicationName('IncrescendoApp');
        $client->setAuthConfig(APPPATH.'libraries/drive/increscendoapp-drive.json');
        $client->setScopes(Google_Service_Drive::DRIVE);
        $client->setAccessType('online');
        $client->setSubject($this->correo);
    
        return $client;
    }

    public function getArchivo($id, $args=[])
    {
        return $this->service->files->get($id, $args);
    }

    public function mostrarArchivo($id)
    {
        return $this->service->files->get($id, ['action' => 'open']);
    }

    public function setPermiso($args=array())
    {
        $this->service->getClient()->setUseBatch(true);

        try {
            $batch = $this->service->createBatch();

            $userPermission = new Google_Service_Drive_Permission(array(
                'type' => $args['type'],
                'role' => $args['role']
            ));
            
            $request = $this->service->permissions->create(
                $args['fileId'], 
                $userPermission, 
                array('fields' => 'id')
            );

            $batch->add($request, 'anyone');
            $batch->execute();
        } finally {
            $this->service->getClient()->setUseBatch(false);
        }
    }
	
    public function subirArchivo($args = [])
    {
        $file = new Google_Service_Drive_DriveFile([
            'name'    => $args['name'],
            'parents' => array($this->getCarpeta($this->subcarpeta))
        ]);
        
        $tmp = $this->service->files->create($file, [
            'data'       => $args['tmp_name'],
            'mimeType'   => $args['type'],
            'uploadType' => 'multipart',
            'fields'     => 'id'
        ]);

        $this->setPermiso([
            'fileId' => $tmp->id,
            'type' => 'anyone',
            'role' => 'commenter'
        ]);

        return $tmp->id;
    }

    public function setCarpeta($nombre)
    {
        $fileMetadata = new Google_Service_Drive_DriveFile([
	    	'name' => $nombre,
	    	'parents' => array($this->carpeta),
	    	'mimeType' => 'application/vnd.google-apps.folder'
		]);

		$file = $this->service->files
		->create($fileMetadata,['fields' => 'id']);

		return $file->id;
    }

    public function getCarpeta($carpeta)
    {
        $pageToken = null;
        
        do {
            $response = $this->service->files->listFiles([
                'q'         => "name='{$carpeta}'",
                'spaces'    => 'drive',
                'pageToken' => $pageToken,
                'fields'    => 'nextPageToken, files(id, name)',
            ]);

            foreach ($response->files as $file) {
                if ($file->name == $carpeta) {
                    return $file->id;
                }
            }
           
            $pageToken = $response->pageToken;
        } while ($pageToken != null);

        return $this->setCarpeta($carpeta);
    }
}

/* End of file Drive.php */
/* Location: ./application/libraries/Drive.php */

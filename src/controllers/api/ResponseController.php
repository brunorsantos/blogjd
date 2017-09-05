<?php 



namespace Src\Controllers\Api;


class ResponseController 
{
    protected $statusCode = 200;

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
 

    public function getStatusCode()
    {
        return $this->statusCode;
    }

   

    public function respond($data = null,$message=null)
    {

    	$response = [];
    	$response['status'] = $this->getStatusCode();
    	$response['data'] = $data;
    	$response['message'] = $message;

        return print(json_encode($response));
    }

    public function respondWithError($message = "")
    {
        return $this->respond(null,$message);
    }


    public function respondNotFound($message = "")
    {
        return $this->setStatusCode(404)
                    ->respondWithError($message);
    }




}





<?php

namespace App\Trait;

/**
 * Trait Response
 * @package App\Trait\Response
 */
trait Response
{
    /**
     * @param $data
     * @param string $message
     * @return json
     */
    public function responseSuccess($data = [])
    {
        $response['body'] = json_encode($data,JSON_FORCE_OBJECT);
        header('HTTP/1.1 200 OK');
        http_response_code(200);
        echo $response['body'];
        exit();
    }

    /**
     * @param string $message
     * @return json
     */
    public function responseValidationError($message = null)
    {
        $this->responseError('Validation Error', 400);
    }

    public function responseMethodNotAllowed()
    {
        $this->responseError('Method Not Allowed', 405);
    }

    /**
     * @param string $message
     * @return json
     */
    public function responseError($message = null, $statusCode = 500)
    {
        $message = $message ?? 'Something went wrong';
        $response['body'] = json_encode(
            [
                'status' => false,
                'message' => $message,
            ]
            , JSON_FORCE_OBJECT);
        http_response_code($statusCode);
        echo $response['body'];
        exit();
    }


}
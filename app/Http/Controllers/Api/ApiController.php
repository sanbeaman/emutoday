<?php

namespace emutoday\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;


class ApiController extends BaseController
{
    /**
     * [$statusCode description]
     * @var integer
     */
    protected $statusCode = 200;


    /**
     * [getStatusCode description]
     * @return [type] [description]
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * [setStatusCode description]
     * @param [type] $statusCode [description]
     * @return $this [For chaining]
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * [respondNotFound description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);

    }

    /**
     * [respondInternalError description]
     * @param  string $message [description]
     * @return [type]          [description]
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(500)->respondWithError($message);

    }
    /**
     * [respond description]
     * @param  [type] $data    [description]
     * @param  [type] $headers [description]
     * @return [type]          [description]
     */
    public function respond($data, $headers = [])
    {
        return response()->json( $data, $this->getStatusCode(), $headers);
    }

    /**
     * [respondWithError description]
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    public function respondWithError($message)
    {

        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
}

<?php

/**
 * @OA\Info(title="Mars Rover API", description="<div>Powered By <a href=https://hakanakhan.com> HAKAN AKHAN</a></div>", version="1.0.0")
 *
 */
namespace App\Controllers;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LoggerInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends ResourceController
{
    use ResponseTrait;
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest|CLIRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.: $this->session = \Config\Services::session();

        $migrate = Services::migrations();

        $migrate->latest();

    }

    /**
     * @param Int $code
     * @param String $message
     * @return mixed
     */
    public function responseSuccess($message = '', int $code = 200)
    {
        $data = [
            'status' => $code,
            'error' => null,
            'messages' => [
                'success' => $message,
            ]
        ];

        return $this->respond($data, $code);

    }
    /**
     * @param Int $code
     * @param String $message
     * @return mixed
     */
    public function responseError($message = '', int $code = 501)
    {
        $data = [
            'status' => $code,
            'error' => $code,
            'messages' => [
                'error' => $message,
            ]
        ];

        return $this->respond($data, $code);

    }

}

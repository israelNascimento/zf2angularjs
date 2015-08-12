<?php
/**
 * Created by PhpStorm.
 * User: israel
 * Date: 06/08/15
 * Time: 14:13
 */

namespace SONRest\Service;


use JMS\Serializer;
use Zend\Http\Response;

class ProcessJson
{
    protected $data;
    protected $response;
    protected $serializer;

    function __construct($data=null, Response $response=null, $serializer)
    {
        $this->data = $data;
        $this->response = $response;
        $this->serializer = $serializer;
    }

    public function process()
    {
        $jsonContent=$this->serializer->serialize($this->data, 'json');
        $this->response->setContent($jsonContent);
        $headers=$this->response->getHeaders();
        $headers->addHeaderLine('Content-type','application/json');
        $this->response->setHeaders($headers);
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }





}
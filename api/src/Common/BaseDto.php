<?php


namespace App\Common;

use Symfony\Component\HttpFoundation\Request;
use Exception;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class BaseDto
{

    private array $data = [];

    public function __construct(RequestStack|array $request)
    {

        switch (true) {
            case $request instanceof RequestStack:

                $request = $request->getMainRequest();
                $files = $request->files->all();
                $requests = $request->request->all();
                $jsonContent = json_decode($request->getContent(), true);
                $content = gettype($jsonContent) === 'array' ? $jsonContent : [];


                $result = array_merge($files, $requests, $content);
                break;
            case gettype($request) === 'array':

                $result = $request;

                break;
            default:
                throw new Exception('Request is not type of Request of array');
        }

        $this->data = $result;
    }


    public function getValue($key): mixed
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : null;
    }

}

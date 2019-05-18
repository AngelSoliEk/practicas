<?php

namespace App\Core\Controller;

use App\Core\Helper\General;

abstract class Controller
{
    private $class;
    /*
    * create instance of model with same controller name
    */
    public function __construct()
    {
        $this->Helper = new Helper();

        $this->class = self::setClass();
        self::loadModels();
        self::loadHelpers();
    }

    protected $statusCode = [
        200 => 'Ok',
        201 => 'Create',
        202 => 'Accept',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        409 => 'Conflict',
    ];

    private function setClass()
    {
        $className = (new \ReflectionClass($this))->getShortName();

        return str_replace('Controller', '', $className);
    }

    protected function getResponseCode(int $code,string $message=NULL){
        http_response_code($code);
        return $response = ['error' => true, 'message' => is_null($message)?$statusCode($code):$message];
    }

    protected function validateMethod($method='GET'){
        $methodRequest = $_SERVER['REQUEST_METHOD'];
        if($method!=$methodRequest){
            return $this->getResponseCode(405);
        }
        return true;
    }


    /*
    * create instances of models with different names when set $this->use = []
    */
    private function loadModels()
    {
        $this->use = ( ! isset($this->use)) ? [$this->class] : $this->use;

        if ($this->use) {
            foreach ($this->use as $model) {
                self::load('model', $model);
            }
        }
    }

    private function loadHelpers()
    {
        if (isset($this->helpers)) {
            foreach ($this->helpers as $helper) {
                self::load('helper', $helper);
            }
        }
    }

    private function load($path, $class)
    {
        $load_class = 'SimpleORM\app\\' . $path . '\\' . $class;
        $this->{$class} = new $load_class();
    }
}

<?php
namespace com\confdb\controller;

use Exception;

abstract class AController{
    protected $params;

    public function __construct($params){
        $this->params = $params;
    }

    protected abstract function resolveActions(&$response, $action);

    protected function getMandatoryParam($index){
        if(isset($this->params[$index]) && $this->params[$index] != ''){
            return $this->params[$index];
        }
        else{
            throw new Exception("Paramètre manquant : $index !");
        }
    }

    protected function getParam($index){
        if(isset($this->params[$index])){
            $value = $this->params[$index];
        }
        else{
            $value = null;
        }
        return $value;
    }

    public function run(&$response){
        $this->resolveActions($response, $this->getMandatoryParam('action'));
        
    }
}
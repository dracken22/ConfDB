<?php
namespace com\confdb\base\tool;

use com\confdb\base\bean\ABean;
use Exception;

abstract class AFactory{
    protected static $instance = array();

    protected function __construct() {}

    final public static function getInstance(){
        static $instances;
        $class = get_called_class();
        if (!isset($instances[$class]))
        {
            $instances[$class] = new $class();
        }
        return $instances[$class];
    }

    abstract protected function dbToBean($results, $singleResult);

    public function resultsToBeans($results, $singleResult = false){
        $result = $this->dbToBean($results, $singleResult);
        if($singleResult){
            switch(sizeof($result)){
                case 0 :
                    throw new Exception('One object expected, none gotten !');
                    break;
                case 1 :
                    $result = $result[0];
                    break;
                default :
                    throw new Exception('One object expected, multiple gotten !');
                    break;
            }
        }
        return $result;
    }

    public abstract function beanToJson($bean);
    public function beansToJson($beans){
        $json = [];
        foreach($beans as $bean){
            $json[] = $this->beanToJson($bean);
        }
        return $json;
    }
}
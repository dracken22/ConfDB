<?php
namespace com\confdb\base\dao;

use com\confdb\base\tool\SqlTool;
use Exception;

abstract class ADao{
    protected static $instance = array();

    protected function __construct() {}

    abstract protected function getFactory();

    final public static function getInstance(){
        static $instances;
        $class = get_called_class();
        if (!isset($instances[$class]))
        {
            $instances[$class] = new $class();
        }
        return $instances[$class];
    }

    protected function _get($query, $params = null){
        $results = SqlTool::read($query, $params);
        return $this->getFactory()->resultsToBeans($results, false);
    }

    protected function _getById($query, $params){
        $results = SqlTool::read($query, $params);
        return $this->getFactory()->resultsToBeans($results, true);
    }
}


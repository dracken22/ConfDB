<?php
namespace com\confdb\base\business;

abstract class ABusiness{
    protected static $instance = array();

    protected function __construct() {}

    /**
     * getInstance
     *
     * @return $class an instance of the calling class
     */
    final public static function getInstance(){
        static $instances;
        $class = get_called_class();
        if (!isset($instances[$class]))
        {
            $instances[$class] = new $class();
        }
        return $instances[$class];
    }

    protected abstract function getDao();

    public function list(){
        $results = [];
        foreach($this->getDao()->list() as $item){
            $results[] = $item->toJson();
        }
        return $results;
    }
}

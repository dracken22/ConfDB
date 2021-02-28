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

    private function _dbRead($singleResult, $query, $params = null, $factory = null){
        $results = SqlTool::read($query, $params);
        if($factory == null){
            $factory = $this->getFactory();
        }
        return $factory->resultsToBeans($results, $singleResult);
    }

    protected function _get($query, $params = null, $factory = null){
        return $this->_dbRead(false, $query, $params, $factory);
    }

    protected function _getById($query, $params, $factory = null){
        return $this->_dbRead(true, $query, $params, $factory);
    }

    protected function insertLabel($connectionNumber, $labels){
        $label_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$label_id, $language_id, $text], $connectionNumber);
        }
        return $label_id;
    }

    protected function updateLabel($connectionNumber, $label_id, $labels){
        foreach($labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)
                                ON DUPLICATE KEY text = ?', [$label_id, $language_id, $text, $text], $connectionNumber);
        }
    }
}


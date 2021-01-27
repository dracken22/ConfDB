<?php
namespace com\confdb\base\dao;

use com\confdb\base\tool\SqlTool;
use Exception;

abstract class ADao{
    protected static function getById($query, $params){
        $results = SqlTool::read($query, $params);
        switch(sizeof($results)){
            case 0;
                throw new Exception("No result given for id : ".$params[0]." in query <$query>");
                break;
            case 1;
                break;
            default:
                throw new Exception("Two results given for id : ".$params[0]." in query <$query>");
                break;
        }
        return $results[0];
    }
}


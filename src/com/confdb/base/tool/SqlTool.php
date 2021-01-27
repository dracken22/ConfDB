<?php
namespace com\confdb\base\tool;

use Exception;

class SqlTool{
    const OPERATION_EXECUTE = 0;
    const OPERATION_READ = 1;
    const OPERATION_INSERT = 2;

    private static $openConnections = [];
    
    public static function startTransaction(){
        $connection = new SqlConnection();
        self::$openConnections[] = $connection;
        return array_search($connection, self::$openConnections, true);
    }

    public static function endTransaction($connectionNumber){
        var_dump(self::$openConnections);
        self::$openConnections[$connectionNumber]->commit();
        unset(self::$openConnections[$connectionNumber]);
        var_dump(self::$openConnections);
    }

    public static function execute($query, $params = null, $connectionNumber = null){
        self::doOperation(self::OPERATION_EXECUTE, $query, $params, $connectionNumber);
    }
    
    public static function read($query, $params = null, $connectionNumber = null){
        return self::doOperation(self::OPERATION_READ, $query, $params, $connectionNumber);
    }

    public static function insert($query, $params = null, $connectionNumber = null){
        return self::doOperation(self::OPERATION_INSERT, $query, $params, $connectionNumber);
    }

    private static function doOperation($operation, $query, $params = null, $connectionNumber = null){
        $result = null;
        try{
            if(isset($connectionNumber)){
                $connexion = self::$openConnections[$connectionNumber];
            }
            else{
                $connexion = new SqlConnection();
            }
            $connexion->execute($query, $params);
            switch($operation){
                case self::OPERATION_INSERT:
                    $result = $connexion->lastInsertId();
                    break;
                case self::OPERATION_READ:
                    $result = $connexion->fetch();
                    break;
            }
            if(!isset($connectionNumber)){
                $connexion->commit();
            }
        }
        catch(Exception $e){
            $connexion->rollback();
            if(isset($connectionNumber)){
                unset(self::$openConnections[$connectionNumber]);
            }
            throw $e;
        }
        return $result;
    }
}
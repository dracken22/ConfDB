<?php
namespace com\confdb\base\tool;

use Exception;
use PDO;

class SqlConnection{
    private $dbh;
    private $stmt;
    
    public function __construct() {
        $this->dbh = new PDO('mysql:host=localhost;dbname=confdb', 'root', '', [
                PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        $this->dbh->beginTransaction();
    }

    public function execute($query, $params = null){
        $this->stmt = $this->dbh->prepare($query);
        $bindingIndex = 1;
        if(isset($params)){
            foreach($params as $param){
                $this->bind($bindingIndex, $param);
                $bindingIndex++;
            }
        }
        $this->stmt->execute();
    }

    public function bind($index, $value, $type = null) {
        if(is_null($type)){
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($index, $value, $type);
    }

    public function fetch(){
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function rollback(){
        $this->dbh->rollBack();
    }

    public function commit(){
        $this->dbh->commit();
    }
}
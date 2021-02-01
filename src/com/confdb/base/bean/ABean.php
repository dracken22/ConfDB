<?php
namespace com\confdb\base\bean;


abstract class ABean{
    private $id;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public abstract function toJson();
}
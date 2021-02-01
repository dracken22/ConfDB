<?php
namespace com\confdb\label\bean;

use com\confdb\base\bean\ABean;

class Language extends ABean{
    private $code;
    private $name;
    private $icon;

    public function setCode($code){
        $this->code = $code;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setIcon($icon){
        $this->icon = $icon;
    }
    public function getCode(){
        return $this->code;
    }
    public function getName(){
        return $this->name;
    }
    public function getIcon(){
        return $this->icon;
    }

    public function toJson(){
        return [
            'id' => $this->getId(),
            'code' => $this->getCode(),
            'name' => $this->getName(),
            'icon' => $this->getIcon()
        ];
    }
}
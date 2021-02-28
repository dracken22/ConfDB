<?php
namespace com\confdb\game\cards\bean;

use com\confdb\game\basics\bean\Ability;

class FighterAbility extends Ability{
    private $value;
    
    public function getValue(){
        return $this->value;
    }
    public function setValue($value){
        $this->value = $value;
    }

    public function toJson(){
        $json = parent::toJson();
        $json ['value'] = $this->getValue();
        return $json;
    }
}
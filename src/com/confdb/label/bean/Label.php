<?php
namespace com\confdb\label\bean;

use com\confdb\base\bean\ABean;

class Label extends ABean{
    private $labels = [];
    
    public function addLabel($language_id, $label){
        $this->labels[$language_id] = $label;
    }
    public function getLabel($language_id){
        return $this->labels[$language_id];
    }
    public function getLabels(){
        return $this->labels;
    }
}
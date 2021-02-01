<?php
namespace com\confdb\label\bean;

use com\confdb\base\bean\ABean;

class Label extends ABean{
    private $labels = [];
    
    public function addLabel($language_id, $label){
        $this->labels[$language_id] = $label;
    }
    public function getLabel($language_id){
        $label = null;
        if(isset($this->labels[$language_id])){
            $label = $this->labels[$language_id];
        }
        return $label;
    }
    public function getLabels(){
        return $this->labels;
    }

    public function toJson(){
        $labels = [];
        foreach($this->getLabels() as $language_id => $label){
            $labels[$language_id] = [
                'label' => $label
            ];
        }
        return [
            'id' => $this->getId(),
            'labels' => $labels
        ];
    }
}
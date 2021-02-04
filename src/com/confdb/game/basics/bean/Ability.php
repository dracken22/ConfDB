<?php
namespace com\confdb\game\basics\bean;

use com\confdb\label\bean\Label;

class Ability extends Label{
    private $descriptions = [];
    
    public function addDescription($language_id, $description){
        $this->descriptions[$language_id] = $description;
    }
    public function getDescription($language_id){
        $label = null;
        if(isset($this->descriptions[$language_id])){
            $label = $this->descriptions[$language_id];
        }
        return $label;
    }
    public function getDescriptions(){
        return $this->descriptions;
    }

    public function toJson(){
        $labels = [];
        $descriptions = [];
        foreach($this->getLabels() as $language_id => $label){
            $labels[$language_id] = [
                'label' => $label
            ];
        }
        foreach($this->getDescriptions() as $language_id => $label){
            $descriptions[$language_id] = [
                'label' => $label
            ];
        }
        return [
            'id' => $this->getId(),
            'names' => $labels,
            'descriptions' => $descriptions
        ];
    }
}
<?php
namespace com\confdb\game\basics\bean;

use com\confdb\label\bean\Label;

class Pedestal extends Label{
    private $dimensions;

    public function getDimensions(){
        return $this->dimensions;
    }
    public function setDimensions($dimensions){
        $this->dimensions = $dimensions;
    }

    public function toJson(){
        $labels = [];
        foreach($this->getLabels() as $language_id => $label){
            $labels[$language_id] = [
                'label' => $label,
            ];
        }
        return [
            'id' => $this->getId(),
            'labels' => $labels,
            'dimensions' => $this->getDimensions()
        ];
    }
}
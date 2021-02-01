<?php
namespace com\confdb\game\basics\bean;

use com\confdb\label\bean\Label;

class Size extends Label{
    private $potency;

    public function getPotency(){
        return $this->potency;
    }
    public function setPotency($potency){
        $this->potency = $potency;
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
            'potency' => $this->getPotency()
        ];
    }
}
<?php
namespace com\confdb\game\basics\bean;

use com\confdb\label\bean\Label;

class Skill extends Label{
    public function getShortLabel($language_id){
        return strtoupper(substr($this->getLabel($language_id), 0, 3));
    }

    public function toJson(){
        $labels = [];
        foreach($this->getLabels() as $language_id => $label){
            $labels[$language_id] = [
                'label' => $label,
                'short_label' => $this->getShortLabel($language_id)
            ];
        }
        return [
            'id' => $this->getId(),
            'labels' => $labels
        ];
    }
}
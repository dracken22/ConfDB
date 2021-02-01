<?php
namespace com\confdb\game\basics\bean;

use com\confdb\label\bean\Label;

class Rank extends Label{
    private $level;

    public function getLevel(){
        return $this->level;
    }
    public function setLevel($level){
        $this->level = $level;
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
            'level' => $this->getLevel()
        ];
    }
}
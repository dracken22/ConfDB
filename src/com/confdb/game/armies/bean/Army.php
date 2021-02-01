<?php
namespace com\confdb\game\armies\bean;

use com\confdb\label\bean\Label;

class Army extends Label{
    private $icon;
    private $alliance;

    public function getIcon(){
        return $this->icon;
    }
    public function setIcon($icon){
        $this->icon = $icon;
    }
    public function getAlliance(){
        return $this->alliance;
    }
    public function setAlliance($alliance){
        $this->alliance = $alliance;
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
            'icon' => $this->getIcon(),
            'alliance' => $this->getAlliance() != null ? $this->getAlliance()->toJson() : null
        ];
    }
}
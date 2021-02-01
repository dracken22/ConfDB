<?php
namespace com\confdb\game\basics\bean;

use com\confdb\base\bean\ABean;

class Fighter extends ABean{
    private $name;
    private $points;
    private $rank;
    private $skills = [];
    private $abilities = [];

    public function setName($name){
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
    public function setPoints($points){
        $this->points = $points;
    }
    public function getPoints(){
        return $this->points;
    }
    public function setRank($rank){
        $this->rank = $rank;
    }
    public function getRank(){
        return $this->rank;
    }

    public function toJson(){
        /*
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
        */
    }
}
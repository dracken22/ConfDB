<?php
namespace com\confdb\game\cards\bean;

use com\confdb\game\armies\bean\Army;
use com\confdb\game\basics\bean\Pedestal;
use com\confdb\game\basics\bean\Point;
use com\confdb\game\basics\bean\Rank;
use com\confdb\game\basics\bean\Size;
use com\confdb\label\bean\Label;

class Fighter extends Card{
    private Army $army;
    private Point $point;
    private Rank $rank;
    private Size $size;
    private Pedestal $pedestal;
    private Label $gender;
    private $skills = [];
    private $abilities = [];
    

    public function getArmy(){
        return $this->army;
    }
    public function setArmy($army){
        $this->army = $army;
    }
    public function getPoint(){
        return $this->point;
    }
    public function setPoint($point){
        $this->point = $point;
    }
    public function getRank(){
        return $this->rank;
    }
    public function setRank($rank){
        $this->rank = $rank;
    }
    public function getSize(){
        return $this->size;
    }
    public function setSize($size){
        $this->size = $size;
    }
    public function getPedestal(){
        return $this->pedestal;
    }
    public function setPedestal($pedestal){
        $this->pedestal = $pedestal;
    }
    public function getGender(){
        return $this->gender;
    }
    public function setGender($gender){
        $this->gender = $gender;
    }
    public function getSkills(){
        return $this->skills;
    }
    public function setSkills($skills){
        $this->skills = $skills;
    }
    public function addSkill($skill){
        $this->skills[] = $skill;
    }

    public function toJson(){
        $json = parent::toJson();
        $json['army'] = $this->getArmy() == null ? $this->getArmy()->toJson() : null;
        $json['point'] = $this->getPoint() == null ? $this->getPoint()->toJson() : null;
        $json['rank'] = $this->getRank() == null ? $this->getRank()->toJson() : null;
        $json['size'] = $this->getSize() == null ? $this->getSize()->toJson() : null;
        $json['pedestal'] = $this->getPedestal() == null ? $this->getPedestal()->toJson() : null;
        $json['gender'] = $this->getGender() == null ? $this->getGender()->toJson() : null;
        return $json;
    }
}
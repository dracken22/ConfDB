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
    private $rangedWeapons = [];
    private $classes = [];

    /**
     * getArmy
     *
     * @return Army
     */
    public function getArmy(){
        return $this->army;
    }    
    /**
     * setArmy
     *
     * @param  Army $army
     */
    public function setArmy($army){
        $this->army = $army;
    }    
    /**
     * getPoint
     *
     * @return Point
     */
    public function getPoint(){
        return $this->point;
    }    
    /**
     * setPoint
     *
     * @param  Point $point
     */
    public function setPoint($point){
        $this->point = $point;
    }    
    /**
     * getRank
     *
     * @return Rank
     */
    public function getRank(){
        return $this->rank;
    }    
    /**
     * setRank
     *
     * @param  Rank $rank
     */
    public function setRank($rank){
        $this->rank = $rank;
    }    
    /**
     * getSize
     *
     * @return Size
     */
    public function getSize(){
        return $this->size;
    }    
    /**
     * setSize
     *
     * @param  Size $size
     */
    public function setSize($size){
        $this->size = $size;
    }    
    /**
     * getPedestal
     *
     * @return Pedestal
     */
    public function getPedestal(){
        return $this->pedestal;
    }    
    /**
     * setPedestal
     *
     * @param  Pedestal $pedestal
     */
    public function setPedestal($pedestal){
        $this->pedestal = $pedestal;
    }
    /**
     * getGender
     *
     * @return Gender
     */
    public function getGender(){
        return $this->gender;
    }    
    /**
     * setGender
     *
     * @param  Gender $gender
     */
    public function setGender($gender){
        $this->gender = $gender;
    }    
    /**
     * getSkills
     *
     * @return array[FighterSkill]
     */
    public function getSkills(){
        return $this->skills;
    }    
    /**
     * addSkill
     *
     * @param  FighterSkill $skill
     */
    public function addSkill($skill){
        $this->skills[] = $skill;
    }
    /**
     * getAbilities
     *
     * @return array[FighterAbility]
     */
    public function getAbilities(){
        return $this->abilities;
    }
    /**
     * addAbility
     *
     * @param  FighterAbility $ability
     */
    public function addAbility($ability){
        $this->abilities[] = $ability;
    }    
    /**
     * getClasses
     *
     * @return array[Label]
     */
    public function getClasses(){
        return $this->classes;
    }      
    /**
     * getRangedWeapons
     *
     * @return array[RangedWeapon]
     */
    public function getRangedWeapons(){
        return $this->rangedWeapons;
    }    
    /**
     * addRangedWeapon
     *
     * @param  RangedWeapon $ranged_weapon
     */
    public function addRangedWeapon($ranged_weapon){
        $this->rangedWeapons[] = $ranged_weapon;
    }
    /**
     * addClass
     *
     * @param  Label $class
     */
    public function addClass($class){
        $this->classes[] = $class;
    }  
    

    public function toJson(){
        $json = parent::toJson();
        $json['army'] = $this->getArmy() == null ? $this->getArmy()->toJson() : null;
        $json['point'] = $this->getPoint() == null ? $this->getPoint()->toJson() : null;
        $json['rank'] = $this->getRank() == null ? $this->getRank()->toJson() : null;
        $json['size'] = $this->getSize() == null ? $this->getSize()->toJson() : null;
        $json['pedestal'] = $this->getPedestal() == null ? $this->getPedestal()->toJson() : null;
        $json['gender'] = $this->getGender() == null ? $this->getGender()->toJson() : null;
        $json['skills'] = [];
        foreach($this->getSkills() as $skill){
            $json['skills'][] = $skill->toJson();
        }
        $json['abilities'] = [];
        foreach($this->getAbilities() as $ability){
            $json['abilities'][] = $ability->toJson();
        }
        $json['ranged_weapons'] = [];
        foreach($this->getRangedWeapons() as $ranged_weapon){
            $json['ranged_weapons'][] = $ranged_weapon->toJson();
        }
        $json['classes'] = [];
        foreach($this->getClasses() as $class){
            $json['classes'][] = $class->toJson();
        }
        return $json;
    }
}
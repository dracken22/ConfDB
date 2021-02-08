<?php
namespace com\confdb\game\options\bean;

use com\confdb\base\bean\ABean;
use com\confdb\game\cards\bean\FighterAbility;
use com\confdb\game\cards\bean\FighterSkill;
use com\confdb\label\bean\Label;

class Option extends ABean{    
    private $name;
    private $point;
    private $skills = [];
    private $abilities = [];
    private $rangedWeapons = [];
        
    /**
     * getName
     *
     * @return Label
     */
    public function getName(){
        return $this->name;
    }    
    /**
     * setName
     *
     * @param  Label $name
     */
    public function setName($name){
        $this->name = $name;
    }
    public function addName($language_id, $name){
        $this->getName()->addLabel($language_id, $name);
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
    
    
    public function toJson(){
        $json = [
            'id' => $this->getId(),
            'name' => $this->getName() != null ? $this->getName()->toJson() : null,
            'point' => $this->getPoint() != null ? $this->getPoint()->toJson() : null,
            
        ];
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
        return $json;
    }
}
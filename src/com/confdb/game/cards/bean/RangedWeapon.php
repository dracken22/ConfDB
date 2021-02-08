<?php
namespace com\confdb\game\cards\bean;

use com\confdb\base\bean\ABean;

class RangedWeapon extends ABean{
    private $name;
    private $accuracy;
    private $strength;
    private $short_range;
    private $medium_range;
    private $long_range;
    private $piercing;
    private $splash;
    private $heavy;
    
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
    /**
     * addName
     *
     * @param  int $language_id
     * @param  string $name
     */
    public function addName($language_id, $name){
        $this->getName()->addLabel($language_id, $name);
    }
    /**
     * getAccuracy
     *
     * @return int
     */
    public function getAccuracy(){
        return $this->accuracy;
    }    
    /**
     * setAccuracy
     *
     * @param  int $accuracy
     */
    public function setAccuracy($accuracy){
        $this->accuracy = $accuracy;
    }    
    /**
     * getStrengh
     *
     * @return int
     */
    public function getStrengh(){
        return $this->strength;
    }    
    /**
     * setStrength
     *
     * @param  int $strength
     */
    public function setStrength($strength){
        $this->strength = $strength;
    }    
    /**
     * getShortRange
     *
     * @return int
     */
    public function getShortRange(){
        return $this->short_range;
    }    
    /**
     * setShortRange
     *
     * @param  int $short_range
     */
    public function setShortRange($short_range){
        $this->short_range = $short_range;
    }    
    /**
     * getMediumRange
     *
     * @return int
     */
    public function getMediumRange(){
        return $this->medium_range;
    }    
    /**
     * setMediumRange
     *
     * @param  int $medium_range
     */
    public function setMediumRange($medium_range){
        $this->medium_range = $medium_range;
    }    
    /**
     * getLongRange
     *
     * @return int
     */
    public function getLongRange(){
        return $this->long_range;
    }    
    /**
     * setLongRange
     *
     * @param  int $long_range
     */
    public function setLongRange($long_range){
        $this->long_range = $long_range;
    }    
    /**
     * isPiercing
     *
     * @return boolean
     */
    public function isPiercing(){
        return $this->piercing;
    }    
    /**
     * setPiercing
     *
     * @param  boolean $piercing
     */
    public function setPiercing($piercing){
        $this->piercing = $piercing;
    }    
    /**
     * isSplash
     *
     * @return boolean
     */
    public function isSplash(){
        return $this->splash;
    }    
    /**
     * setSplash
     *
     * @param  boolean $splash
     */
    public function setSplash($splash){
        $this->splash = $splash;
    }    
    /**
     * isHeavy
     *
     * @return boolean
     */
    public function isHeavy(){
        return $this->heavy;
    }    
    /**
     * setHeavy
     *
     * @param  boolean $heavy
     */
    public function setHeavy($heavy){
        $this->heavy = $heavy;
    }

    public function toJson(){
        return [
            'id' => $this->getId(),
            'name' => $this->getName() != null ? $this->getName()->toJson() : null,
            'accuracy' => $this->getAccuracy(),
            'strength' => $this->getStrengh(),
            'short_range' => $this->getShortRange(),
            'medium_range' => $this->getMediumRange(),
            'long_range' => $this->getLongRange(),
            'is_piercing' => $this->isPiercing(),
            'is_splash' => $this->isSplash(),
            'is_heavy' => $this->isHeavy()
        ];
    }
}

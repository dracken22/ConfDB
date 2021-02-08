<?php
namespace com\confdb\game\basics\bean;

use com\confdb\base\bean\ABean;
use com\confdb\label\bean\Label;

class Ability extends ABean{
    private $name;
    private $description;
    private $has_value;
    
    /**
     * addName
     *
     * @param  mixed $language_id
     * @param  mixed $name
     */
    public function addName($language_id, $name){
        $this->getName()->addLabel($language_id, $name);
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
     * getName
     *
     * @return Label
     */
    public function getName(){
        return $this->name;
    }

    /**
     * addDescription
     *
     * @param  mixed $language_id
     * @param  mixed $description
     */
    public function addDescription($language_id, $description){
        $this->getDescription()->addLabel($language_id, $description);
    }    
    /**
     * setDescription
     *
     * @param  Label $description
     */
    public function setDescription($description){
        $this->description = $description;
    }    
    /**
     * getDescription
     *
     * @return Label
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * Get the value of has_value
     * 
     * @return boolean
     */ 
    public function getHasValue(){
        return $this->has_value;
    }

    /**
     * Set the value of has_value
     */ 
    public function setHasValue($has_value){
        $this->has_value = $has_value;
    }

    public function toJson(){
        return [
            'id' => $this->getId(),
            'name' => $this->getName() != null ? $this->getName()->toJson() : null,
            'description' => $this->getDescription() != null ? $this->getDescription()->toJson() : null,
            'has_value' => $this->getHasValue()
        ];
    }
}
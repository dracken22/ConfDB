<?php
namespace com\confdb\game\options\bean;

use com\confdb\base\bean\ABean;
use com\confdb\game\cards\bean\Fighter;

class OptionGroup extends ABean{    
    /**
     * base_profile
     *
     * @var Fighter
     */
    private $base_profile;    
    /**
     * is_mandatory
     *
     * @var bool
     */
    private $is_mandatory;    
    /**
     * options
     *
     * @var array[Option]
     */
    private $options = [];

    /**
     * Get base_profile
     *
     * @return  Fighter
     */ 
    public function getBaseProfile() {
        return $this->base_profile;
    }
    /**
     * Set base_profile
     *
     * @param  Fighter  $base_profile  the optionless profile
     */ 
    public function setBaseProfile(Fighter $base_profile) {
        $this->base_profile = $base_profile;
    }
    /**
     * Get is_mandatory
     *
     * @return  bool
     */ 
    public function isMandatory() {
        return $this->is_mandatory;
    }
    /**
     * Set is_mandatory
     *
     * @param  bool  $is_mandatory  is_mandatory
     */ 
    public function setMandatory(bool $is_mandatory) {
        $this->is_mandatory = $is_mandatory;
    }    
    /**
     * getOptions
     *
     * @return array[Option] the options in the options group
     */
    public function getOptions(){
        return $this->options;
    }    
    /**
     * addOption
     *
     * @param  Option $option
     */
    public function addOption(Option $option){
        $this->options[] = $option;
    }
    
    
    public function toJson(){
        $json = [
            'id' => $this->getId(),
            'options' => [],
            'is_mandatory' => $this->isMandatory()
        ];
        foreach($this->getOptions() as $option){
            $json['options'][] = $option->toJson();
        }
        return $json;
    }
}
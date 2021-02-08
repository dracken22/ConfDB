<?php
namespace com\confdb\game\cards\bean;

use com\confdb\base\bean\ABean;

class Champion extends ABean{    
    /**
     * name
     *
     * @var Label
     */
    private $name;
    
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

    public function toJson(){
        return [
            'id' => $this->getId(),
            'name' => $this->getName() != null ? $this->getName()->toJson() : null
        ];
    }
}

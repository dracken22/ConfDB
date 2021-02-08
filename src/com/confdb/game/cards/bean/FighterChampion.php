<?php
namespace com\confdb\game\cards\bean;


class FighterChampion extends Fighter{    
    /**
     * incarnation
     * @var int
     */
    private $incarnation;    
    /**
     * champion
     *
     * @var Champion
     */
    private $champion;

    /**
     * Get the incarnation number
     *
     * @return  int
     */ 
    public function getIncarnation() {
        return $this->incarnation;
    }

    /**
     * Set incarnation
     *
     * @param  int  $incarnation  numéro d'incarnation
     */ 
    public function setIncarnation(int $incarnation) {
        $this->incarnation = $incarnation;
    }
    

    /**
     * Get champion
     *
     * @return  Champion
     */ 
    public function getChampion() {
        return $this->champion;
    }

    /**
     * Set champion
     *
     * @param  Champion  $champion  champion
     *
     * @return  self
     */ 
    public function setChampion(Champion $champion) {
        $this->champion = $champion;
    }

    public function toJson(){
        $json = parent::toJson();
        $json['champion'] = $this->getChampion() != null ? $this->getChampion()->toJson() : null;
        $json['incarnation'] = $this->getIncarnation();
        return $json;
    }
}
<?php
namespace com\confdb\game\cards\bean;


class FighterTroop extends Fighter{    
    /**
     * max_quantity
     * @var int
     */
    private $max_quantity;    
    
    /**
     * Get the maximum quantity for a troop
     *
     * @return  int
     */ 
    public function getMaxQuantity() {
        return $this->max_quantity;
    }

    /**
     * Set max quantity
     *
     * @param  int  $max_quantity  la quantité maximale d'une troupe
     */ 
    public function setMaxQuantity(int $max_quantity) {
        $this->max_quantity = $max_quantity;
    }

    public function toJson(){
        $json = parent::toJson();
        $json['max_quantity'] = $this->getMaxQuantity();
        return $json;
    }
}
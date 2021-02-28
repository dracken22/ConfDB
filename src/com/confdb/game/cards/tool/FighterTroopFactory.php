<?php
namespace com\confdb\game\cards\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\cards\bean\FighterTroop;

class FighterTroopFactory extends AFactory{
    public function dbToBean($results){
        $troops = [];
        foreach($results as $result){
            if(isset($troops[$result['_card_fighter']])){
                $troop = $troops[$result['_card_fighter']];
            }
            else{
                $troops[$result['_card_fighter']] = $troop = new FighterTroop();
                $troop->setId($result['_card_fighter']);
            }
            $troop->setMaxQuantity($result['quantity_max']);
        }
        return $troops;
    }
}
<?php
namespace com\confdb\game\cards\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\cards\bean\Champion;
use com\confdb\game\cards\bean\FighterChampion;

class FighterChampionFactory extends AFactory{
    public function dbToBean($results){
        $champions = [];
        foreach($results as $result){
            if(isset($champions[$result['_card_fighter']])){
                $champion = $champions[$result['_card_fighter']];
            }
            else{
                $champions[$result['_card_fighter']] = $champion = new FighterChampion();
                $champion->setId($result['_card_fighter']);
                $champion->setChampion(new Champion());
                $champion->getChampion()->setId($result['_champion']);
                $champion->setIncarnation($result['incarnation']);
            }
            $champion->getChampion()->addName($result['_language'], $result['text']);
        }
        return $champions;
    }
}
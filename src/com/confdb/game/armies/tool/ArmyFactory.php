<?php
namespace com\confdb\game\armies\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\armies\bean\Alliance;
use com\confdb\game\armies\bean\Army;

class ArmyFactory extends AFactory{
    public function dbToBean($results){
        $armies = [];
        foreach($results as $result){
            if(isset($armies[$result['id']])){
                $army = $armies[$result['id']];
            }
            else{
                $armies[$result['id']] = $army = new Army();
                $army->setId($result['id']);
            }
            $army->addLabel($result['_language'], $result['text']);
            $army->setIcon($result['icon']);
            if(isset($result['_alliance'])){
                $alliance = new Alliance();
                $alliance->setId($result['_alliance']);
                $army->setAlliance($alliance);
            }
        }
        return $armies;
    }
}
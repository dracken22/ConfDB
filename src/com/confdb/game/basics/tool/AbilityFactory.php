<?php
namespace com\confdb\game\basics\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Ability;

class AbilityFactory extends AFactory{
    public function dbToBean($results){
        $abilities = [];
        foreach($results as $result){
            if(isset($abilities[$result['id']])){
                $ability = $abilities[$result['id']];
            }
            else{
                $abilities[$result['id']] = $ability = new Ability();
                $ability->setId($result['id']);
            }
            $ability->addLabel($result['name_language'], $result['name']);
            $ability->addDescription($result['description_language'], $result['description']);
        }
        return $abilities;
    }
}
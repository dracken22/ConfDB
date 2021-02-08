<?php
namespace com\confdb\game\basics\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Ability;
use com\confdb\label\bean\Label;

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
                if($ability->getName() == null){
                    $label = new Label();
                    $label->setId($result['_name']);
                    $ability->setName($label);
                }
                if($ability->getDescription() == null){
                    $label = new Label();
                    $label->setId($result['_rule']);
                    $ability->setDescription($label);
                }
                $ability->setHasValue($result['has_value']);
            }
            if(isset($result['name'])){
                $ability->addName($result['name_language'], $result['name']);
            }
            if(isset($result['description'])){
                $ability->addDescription($result['description_language'], $result['description']);
            }
        }
        return $abilities;
    }
}
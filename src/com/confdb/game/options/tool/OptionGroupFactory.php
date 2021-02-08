<?php
namespace com\confdb\game\options\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\cards\bean\Fighter;
use com\confdb\game\options\bean\Option;
use com\confdb\game\options\bean\OptionGroup;

class OptionGroupFactory extends AFactory{
    public function dbToBean($results){
        $optionGroups = [];
        foreach($results as $result){
            if(isset($optionGroups[$result['id']])){
                $optionGroup = $optionGroups[$result['id']];
            }
            else{
                $optionGroups[$result['id']] = $optionGroup = new OptionGroup();
                $optionGroup->setId($result['id']);

                $fighter = new Fighter();
                $fighter->setId($result['_card_fighter']);
                $optionGroup->setBaseProfile($fighter);

                $optionGroup->setMandatory($result['mandatory']);
            }
            if(isset($result['option'])){
                $option = new Option();
                $option->setId($option);
                $optionGroup->addOption($option);
            }
        }
        return $optionGroups;
    }
}

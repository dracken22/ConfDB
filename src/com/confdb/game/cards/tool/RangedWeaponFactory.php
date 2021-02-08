<?php
namespace com\confdb\game\cards\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\cards\bean\RangedWeapon;
use com\confdb\label\bean\Label;

class RangedWeaponFactory extends AFactory{
    public function dbToBean($results){
        $rangedWeapons = [];
        foreach($results as $result){
            if(isset($rangedWeapons[$result['id']])){
                $rangedWeapon = $rangedWeapons[$result['id']];
            }
            else{
                $rangedWeapons[$result['id']] = $rangedWeapon = new RangedWeapon();
                $rangedWeapon->setId($result['id']);

                $label = new Label();
                $label->setId($result['_name']);
                $rangedWeapon->setName($label);
                if(isset($result['accuracy'])){
                    $rangedWeapon->setAccuracy($result['accuracy']);
                }
                if(isset($result['weapon_strength'])){
                    $rangedWeapon->setStrength($result['weapon_strength']);
                }
                if(isset($result['short_range'])){
                   $rangedWeapon->setShortRange($result['short_range']);
                }
                if(isset($result['medium_range'])){
                    $rangedWeapon->setMediumRange($result['medium_range']);
                }
                if(isset($result['long_range'])){
                    $rangedWeapon->setLongRange($result['long_range']);
                }
                if(isset($result['piercing'])){
                    $rangedWeapon->setPiercing($result['piercing']);
                }
                if(isset($result['splash'])){
                    $rangedWeapon->setSplash($result['splash']);
                }
                if(isset($result['heavy'])){
                    $rangedWeapon->setHeavy($result['heavy']);
                }

            }
            if(isset($result['name'])){
                $rangedWeapon->addName($result['name_language'], $result['name']);
            }
        }
        return $rangedWeapons;
    }
}

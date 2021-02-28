<?php
namespace com\confdb\game\cards\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\armies\bean\Army;
use com\confdb\game\basics\bean\Pedestal;
use com\confdb\game\basics\bean\Point;
use com\confdb\game\basics\bean\Rank;
use com\confdb\game\basics\bean\Size;
use com\confdb\game\basics\bean\Skill;
use com\confdb\game\basics\dao\GenderDao;
use com\confdb\game\cards\bean\Fighter;
use com\confdb\game\cards\bean\FighterAbility;
use com\confdb\game\cards\bean\FighterSkill;
use com\confdb\game\options\bean\OptionGroup;
use com\confdb\label\bean\Label;

class FighterFactory extends AFactory{
    public function dbToBean($results){
        $fighters = [];
        foreach($results as $result){
            if(isset($fighters[$result['_card']])){
                $fighter = $fighters[$result['_card']];
            }
            else{
                $fighters[$result['_card']] = $fighter = new Fighter($result['_card']);
            }
            $fighter = new Fighter();
            
            $fighter->setName(new Label($result['_name']));
            $fighter->setArmy(new Army($result['_army']));

            $fighter->setPoint(new Point($result['_point']));
            $fighter->getPoint()->setFixedPoints($result['fix_points']);
            $fighter->getPoint()->setCalculFormula($result['calculation_rule']);
            
            $fighter->setRank(new Rank($result['_rank']));
            $fighter->setSize(new Size($result['_size']));
            $fighter->setPedestal(new Pedestal($result['_pedestal']));

            if($result['_gender'] != null){
                $fighter->setGender(new Label($result['_gender']));
            }
            if($result['_magician'] != null){
                // TODO
            }
            if($result['_priest'] != null){
                // TODO
            }

            foreach(json_decode($result['skills'], true) as $skill_id => $skill_value){
                $skill = new FighterSkill($skill_id);
                $skill->setValue($skill_value);
                $fighter->addSkill($skill);
            }
            foreach(json_decode($result['names'], true) as $language_id => $text){
                $fighter->getName()->addLabel($language_id, $text);
            }
            foreach(json_decode($result['abilities'], true) as $ability_id => $ability_value){
                $ability = new FighterAbility($ability_id);
                if(isset($ability_value) && $ability_value != ''){
                    $ability->setValue($ability_value);
                }
                $fighter->addAbility($ability);
            }
            foreach(json_decode($result['classes'], true) as $class){
                $fighter->addClass(new Label($class));
            }
            foreach(json_decode($result['images'], true) as $image){
                $fighter->addImage($image);
            }
            foreach(json_decode($result['option_groups'], true) as $option){
                $fighter->addOptionGroup(new OptionGroup($option));
            }
        }
        return $fighters;
    }
}
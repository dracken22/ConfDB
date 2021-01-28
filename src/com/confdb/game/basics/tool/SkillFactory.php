<?php
namespace com\confdb\game\basics\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Skill;

class SkillFactory extends AFactory{
    public function dbToBean($results, $singleResult){
        $skills = [];
        foreach($results as $result){
            if(isset($skills[$result['id']])){
                $skill = $skills[$result['id']];
            }
            else{
                $skills[$result['id']] = $skill = new Skill();
                $skill->setId($result['id']);
            }
            $skill->addLabel($result['_language'], $result['text']);
        }
        return $skills;
    }

    public function beanToJson($bean){
        return [
            'id' => $bean->getId(),
            'skills' => $bean->getLabels()
        ];
    }
}
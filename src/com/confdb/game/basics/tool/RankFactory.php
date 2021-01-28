<?php
namespace com\confdb\game\basics\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Rank;

class RankFactory extends AFactory{
    public function dbToBean($results, $singleResult){
        $ranks = [];
        foreach($results as $result){
            if(isset($ranks[$result['id']])){
                $rank = $ranks[$result['id']];
            }
            else{
                $ranks[$result['id']] = $rank = new Rank();
                $rank->setId($result['id']);
            }
            $rank->addLabel($result['_language'], $result['text']);
            $rank->setLevel($result['level']);
        }
        return $ranks;
    }

    public function beanToJson($bean){
        return [
            'id' => $bean->getId(),
            'labels' => $bean->getLabels(),
            'level' => $bean->getLevel()
        ];
    }
}
<?php
namespace com\confdb\game\armies\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\armies\dao\AllianceDao;
use com\confdb\game\armies\dao\ArmyDao;

class ArmyBusiness extends ABusiness{
    protected function getDao(){
        return ArmyDao::getInstance();
    }

    public function listByAlliance(){
        $results = [];
        foreach(AllianceDao::getInstance()->list() as $alliance){
            $results[$alliance->getId()] = $alliance->toJson();
            $results[$alliance->getId()]['armies'] = [];
            foreach($this->getDao()->listByAlliance($alliance->getId()) as $army){
                $results[$alliance->getId()]['armies'][$army->getId()] = $army->toJson();
            }
        }
        return $results;
    }
}
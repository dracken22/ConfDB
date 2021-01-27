<?php

namespace com\confdb\controller;

use com\confdb\armylist\dao\ArmylistDao;
use Exception;

class LabelController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'create' :
                $response['id'] = ArmylistDao::create($this->getMandatoryParam('army_id'), $this->getMandatoryParam('name'),
                        $this->getParam('description'), $this->getMandatoryParam('language_id'), $this->getMandatoryParam('player_id'));
                break;
            case 'read' :
                // $response['player'] = ArmylistDao::read($this->getMandatoryParam('id'));
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
<?php

namespace com\confdb\controller;

use com\confdb\game\armies\business\AllianceBusiness;
use com\confdb\game\armies\business\ArmyBusiness;
use Exception;

class ArmyController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list_alliances' :
                $response['alliances'] = AllianceBusiness::getInstance()->list();
            case 'list_armies' :
                $response['armies'] = ArmyBusiness::getInstance()->list();
                break;
            case 'list_armies_by_alliance' :
                $response['alliances'] = ArmyBusiness::getInstance()->listByAlliance();
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
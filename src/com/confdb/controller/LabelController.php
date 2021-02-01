<?php

namespace com\confdb\controller;

use com\confdb\game\armies\business\AllianceBusiness;
use com\confdb\game\armies\business\ArmyBusiness;
use com\confdb\game\basics\business\GenderBusiness;
use com\confdb\game\basics\business\PedestalBusiness;
use com\confdb\game\basics\business\RankBusiness;
use com\confdb\game\basics\business\SizeBusiness;
use com\confdb\game\basics\business\SkillBusiness;
use com\confdb\label\business\LanguageBusiness;
use Exception;

class LabelController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list_languages' :
                $response['languages'] = LanguageBusiness::getInstance()->list();
                break;
            case 'lists' :
                $response['genders'] = GenderBusiness::getInstance()->list();
                $response['skills'] = SkillBusiness::getInstance()->list();
                $response['ranks'] = RankBusiness::getInstance()->list();
                $response['sizes'] = SizeBusiness::getInstance()->list();
                $response['pedestals'] = PedestalBusiness::getInstance()->list();
                $response['alliances'] = AllianceBusiness::getInstance()->list();
                $response['armies'] = ArmyBusiness::getInstance()->list();
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
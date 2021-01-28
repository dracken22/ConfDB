<?php

namespace com\confdb\controller;

use com\confdb\game\basics\dao\SkillDao;
use com\confdb\game\basics\tool\SkillFactory;
use Exception;

class SkillController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list' :
                $response['skills'] = SkillFactory::getInstance()->beansToJson(SkillDao::getInstance()->list());
                break;
            case 'create' :
                /* Params : labels, tableau indexé de labels, avec pour clés les language_id */
                $labels = $this->getMandatoryParam('labels');
                $response['id'] = SkillDao::getInstance()->create($labels);
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
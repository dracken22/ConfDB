<?php

namespace com\confdb\controller;

use com\confdb\game\basics\dao\RankDao;
use com\confdb\game\basics\tool\RankFactory;
use Exception;

class RankController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list' :
                $response['ranks'] = RankFactory::getInstance()->beansToJson(RankDao::getInstance()->list());
                break;
            case 'create' :
                $labels = $this->getMandatoryParam('labels');
                $level = $this->getMandatoryParam('level');
                $response['id'] = RankDao::getInstance()->create($labels, $level);
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
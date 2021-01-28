<?php

namespace com\confdb\controller;

use com\confdb\label\dao\LabelDao;
use com\confdb\label\dao\LanguageDao;
use com\confdb\label\tool\LabelFactory;
use com\confdb\label\tool\LanguageFactory;
use Exception;

class LabelController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list_languages' :
                $response['languages'] = LanguageFactory::getInstance()->beansToJson(LanguageDao::getInstance()->list());
                break;
            case 'list' :
                $response['labels'] = LabelFactory::getInstance()->beansToJson(LabelDao::getInstance()->list());
                break;
            case 'create' :
                /* Params : labels, tableau indexé de labels, avec pour clés les language_id */
                $labels = $this->getMandatoryParam('labels');
                $response['id'] = LabelDao::getInstance()->create($labels);
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
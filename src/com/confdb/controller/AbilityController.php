<?php

namespace com\confdb\controller;

use com\confdb\game\basics\business\AbilityBusiness;
use Exception;

class AbilityController extends AController{
    /**
     * getBusiness
     *
     * @return AbilityBusiness
     */
    protected function getBusiness(){
        return AbilityBusiness::getInstance();
    }

    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list' :
                $response['abilities'] = $this->getBusiness()->list();
                break;
            case 'read' :
                $response['ability'] = $this->getBusiness()->read($this->getMandatoryParam('ability_id'));
                break;
            case 'create' :
                $response['ability_id'] = $this->getBusiness()->create($this->getMandatoryParam('names'), $this->getMandatoryParam('descriptions'), $this->getParam('has_value'));
                break;
            case 'update' :
                $this->getBusiness()->update($this->getMandatoryParam('id'), $this->getMandatoryParam('names'), $this->getMandatoryParam('descriptions'), $this->getParam('has_value'));
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
<?php

namespace com\confdb\controller;

use com\confdb\player\dao\PlayerDao;
use Exception;

class PlayerController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list' :
                $response['players'] = PlayerDao::list(); 
                break;
            case 'create' :
                $response['id'] = PlayerDao::create($this->getMandatoryParam('name'));
                break;
            case 'attach' :
                PlayerDao::attach($this->getMandatoryParam('player_id'), $this->getMandatoryParam('user_id'));
                break;
            case 'read' :
                $response['player'] = PlayerDao::read($this->getMandatoryParam('id'));
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
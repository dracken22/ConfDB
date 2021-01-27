<?php

namespace com\confdb\controller;

use com\confdb\armylist\dao\ArmylistDao;
use com\confdb\user\dao\UserDao;
use Exception;

class UserController extends AController{
    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list' :
                $response['users'] = UserDao::list();
                break;
            case 'create' :
                $response['id'] = UserDao::create($this->getMandatoryParam('login'), $this->getMandatoryParam('password'),
                        $this->getMandatoryParam('email'), $this->getMandatoryParam('language_id'));
                break;
            case 'read' :
                $response['user'] = UserDao::read($this->getMandatoryParam('id'));
                // $response['player'] = ArmylistDao::read($this->getMandatoryParam('id'));
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
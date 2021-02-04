<?php

use com\confdb\controller\AbilityController;
use com\confdb\controller\ArmyController;
use com\confdb\controller\ArmylistController;
use com\confdb\controller\LabelController;
use com\confdb\controller\PlayerController;
use com\confdb\controller\RankController;
use com\confdb\controller\SkillController;
use com\confdb\controller\UserController;

function my_autoloader($class) {
    include $class . '.php';
}

spl_autoload_register('my_autoloader');

$infos = [];
if(isset($_GET)){
    foreach($_GET as $key => $value){
        $infos[$key] = $value;
    }
}
if(isset($_POST)){
    foreach($_POST as $key => $value){
        $infos[$key] = $value;
    }
}

function trimRecursif(&$array){
    foreach($array as $key => &$value){
        if(is_array($value)){
            trimRecursif($value);
        }
        else{
            trim($value);
        }
    }
}
trimRecursif($infos);

$response = [];
try{
    $response['query_params'] = $infos;
    if(isset($infos['controller'])){
        $controller = null;
        switch($infos['controller']){
            case 'Army':
                $controller = new ArmyController($infos);
                break;
            case 'Label':
                $controller = new LabelController($infos);
                break;
            case 'Ability':
                $controller = new AbilityController($infos);
                break;
            default : 
                throw new Exception("Le controller demandé n'existe pas !");
                break;
        }
        $controller->run($response, $infos);
    }
    else{
        throw new Exception("Aucun controller n'a été désigné pour votre requête !");
    }
    $response['success'] = true;
}
catch(Exception $e){
    $response['success'] = false;
    $response['error'] = $e->getMessage();
}

echo json_encode($response, true);
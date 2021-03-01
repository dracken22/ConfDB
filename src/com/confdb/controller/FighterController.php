<?php

namespace com\confdb\controller;

use com\confdb\game\cards\business\FighterBusiness;
use Exception;

class FighterController extends AController{
    /**
     * getBusiness
     *
     * @return FighterBusiness
     */
    protected function getBusiness(){
        return FighterBusiness::getInstance();
    }

    protected function resolveActions(&$response, $action){
        switch($action){
            case 'list_by_army' :
                $response['fighters'] = $this->getBusiness()->listByArmy($this->getMandatoryParam('army_id'));
                break;
            case 'read' :
                $response['ability'] = $this->getBusiness()->read($this->getMandatoryParam('fighter_id'));
                break;
            case 'create' :
                $names = $this->getMandatoryParam('names');
                $images = $this->getMandatoryParam('images');
                $army_id = $this->getMandatoryParam('army_id');
                $rank_id = $this->getMandatoryParam('rank_id');
                $size_id = $this->getMandatoryParam('size_id');
                $pedestal_id = $this->getMandatoryParam('pedestal_id');
                $gender_id = $this->getParam('gender_id');
                $points = $this->getMandatoryParam('points');
                $calcul_formula = $this->getMandatoryParam('calcul_formula');
                
                if($this->getMandatoryParam('is_champion') == true){
                    $champion_id = $this->getParam('champion_id');
                    $champion_names = $this->getParam('champion_names');
                    $incarnation = $this->getMandatoryParam('incarnation');
                    $response['fighter_id'] = $this->getBusiness()->createChampion($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $champion_id, $champion_names, $incarnation);
                }
                else{
                    $max_quantity = $this->getMandatoryParam('max_quantity');
                    $response['fighter_id'] = $this->getBusiness()->createTroop($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $max_quantity);
                }
                
                break;
            case 'update' :
                //$this->getBusiness()->update($this->getMandatoryParam('id'), $this->getMandatoryParam('names'), $this->getMandatoryParam('descriptions'), $this->getParam('has_value'));
                break;
            default :
                throw new Exception("L'action demandée n'existe pas !");
                break;
        }
    }
}
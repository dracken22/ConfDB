<?php
namespace com\confdb\game\cards\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\cards\dao\FighterDao;

class FighterBusiness extends ABusiness{
    /**
     * getDao
     *
     * @return FighterDao
     */
    protected function getDao(){
        return FighterDao::getInstance();
    }
       
    /**
     * listByArmy
     *
     * @param  mixed $army_id
     * @return array[Fighter]
     */
    public function listByArmy($army_id){
        $json = [];
        $fighters = $this->getDao()->listByArmy($army_id);
        foreach($fighters as $fighter){
            $json[] = $fighter->toJson();
        }
        return $json;
    }

    /**
     * read
     *
     * @param  int $fighter
     * @return string the fighter json
     */
    public function read($fighter_id){
        return $this->getDao()->read($fighter_id)->toJson();
    }

    public function createTroop($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $max_quantity){
        return $this->getDao()->createTroop($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $max_quantity);
    }
    public function createChampion($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $champion_id, $champion_names, $incarnation){
        return $this->getDao()->createChampion($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $champion_id, $champion_names, $incarnation);
    }

    public function updateTroop($fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $max_quantity){
        return $this->getDao()->updateTroop($fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $max_quantity);
    }
    public function updateChampion($fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $champion_id, $champion_names, $incarnation){
        return $this->getDao()->updateChampion($fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $points, $calcul_formula, $champion_id, $champion_names, $incarnation);
    }
}
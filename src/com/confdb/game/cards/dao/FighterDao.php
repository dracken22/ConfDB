<?php
namespace com\confdb\game\cards\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\cards\tool\FighterFactory;

class FighterDao extends ADao{
    protected function getFactory(){
        return FighterFactory::getInstance();
    }

    public function createTroop($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula, $maxQuantity){
        $connectionNumber = SqlTool::startTransaction();
        $card_id = $this->create($connectionNumber, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula);
        SqlTool::insert('INSERT INTO card_fighter_troops(_card_fighter, quantity_max) VALUES (?, ?)', [$card_id, $maxQuantity], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $card_id;
    }

    public function createChampion($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula, $champion_id, $champion_names, $incarnation){
        $connectionNumber = SqlTool::startTransaction();
        $card_id = $this->create($connectionNumber, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula);
        if(!isset($champion_id)){
            $champion_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
            foreach($champion_names as $language_id => $text){
                SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$champion_id, $language_id, $text], $connectionNumber);
            }
        }
        SqlTool::insert('INSERT INTO card_fighter_champions(_card_fighter, _champion, incarnation) VALUES (?, ?, ?)', [$card_id, $champion_id, $incarnation], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $card_id;
    }

    private function create($connectionNumber, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula){
        $label_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($names as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$label_id, $language_id, $text], $connectionNumber);
        }
        $point_id = SqlTool::insert('INSERT INTO points(fix_points, calculation_rule) VALUES (?, ?)', [$fixedPoint, $calculFormula], $connectionNumber);
        $card_id = SqlTool::insert('INSERT INTO cards(_name) VALUES (?)', [$label_id], $connectionNumber);
        SqlTool::insert('INSERT INTO card_fighters(_card, _army, _point, _rank, _size, _pedestal, _gender, _magician, _priest) VALUES(?,?,?,?,?,?,?,?,?)',
                [$card_id, $army_id, $point_id, $rank_id, $size_id, $pedestal_id, $gender_id, null, null], $connectionNumber);

        foreach($images as $image){
            SqlTool::insert('INSERT INTO card_images(_card, image) VALUES (?, ?)', [$card_id, $image], $connectionNumber);
        }
        return $card_id;
    }

    /*
    public function list(){
        return $this->_get('SELECT * FROM card_fighters');
    }
    */
}
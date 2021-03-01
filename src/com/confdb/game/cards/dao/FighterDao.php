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

    public function updateTroop($fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula, $maxQuantity){
        $connectionNumber = SqlTool::startTransaction();
        $this->update($connectionNumber, $fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula);
        SqlTool::insert('UPDATE card_fighter_troops SET quantity_max = ? WHERE _card_fighter = ?', [$maxQuantity, $fighter_id], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
    }

    public function createChampion($names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula, $champion_id, $champion_names, $incarnation){
        $connectionNumber = SqlTool::startTransaction();
        $card_id = $this->create($connectionNumber, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula);
        if(!isset($champion_id)){
            $champion_id = $this->createIncarnate($champion_names, $connectionNumber);
        }
        SqlTool::insert('INSERT INTO card_fighter_champions(_card_fighter, _champion, incarnation) VALUES (?, ?, ?)', [$card_id, $champion_id, $incarnation], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $card_id;
    }

    public function updateChampion($fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula, $champion_id, $champion_names, $incarnation){
        $connectionNumber = SqlTool::startTransaction();
        $this->update($connectionNumber, $fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula);
        if(!isset($champion_id)){
            $champion_id = $this->createIncarnate($champion_names, $connectionNumber);
        }
        SqlTool::insert('UPDATE card_fighter_champions SET _champion = ?, incarnation = ? WHERE _card_fighter = ?', [$champion_id, $incarnation, $fighter_id], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
    }

    private function create($connectionNumber, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula){
        $label_id = $this->insertLabel($connectionNumber, $names);
        $point_id = SqlTool::insert('INSERT INTO points(fix_points, calculation_rule) VALUES (?, ?)', [$fixedPoint, $calculFormula], $connectionNumber);
        $card_id = SqlTool::insert('INSERT INTO cards(_name) VALUES (?)', [$label_id], $connectionNumber);
        SqlTool::insert('INSERT INTO card_fighters(_card, _army, _point, _rank, _size, _pedestal, _gender, _magician, _priest) VALUES(?,?,?,?,?,?,?,?,?)',
                [$card_id, $army_id, $point_id, $rank_id, $size_id, $pedestal_id, $gender_id, null, null], $connectionNumber);
        foreach($images as $image){
            SqlTool::insert('INSERT INTO card_images(_card, image) VALUES (?, ?)', [$card_id, $image], $connectionNumber);
        }
        return $card_id;
    }

    private function update($connectionNumber, $fighter_id, $names, $images, $army_id, $rank_id, $size_id, $pedestal_id, $gender_id, $fixedPoint, $calculFormula){
        $fighter = $this->_getById('SELECT _name, _point FROM cards JOIN card_fighters ON _card = id WHERE id = ?', [$fighter_id]);
        $this->updateLabel($connectionNumber, $fighter['_name'], $names);
        $point_id = SqlTool::execute('UPDATE points SET fix_points = ?, calculation_rule = ? WHERE id = ?', [$fixedPoint, $calculFormula, $fighter['point']], $connectionNumber);

        SqlTool::execute('UPDATE card_fighters SET _army = ?, _point = ?, _rank = ?, _size = ?, _pedestal = ?, _gender = ?, _magician = ?, _priest = ?
                            WHERE _card = ?', [$army_id, $point_id, $rank_id, $size_id, $pedestal_id, $gender_id, null, null, $fighter_id], $connectionNumber);
        foreach($images as $image){
            SqlTool::insert('INSERT INTO card_images(_card, image) VALUES (?, ?)', [$fighter_id, $image], $connectionNumber);
        }
    }

    private function createIncarnate($champion_names, $connectionNumber){
        $name_id = $this->insertLabel($connectionNumber, $champion_names);
        return SqlTool::insert('INSERT INTO champions(_name) VALUES(?)', [$name_id], $connectionNumber);
    }

    private function getBaseQuery(){
        return 'SELECT
                    cards.*, 
                    card_fighters.*,
                    points.*,
                    card_fighter_troops.*,
                    CONCAT("{", GROUP_CONCAT(CONCAT(card_fighters_skills._skill ,":",card_fighters_skills.value), ","),"}") AS skills,
                    CONCAT("{", GROUP_CONCAT(CONCAT(labels_languages._language ,":",labels_languages.text), ","),"}") AS names,
                    CONCAT("{", GROUP_CONCAT(CONCAT(card_fighters_abilities._ability ,":",card_fighters_abilities.value), ","),"}") AS abilities,
                    CONCAT("[", GROUP_CONCAT(card_fighters_classes._class, ","),"]") AS classes,
                    CONCAT("[", GROUP_CONCAT(card_images.image, ","),"]") AS images,
                    CONCAT("[", GROUP_CONCAT(fighter_option_groups.id, ","),"]") AS option_groups
                FROM cards
                JOIN card_fighters ON card_fighters._card = cards.id 
                JOIN points ON points.id = card_fighters._point 
                JOIN labels_languages ON _label = cards._name
                LEFT OUTER JOIN card_fighter_troops ON card_fighter_troops._card_fighter = card_fighters._card
                LEFT OUTER JOIN card_fighter_champions ON card_fighter_champions._card_fighter = card_fighters._card
                JOIN card_fighters_skills ON card_fighters_skills._card_fighter = card_fighters._card 
                LEFT OUTER JOIN card_images ON card_images._card = cards.id
                LEFT OUTER JOIN card_fighters_ranged_weapons ON card_fighters_ranged_weapons._card_fighter = card_fighters._card
                LEFT OUTER JOIN card_fighters_abilities ON card_fighters_abilities._card_fighter = card_fighters._card
                LEFT OUTER JOIN card_fighters_classes ON card_fighters_classes._card_fighter = card_fighters._card
                LEFT OUTER JOIN fighter_option_groups ON fighter_option_groups._card_fighter = card_fighters._card ';
    }

    public function read($fighter_id){
        return $this->_getById($this->getBaseQuery() . '
                                WHERE id = ?
                                GROUP BY cards.id', [$fighter_id]);
        // A RAJOUTER POUR UN CHARGEMENT ULTERIEUR : magician, priest, ranged_weapons, options, champion
    }

    public function listByArmy($army_id){
        return $this->_get($this->getBaseQuery() . '
                                WHERE _army = ?
                                GROUP BY cards.id', [$army_id]);
        // A RAJOUTER POUR UN CHARGEMENT ULTERIEUR : magician, priest, ranged_weapons, options, champion
    }
}
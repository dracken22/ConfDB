<?php
namespace com\confdb\armylist\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;

class ArmylistDao extends ADao{
    public static function create($army_id, $name, $description, $language_id, $player_id){
        return SqlTool::insert('INSERT INTO armylists(_army, name, description, _language, _player) VALUES (?,?,?,?,?)', 
            [$army_id, $name, $description, $language_id, $player_id]);
    }

    public static function read($id){
        return self::getById('SELECT * FROM armylists WHERE id = ?', [$id]);
    }

    public static function list(){
        return SqlTool::read('SELECT * FROM armylists');
    }
}
<?php
namespace com\confdb\player\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;

class PlayerDao extends ADao{
    public static function create($nom){
        return SqlTool::insert('INSERT INTO players(name) VALUES (?)', [$nom]);
    }

    public static function attach($player_id, $user_id){
        return SqlTool::execute('UPDATE players SET _user = ? WHERE id = ?', [$user_id, $player_id]);
    }

    public static function read($id){
        return self::getById('SELECT * FROM players WHERE id = ?', [$id]);
    }

    public static function list(){
        return SqlTool::read('SELECT * FROM players');
    }
}
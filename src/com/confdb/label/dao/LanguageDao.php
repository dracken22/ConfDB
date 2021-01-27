<?php
namespace com\confdb\label\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;

class LanguageDao extends ADao{
    public static function create($code, $name, $flag){
        return SqlTool::insert('INSERT INTO languages(code, name, flag) VALUES (?, ?, ?)', [$code, $name, $flag]);
    }

    public static function read($id){
        return self::getById('SELECT * FROM languages WHERE id = ?', [$id]);
    }

    public static function list(){
        return SqlTool::read('SELECT * FROM languages');
    }
}
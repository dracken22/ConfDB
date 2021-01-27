<?php
namespace com\confdb\user\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;

class UserDao extends ADao{
    public static function create($login, $password, $email, $language_id){
        return SqlTool::insert('INSERT INTO users(login, password, email, _language) VALUES (?,?,?,?)', [$login, $password, $email, $language_id]);
    }

    public static function read($id){
        return self::getById('SELECT * FROM users WHERE id = ?', [$id]);
    }

    public static function list(){
        return SqlTool::read('SELECT * FROM users');
    }
}
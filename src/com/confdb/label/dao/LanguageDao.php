<?php
namespace com\confdb\label\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\label\tool\LanguageFactory;

class LanguageDao extends ADao{
    protected function getFactory(){
        return LanguageFactory::getInstance();
    }

    public function create($code, $name, $flag){
        return SqlTool::insert('INSERT INTO languages(code, name, flag_icon) VALUES (?, ?, ?)', [$code, $name, $flag]);
    }

    public function read($id){
        return $this->_getById('SELECT * FROM languages WHERE id = ?', [$id]);
    }

    public function list(){
        return $this->_get('SELECT * FROM languages');
    }
}
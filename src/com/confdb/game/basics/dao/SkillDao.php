<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\tool\SkillFactory;

class SkillDao extends ADao{
    protected function getFactory(){
        return SkillFactory::getInstance();
    }

    public function create($labels){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = $this->insertLabel($connectionNumber, $labels);
        $skill_id = SqlTool::insert('INSERT INTO skills(_name) VALUES(?)', [$label_id], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $skill_id;
    }

    public function read($id){
        return $this->_getById('SELECT * FROM skills JOIN labels_languages ON _name = _label WHERE id = ?', [$id]);
    }

    public function list(){
        return $this->_get('SELECT * FROM skills JOIN labels_languages ON _name = _label');
    }
}
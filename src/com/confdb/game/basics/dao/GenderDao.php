<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\label\tool\LabelFactory;

class GenderDao extends ADao{
    protected function getFactory(){
        return LabelFactory::getInstance();
    }

    public function create($labels){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = $this->insertLabel($connectionNumber, $labels);
        SqlTool::insert('INSERT INTO genders(_label) VALUES(?)', [$label_id], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $label_id;
    }

    public function list(){
        return $this->_get('SELECT genders._label as id, labels_languages.* FROM genders JOIN labels_languages ON genders._label = labels_languages._label');
    }
}
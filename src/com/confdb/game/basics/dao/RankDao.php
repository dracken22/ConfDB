<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\tool\RankFactory;

class RankDao extends ADao{
    protected function getFactory(){
        return RankFactory::getInstance();
    }

    public function create($labels, $level){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = $this->insertLabel($connectionNumber, $labels);
        SqlTool::insert('INSERT INTO ranks(_label, level) VALUES(?,?)', [$label_id, $level], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $label_id;
    }

    public function list(){
        return $this->_get('SELECT ranks._label as id, ranks.level, labels_languages.* FROM ranks JOIN labels_languages ON ranks._label = labels_languages._label');
    }
}
<?php
namespace com\confdb\game\armies\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\label\tool\LabelFactory;

class AllianceDao extends ADao{
    protected function getFactory(){
        return LabelFactory::getInstance();
    }

    public function create($labels){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = $this->insertLabel($connectionNumber, $labels);
        SqlTool::insert('INSERT INTO alliances(_label) VALUES(?)', [$label_id], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $label_id;
    }

    public function list(){
        return $this->_get('SELECT alliances._label as id, labels_languages.* FROM alliances JOIN labels_languages ON alliances._label = labels_languages._label');
    }
}
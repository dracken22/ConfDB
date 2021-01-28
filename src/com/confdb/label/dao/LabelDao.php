<?php
namespace com\confdb\label\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\label\tool\LabelFactory;

class LabelDao extends ADao{
    protected function getFactory(){
        return LabelFactory::getInstance();
    }

    public function create($labels){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$label_id, $language_id, $text], $connectionNumber);
        }
        SqlTool::endTransaction($connectionNumber);
        return $label_id;
    }

    public function read($id){
        return $this->_getById('SELECT * FROM labels JOIN labels_languages ON id = _label WHERE id = ?', [$id]);
    }

    public function list(){
        return $this->_get('SELECT * FROM labels JOIN labels_languages ON id = _label');
    }
}
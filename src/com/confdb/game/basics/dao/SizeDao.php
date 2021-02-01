<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\tool\SizeFactory;

class SizeDao extends ADao{
    protected function getFactory(){
        return SizeFactory::getInstance();
    }

    public function create($labels, $potency){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$label_id, $language_id, $text], $connectionNumber);
        }
        SqlTool::insert('INSERT INTO sizes(_label, potency) VALUES(?,?)', [$label_id, $potency], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $label_id;
    }

    public function list(){
        return $this->_get('SELECT sizes._label as id, sizes.potency, labels_languages.* FROM sizes JOIN labels_languages ON sizes._label = labels_languages._label');
    }
}
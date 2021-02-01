<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\tool\PedestalFactory;

class PedestalDao extends ADao{
    protected function getFactory(){
        return PedestalFactory::getInstance();
    }

    public function create($labels, $dimensions){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$label_id, $language_id, $text], $connectionNumber);
        }
        SqlTool::insert('INSERT INTO pedestals(_label, dimensions) VALUES(?,?)', [$label_id, $dimensions], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $label_id;
    }

    public function list(){
        return $this->_get('SELECT pedestals._label as id, pedestals.dimensions, labels_languages.* FROM pedestals JOIN labels_languages ON pedestals._label = labels_languages._label');
    }
}
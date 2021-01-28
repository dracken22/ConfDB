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
        $label_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$label_id, $language_id, $text], $connectionNumber);
        }
        $rank_id = SqlTool::insert('INSERT INTO ranks(_label, level) VALUES(?,?)', [$label_id, $level], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $rank_id;
    }

    public function list(){
        return $this->_get('SELECT * FROM ranks JOIN labels_languages ON ranks._label = labels_languages._label');
    }
}
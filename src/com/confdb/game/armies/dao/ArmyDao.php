<?php
namespace com\confdb\game\armies\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\armies\tool\ArmyFactory;

class ArmyDao extends ADao{
    protected function getFactory(){
        return ArmyFactory::getInstance();
    }

    public function create($labels, $icon, $alliance_id){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$label_id, $language_id, $text], $connectionNumber);
        }
        SqlTool::insert('INSERT INTO armies(_label, icon, _alliance) VALUES(?,?,?)', [$label_id, $icon, $alliance_id], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $label_id;
    }

    public function list(){
        return $this->_get('SELECT armies._label as id, armies.icon, armies._alliance, labels_languages.* 
                            FROM armies 
                            JOIN labels_languages ON armies._label = labels_languages._label');
    }

    public function listByAlliance($alliance_id){
        return $this->_get('SELECT armies._label as id, armies.icon, armies._alliance, labels_languages.* 
                            FROM armies 
                            JOIN labels_languages ON armies._label = labels_languages._label 
                            WHERE _alliance = ?', [$alliance_id]);
    }
}
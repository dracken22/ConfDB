<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\tool\AbilityFactory;

class AbilityDao extends ADao{
    protected function getFactory(){
        return AbilityFactory::getInstance();
    }

    public function create($names, $descriptions){
        $connectionNumber = SqlTool::startTransaction();
        $name_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($names as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$name_id, $language_id, $text], $connectionNumber);
        }
        $description_id = SqlTool::insert('INSERT INTO labels VALUES()', null, $connectionNumber);
        foreach($descriptions as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)', [$description_id, $language_id, $text], $connectionNumber);
        }
        $ability_id = SqlTool::insert('INSERT INTO abilities(_name, _rule) VALUES(?,?)', [$name_id, $description_id], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $ability_id;
    }

    public function read($ability_id){
        return $this->_getById('SELECT abilities.id,
                                names.text AS name,
                                names._language AS name_language,
                                descriptions.text AS description,
                                descriptions._language AS description_language
                            FROM abilities
                            JOIN labels_languages AS names ON abilities._name = names._label
                            JOIN labels_languages AS descriptions ON abilities._rule = descriptions._label
                            WHERE abilities.id = ?', [$ability_id]);
    }

    public function list(){
        return $this->_get('SELECT abilities.id,
                                names.text AS name,
                                names._language AS name_language,
                                descriptions.text AS description,
                                descriptions._language AS description_language
                            FROM abilities
                            JOIN labels_languages AS names ON abilities._name = names._label
                            JOIN labels_languages AS descriptions ON abilities._rule = descriptions._label');
    }
}
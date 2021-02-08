<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\tool\AbilityFactory;

class AbilityDao extends ADao{
    protected function getFactory(){
        return AbilityFactory::getInstance();
    }

    public function create($names, $descriptions, $has_value){
        $connectionNumber = SqlTool::startTransaction();
        $name_id = $this->insertLabel($connectionNumber, $names);
        $description_id = $this->insertLabel($connectionNumber, $descriptions);
        $ability_id = SqlTool::insert('INSERT INTO abilities(_name, _rule, has_value) VALUES(?,?,?)', [$name_id, $description_id, $has_value], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $ability_id;
    }

    public function update($id, $names, $descriptions, $has_value){
        $connectionNumber = SqlTool::startTransaction();
        $ability = $this->_getById('SELECT id, _name, _rule, has_value FROM abilities WHERE id = ?', [$id]);
        SqlTool::execute('UPDATE abilities SET has_value = ? WHERE id = ?', [$has_value, $id], $connectionNumber);
        foreach($names as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)
                                ON DUPLICATE KEY text = ?', [$ability['_name'], $language_id, $text, $text], $connectionNumber);
        }
        foreach($descriptions as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)
                                ON DUPLICATE KEY text = ?', [$ability['_rule'], $language_id, $text, $text], $connectionNumber);
        }
        SqlTool::endTransaction($connectionNumber);
    }

    public function read($ability_id){
        return $this->_getById($this->getBaseSelect() . 'WHERE abilities.id = ?', [$ability_id]);
    }

    public function list(){
        return $this->_get($this->getBaseSelect());
    }

    private function getBaseSelect(){
        return 'SELECT abilities.id,
                        _name,
                        _rule,
                        has_value,
                        names.text AS name,
                        names._language AS name_language,
                        descriptions.text AS description,
                        descriptions._language AS description_language
                    FROM abilities
                    JOIN labels_languages AS names ON abilities._name = names._label
                    JOIN labels_languages AS descriptions ON abilities._rule = descriptions._label';
    }
}
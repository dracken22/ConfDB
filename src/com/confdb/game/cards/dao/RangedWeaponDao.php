<?php
namespace com\confdb\game\cards\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\cards\tool\RangedWeaponFactory;

class RangedWeaponDao extends ADao{
    protected function getFactory(){
        return RangedWeaponFactory::getInstance();
    }

    public function create($names, $accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing, $is_splash, $is_heavy){
        $connectionNumber = SqlTool::startTransaction();
        $name_id = $this->insertLabel($connectionNumber, $names);
        $ability_id = SqlTool::insert('INSERT INTO abilities(_name, accuracy, weapon_strength, short_range, medium_range, long_range, piercing, splash, heavy)
                    VALUES(?,?,?,?,?,?,?,?,?)', [$name_id, $accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing, $is_splash, $is_heavy], $connectionNumber);
        SqlTool::endTransaction($connectionNumber);
        return $ability_id;
    }

    public function update($id, $names, $accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing, $is_splash, $is_heavy){
        $connectionNumber = SqlTool::startTransaction();
        $ability = $this->_getById('SELECT id, _name FROM abilities WHERE id = ?', [$id]);
        SqlTool::execute('UPDATE abilities 
                            SET accuracy = ?, weapon_strength = ?, short_range = ?, medium_range = ?,
                                long_range = ?, piercing = ?, splash = ?, heavy = ? WHERE id = ?',
                            [$accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing, $is_splash, $is_heavy, $id], $connectionNumber);
        foreach($names as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)
                                ON DUPLICATE KEY text = ?', [$ability['_name'], $language_id, $text, $text], $connectionNumber);
        }
        SqlTool::endTransaction($connectionNumber);
    }

    public function read($ranged_weapon_id){
        return $this->_getById($this->getBaseSelect() . 'WHERE ranged_weapons.id = ?', [$ranged_weapon_id]);
    }

    public function list(){
        return $this->_get($this->getBaseSelect());
    }

    private function getBaseSelect(){
        return 'SELECT ranged_weapons.*
                    text AS name,
                    _language AS name_language
                FROM ranged_weapons
                JOIN labels_languages ON ranged_weapons._name = labels_languages._label';
    }
}
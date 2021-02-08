<?php
namespace com\confdb\game\options\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\dao\PointDao;
use com\confdb\game\options\tool\OptionFactory;
use com\confdb\game\options\tool\OptionGroupFactory;

class OptionGroupDao extends ADao{
    protected function getFactory(){
        return OptionGroupFactory::getInstance();
    }

    public function create($fighter_id, $is_mandatory, $options){
        $connectionNumber = SqlTool::startTransaction();
        $option_group_id = SqlTool::insert('INSERT INTO fighter_option_groups(_card_fighter, mandatory) VALUES(?,?)', [$fighter_id, $is_mandatory], $connectionNumber);
        foreach($options as $option){
            $this->insertLabel($connectionNumber, $option['names']);
            PointDao::getInstance()->insertPoints($connectionNumber, $option['fix_points'], $option['calcul_formula']);
            // TODO : voir l'ajout des options
            // Ajouter les compétences, caracs, tir, etc
        }
        SqlTool::endTransaction($connectionNumber);
        return $option_group_id;
    }

    public function update($id, $fighter_id, $is_mandatory, $options){
        /*$connectionNumber = SqlTool::startTransaction();
        $ability = $this->_getById('SELECT id, _name FROM abilities WHERE id = ?', [$id]);
        SqlTool::execute('UPDATE abilities 
                            SET accuracy = ?, weapon_strength = ?, short_range = ?, medium_range = ?,
                                long_range = ?, piercing = ?, splash = ?, heavy = ? WHERE id = ?',
                            [$accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing, $is_splash, $is_heavy, $id], $connectionNumber);
        foreach($names as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text) VALUES (?,?,?)
                                ON DUPLICATE KEY text = ?', [$ability['_name'], $language_id, $text, $text], $connectionNumber);
        }
        SqlTool::endTransaction($connectionNumber);*/
    }

    public function read($option_group_id){
        return $this->_getById($this->getBaseSelect() . 'WHERE fighter_option_groups.id = ?', [$option_group_id]);
    }

    public function list(){
        return $this->_get($this->getBaseSelect());
    }

    private function getBaseSelect(){
        return 'SELECT fighter_option_groups.*,
                    fighter_options.id as option
                FROM fighter_option_groups
                JOIN fighter_options ON fighter_option_groups.id = fighter_options._fighter_option_group';
    }
}
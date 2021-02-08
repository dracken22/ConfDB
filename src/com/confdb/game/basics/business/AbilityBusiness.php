<?php
namespace com\confdb\game\basics\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\basics\dao\AbilityDao;

class AbilityBusiness extends ABusiness{
    /**
     * getDao
     *
     * @return AbilityDao
     */
    protected function getDao(){
        return AbilityDao::getInstance();
    }
   
    /**
     * read
     *
     * @param  int $ability_id
     * @return string the ability json
     */
    public function read($ability_id){
        return $this->getDao()->read($ability_id)->toJson();
    }
    
    /**
     * create
     *
     * @param  array $names language_id as key
     * @param  array $descriptions language_id as key
     * @param  boolean $has_value si la compétence a un paramètre
     * @return int id
     */
    public function create($names, $descriptions, $has_value = false){
        return $this->getDao()->create($names, $descriptions, $has_value);
    }
        
    /**
     * update
     *
     * @param  int $id
     * @param  array $names language_id as key
     * @param  array $descriptions language_id as key
     * @param  boolean $has_value si la compétence a un paramètre
     */
    public function update($id, $names, $descriptions, $has_value = false){
        $this->getDao()->update($id, $names, $descriptions, $has_value);
    }
}
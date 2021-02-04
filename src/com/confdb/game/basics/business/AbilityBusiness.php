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
     * @param  mixed $descriptions language_id as key
     * @return void
     */
    public function create($names, $descriptions){
        return $this->getDao()->create($names, $descriptions);
    }
}
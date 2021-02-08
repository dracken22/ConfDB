<?php
namespace com\confdb\game\cards\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\cards\dao\RangedWeaponDao;

class RangedWeaponBusiness extends ABusiness{
    /**
     * getDao
     *
     * @return RangedWeaponDao
     */
    protected function getDao(){
        return RangedWeaponDao::getInstance();
    }
   
    /**
     * read
     *
     * @param  int $ranged_weapon_id
     * @return string the ranged weapon json
     */
    public function read($ranged_weapon_id){
        return $this->getDao()->read($ranged_weapon_id)->toJson();
    }
        
    /**
     * create
     *
     * @param  array $names language_id as key
     * @param  int $accuracy
     * @param  int $strength
     * @param  int $short_range
     * @param  int $medium_range
     * @param  int $long_range
     * @param  boolean $is_piercing
     * @param  boolean $is_splash
     * @param  boolean $is_heavy
     * @return int ranged_weapon_id
     */
    public function create($names, $accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing = false, $is_splash = false, $is_heavy = false){
        return $this->getDao()->create($names, $accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing, $is_splash, $is_heavy);
    }
        
    /**
     * update
     *
     * @param  int $id
     * @param  array $names language_id as key
     * @param  int $accuracy
     * @param  int $strength
     * @param  int $short_range
     * @param  int $medium_range
     * @param  int $long_range
     * @param  boolean $is_piercing
     * @param  boolean $is_splash
     * @param  boolean $is_heavy
     */
    public function update($id, $names, $accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing = false, $is_splash = false, $is_heavy = false){
        $this->getDao()->update($id, $names, $accuracy, $strength, $short_range, $medium_range, $long_range, $is_piercing = false, $is_splash = false, $is_heavy = false);
    }
}
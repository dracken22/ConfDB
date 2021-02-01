<?php
namespace com\confdb\game\basics\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\basics\dao\GenderDao;

class GenderBusiness extends ABusiness{
    protected function getDao(){
        return GenderDao::getInstance();
    }
}
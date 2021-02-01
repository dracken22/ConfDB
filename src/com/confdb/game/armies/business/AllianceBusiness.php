<?php
namespace com\confdb\game\armies\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\armies\dao\AllianceDao;

class AllianceBusiness extends ABusiness{
    protected function getDao(){
        return AllianceDao::getInstance();
    }
}
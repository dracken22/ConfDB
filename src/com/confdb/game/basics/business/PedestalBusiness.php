<?php
namespace com\confdb\game\basics\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\basics\dao\PedestalDao;

class PedestalBusiness extends ABusiness{
    protected function getDao(){
        return PedestalDao::getInstance();
    }
}
<?php
namespace com\confdb\game\basics\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\basics\dao\SizeDao;

class SizeBusiness extends ABusiness{
    protected function getDao(){
        return SizeDao::getInstance();
    }
}
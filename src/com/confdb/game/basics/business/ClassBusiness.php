<?php
namespace com\confdb\game\basics\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\basics\dao\ClassDao;

class ClassBusiness extends ABusiness{
    protected function getDao(){
        return ClassDao::getInstance();
    }
}
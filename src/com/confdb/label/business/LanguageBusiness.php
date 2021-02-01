<?php
namespace com\confdb\label\business;

use com\confdb\base\business\ABusiness;
use com\confdb\label\dao\LanguageDao;

class LanguageBusiness extends ABusiness{
    protected function getDao(){
        return LanguageDao::getInstance();
    }
}
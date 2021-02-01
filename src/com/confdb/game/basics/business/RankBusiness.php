<?php
namespace com\confdb\game\basics\business;

use com\confdb\base\business\ABusiness;
use com\confdb\game\basics\dao\RankDao;

class RankBusiness extends ABusiness{
    protected function getDao(){
        return RankDao::getInstance();
    }
}
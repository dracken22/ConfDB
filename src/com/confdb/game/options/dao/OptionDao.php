<?php
namespace com\confdb\game\options\dao;

use com\confdb\base\dao\ADao;
use com\confdb\game\options\tool\OptionFactory;

class OptionDao extends ADao{
    protected function getFactory(){
        return OptionFactory::getInstance();
    }
}
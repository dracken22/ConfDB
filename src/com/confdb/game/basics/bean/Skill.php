<?php
namespace com\confdb\game\basics\bean;

use com\confdb\label\bean\Label;

class Skill extends Label{
    public function getShortLabel($language_id){
        return strtoupper(substr($this->getLabel($language_id), 0, 3));
    }
}
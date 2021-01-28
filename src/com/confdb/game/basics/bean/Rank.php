<?php
namespace com\confdb\game\basics\bean;

use com\confdb\label\bean\Label;

class Rank extends Label{
    private $level;

    public function getLevel(){
        return $this->level;
    }
    public function setLevel($level){
        $this->level = $level;
    }
}
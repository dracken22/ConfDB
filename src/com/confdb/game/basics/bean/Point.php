<?php
namespace com\confdb\game\basics\bean;

use com\confdb\base\bean\ABean;

class Point extends ABean{
    private $fixedPoints;
    private $calculFormula;

    public function getFixedPoints(){
        return $this->fixedPoints;
    }
    public function setFixedPoints($fixedPoints){
        $this->fixedPoints = $fixedPoints;
    }
    public function getCalculFormula(){
        return $this->calculFormula;
    }
    public function setCalculFormula($calculFormula){
        $this->calculFormula = $calculFormula;
    }

    public function toJson(){
        return [
            'id' => $this->getId(),
            'fixedPoints' => $this->getFixedPoints(),
            'calculFormula' => $this->getCalculFormula()
        ];
    }
}
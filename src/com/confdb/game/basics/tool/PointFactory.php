<?php
namespace com\confdb\game\basics\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Point;

class PointFactory extends AFactory{
    public function dbToBean($results){
        $points = [];
        foreach($results as $result){
            if(isset($points[$result['id']])){
                $point = $points[$result['id']];
            }
            else{
                $points[$result['id']] = $point = new Point();
                $point->setId($result['id']);
            }
            $point->setFixedPoints($result['fix_points']);
            $point->setCalculFormula($result['calculation_rule']);
        }
        return $points;
    }
}
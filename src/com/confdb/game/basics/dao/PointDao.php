<?php
namespace com\confdb\game\basics\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\tool\PointFactory;

class PointDao extends ADao{
    protected function getFactory(){
        return PointFactory::getInstance();
    }

    public function insertPoints($connectionNumber, $fix_points, $calcul_formula) {
        return SqlTool::insert('INSERT INTO points(fix_points, calculation_rule) VALUES(?,?)', [$fix_points, $calcul_formula], $connectionNumber);
    }
}
<?php
namespace com\confdb\game\basics\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Pedestal;

class PedestalFactory extends AFactory{
    public function dbToBean($results){
        $pedestals = [];
        foreach($results as $result){
            if(isset($pedestals[$result['id']])){
                $pedestal = $pedestals[$result['id']];
            }
            else{
                $pedestals[$result['id']] = $pedestal = new Pedestal();
                $pedestal->setId($result['id']);
            }
            $pedestal->addLabel($result['_language'], $result['text']);
            $pedestal->setDimensions($result['dimensions']);
        }
        return $pedestals;
    }
}
<?php
namespace com\confdb\label\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\label\bean\Label;

class LabelFactory extends AFactory{
    public function dbToBean($results, $singleResult){
        $labels = [];
        foreach($results as $result){
            if(isset($labels[$result['id']])){
                $label = $labels[$result['id']];
            }
            else{
                $labels[$result['id']] = $label = new Label();
                $label->setId($result['id']);
            }
            $label->addLabel($result['_language'], $result['text']);
        }
        return $labels;
    }
}
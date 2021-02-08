<?php
namespace com\confdb\game\options\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Point;
use com\confdb\game\options\bean\Option;
use com\confdb\label\bean\Label;

class OptionFactory extends AFactory{
    public function dbToBean($results){
        $options = [];
        foreach($results as $result){
            if(isset($options[$result['id']])){
                $option = $options[$result['id']];
            }
            else{
                $options[$result['id']] = $option = new Option();
                $option->setId($result['id']);

                $label = new Label();
                $label->setId($result['_label']);
                $option->setName($label);

                $point = new Point();
                $point->setId($result['_point']);
                $option->setPoint($point);
            }
            if(isset($result['name'])){
                $option->addName($result['name_language'], $result['name']);
            }
        }
        return $options;
    }
}

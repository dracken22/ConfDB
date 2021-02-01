<?php
namespace com\confdb\game\basics\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\game\basics\bean\Size;

class SizeFactory extends AFactory{
    public function dbToBean($results, $singleResult){
        $sizes = [];
        foreach($results as $result){
            if(isset($sizes[$result['id']])){
                $size = $sizes[$result['id']];
            }
            else{
                $sizes[$result['id']] = $size = new Size();
                $size->setId($result['id']);
            }
            $size->addLabel($result['_language'], $result['text']);
            $size->setPotency($result['potency']);
        }
        return $sizes;
    }
}
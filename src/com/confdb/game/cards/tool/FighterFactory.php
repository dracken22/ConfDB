<?php
namespace com\confdb\game\cards\tool;

use com\confdb\base\tool\AFactory;

class FighterFactory extends AFactory{
    public function dbToBean($results){
        $fighters = [];
        /*foreach($results as $result){
            if(isset($sizes[$result['id']])){
                $size = $sizes[$result['id']];
            }
            else{
                $sizes[$result['id']] = $size = new Size();
                $size->setId($result['id']);
            }
            $size->addLabel($result['_language'], $result['text']);
            $size->setPotency($result['potency']);
        }*/
        return $fighters;
    }
}
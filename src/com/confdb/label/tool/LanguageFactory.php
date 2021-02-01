<?php
namespace com\confdb\label\tool;

use com\confdb\base\tool\AFactory;
use com\confdb\label\bean\Language;

class LanguageFactory extends AFactory{
    public function dbToBean($results, $singleResult){
        $languages = [];
        foreach($results as $result){
            $language = new Language();
            $language->setId($result['id']);
            $language->setCode($result['code']);
            $language->setName($result['name']);
            $language->setIcon($result['flag_icon']);
            $languages[] = $language;
        }
        return $languages;
    }
}
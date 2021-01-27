<?php
namespace com\confdb\label\dao;

use com\confdb\base\dao\ADao;
use com\confdb\base\tool\SqlTool;

class LabelDao extends ADao{
    public static function create($ar_labels){
        $connectionNumber = SqlTool::startTransaction();
        $label_id = SqlTool::insert('INSERT INTO labels', null, $connectionNumber);

        foreach($ar_labels as $language_id => $text){
            SqlTool::execute('INSERT INTO labels_languages(_label, _language, text', [$label_id, $language_id, $text], $connectionNumber);
        }
        SqlTool::endTransaction($connectionNumber);
    }

    public static function read($id){
        return self::getById('SELECT * FROM labels WHERE id = ?', [$id]);
    }

    public static function list(){
        return SqlTool::read('SELECT * FROM labels');
    }
}
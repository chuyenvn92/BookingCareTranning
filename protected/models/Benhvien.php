<?php

class Benhvien extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'benhvien';
    }

    public function rules() {
        return array(
            array('ten, diachi, gioithieu', 'required'),
            array('ten', 'length', 'max' => 100),
            array('ten', 'unique', 'on' => 'admin'),
        );
    }

}

?>
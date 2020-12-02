<?php


namespace frontend\models;


use yii\db\ActiveRecord;

class Articles extends ActiveRecord
{

    public function getShortText($text){
        $text=mb_substr($text,0,50);
        $prob=strripos($text, " ");
        $text=mb_substr($text,0,$prob);
        return $text. '...';
    }
}
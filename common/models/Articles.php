<?php


namespace common\models;


use backend\models\Picture;
use yii\db\ActiveRecord;

class Articles extends ActiveRecord
{

    public function getShortText($text){
        $text=mb_substr($text,0,255);
        $prob=strripos($text, " ");
        $text=mb_substr($text,0,$prob);
        return $text. '...';
    }
    public function  countViews(){

        return $this->hits+=1;
    }

    public function getPicture()
    {
        return $this->hasMany(Picture::classname(), ['article_id' => 'id']);
    }
}
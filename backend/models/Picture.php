<?php

namespace backend\models;

use common\models\Articles;
use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "picture".
 *
 * @property int $id
 * @property int $article_id
 * @property string $name
 *
 * @property Articles $article
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['id', 'article_id', 'name'], 'required'],
            [['id', 'article_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'name' => 'Name',
        ];
    }

    public function uploadFile($id, $name)
    {

        $path = Yii::getAlias('@frontend/web/img/article_pics/' . $id . '/');

        try {
            if (FileHelper::createDirectory($path, $mode = 0775, $recursive = true)) {

                $name->saveAs($path . $name->baseName . '.' . $name->extension);
            }
        } catch (Exception $e) {
            throw new NotFoundHttpException;
        }

        return '/frontend/web/img/article_pics/' . $id . '/' . $name->baseName . '.' . $name->extension;

    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Articles::className(), ['id' => 'article_id']);
    }
}

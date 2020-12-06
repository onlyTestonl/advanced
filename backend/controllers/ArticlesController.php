<?php
namespace backend\controllers;

use backend\models\Picture;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Articles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ArticlesController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $articles=Articles::find()->with('picture')->all();

        return $this->render('index',[
            'articles'=>$articles,
        ]);
    }

    public function actionArticle(){

        $id=Yii::$app->request->get()['id'];
        $id=(int)$id;
        if (is_int($id)) {
            $article = Articles::find()->where(['id' =>$id])->one();
            if ($article!=NULL){
                $article->countViews();
                $article->save();
            }
            else {
                throw new NotFoundHttpException;

            }

        }
        else {
            throw new NotFoundHttpException;

        }

        return $this->render('article',[
            'article'=>$article
        ]);

    }
}

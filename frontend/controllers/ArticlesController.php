<?php
namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Articles;
use yii\web\Controller;

/**
 * Site controller
 */
class ArticlesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

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
        $articles=Articles::find()->all();

        return $this->render('index',[
            'articles'=>$articles
        ]);
    }

    public function actionArticle(){

        $article=Articles::find()->where(['id'=>Yii::$app->request->get()['id']])->one();
        if($article==NULL){
            $article=Articles::find()->where('id'==0)->one();
        }
        $article->hits+=1;
        $article->save();

        return $this->render('article',[
            'article'=>$article
        ]);

    }

    /*public function actionArticles(){

        $articles=Articles::find()->all();

        return $this->render('index',[
        'articles'=>$articles
        ]);
    }*/
}

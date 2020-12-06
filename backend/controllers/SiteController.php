<?php

namespace backend\controllers;

use common\models\Articles;
use backend\models\Picture;
use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $article = new Articles;
            $picture = new Picture;
            $article->title = Yii::$app->request->post()["Articles"]['title'];
            $article->text = Yii::$app->request->post()["Articles"]['text'];
            $article->data = Yii::$app->request->post()["Articles"]['data'];
            $article->save();


            ($_FILES["Picture"]["name"]['name'] ? $picture->name = UploadedFile::getInstance($picture, 'name') : "");

            $picture->article_id = $article->id;
            $picture->name=$picture->uploadFile($picture->article_id,$picture->name);

            $picture->save();

            Yii::$app->getResponse()->redirect(Yii::$app->getRequest()->getUrl());

            $article->picture_id = $picture->id;

            $article->save();


        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

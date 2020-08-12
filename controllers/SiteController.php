<?php

namespace app\controllers;

use app\models\Model_Login;
use app\models\ModelAdvertising;
use app\models\ModelLogin;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Advertising;
use function Sodium\compare;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

        $vall = Advertising::find()->all();
        /* $query = new \yii\db\Query;
         $query->select('user.username,advertising.title,advertising.description,advertising.datetime,advertising.id')
             ->from('`advertising`')
             ->leftJoin('`user`','`advertising`.`id_user` = `user`.`id`');
         $command = $query->createCommand();
         $res_query = $command->queryAll();
     */
        $query_pagiantion = Advertising::find()
            ->with('user')
            ->orderBy(['datetime' => SORT_DESC, 'title' => SORT_DESC, 'description' => SORT_DESC, 'id_user' => SORT_DESC, 'id' => SORT_DESC,
            ]);


        //   var_dump($query_pagiantion);
        $pages = new Pagination(['totalCount' => $query_pagiantion->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $posts = $query_pagiantion->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


            ///------------------
        $model = new ModelLogin();


        if($model->load(Yii::$app->request->post()) && $model->login())
        {
         //   var_dump($model->login());
            return $this->render('index',compact('vall', 'posts', 'pages','model'));
        }

        return $this->render('index', compact('vall', 'posts', 'pages','model'));
    }
    public function actionLogout()
    {

        Yii::$app->user->logout();
        $this->redirect('index');
    }
    public function actionCreate()
    {
        $model = new ModelAdvertising();

        if($model->load(Yii::$app->request->post()) && $model->add() == true)
        {
                 $this->redirect('index');

        }
        return $this->render('create',compact('model'));
    }
    public function actionView($id)
    {
         $query = new \yii\db\Query;
         $query->select('user.id as '.'user_id'.',user.username,advertising.title,advertising.description,advertising.datetime,advertising.id')
             ->from('`advertising`')
             ->leftJoin('`user`','`advertising`.`id_user` = `user`.`id`')
            ->where('`advertising`.`id`='.$id.'');
         $command = $query->createCommand();
         $res_query = $command->queryAll();

        $model = new ModelAdvertising();
        if($model->load(Yii::$app->request->post()))
        {
            var_dump("dsa");
        }

        return $this->render('view',compact('res_query'));
    }
    public function actionDelete($id)
    {
        $model = new ModelAdvertising();
        $model->DeleteItem($id);
        $this->redirect('index');

    }
    public function  actionEdit($id)
    {
        $query = new \yii\db\Query;
        $query->select('user.id as '.'user_id'.',user.username,advertising.title,advertising.description,advertising.datetime,advertising.id')
            ->from('`advertising`')
            ->leftJoin('`user`','`advertising`.`id_user` = `user`.`id`')
            ->where('`advertising`.`id`='.$id.'');
        $command = $query->createCommand();
        $res_query = $command->queryAll();
        $model = new ModelAdvertising();

        if($model->load(Yii::$app->request->post()) && $model->Update($id) == true)
        {
            $this->redirect('index');

        }
        return $this->render('edit',compact('res_query','model'));
    }

}
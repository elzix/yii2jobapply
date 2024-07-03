<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Job;
use app\models\JobCategory;
use app\models\Application;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
    public function actionApplications( $a = 'all', $j = false )
    {
        $table = array();
        $table[ 'rows' ] = array();
        $table[ 'cols' ] = array(
        '#', 'Fname', 'Lname', 'CV', 'Letter'
        );
        switch ( $a ) {
            case 'new':
                if( $j ){
                    $model = new Application();
                    $post = Yii::$app->request->post();
                    $model->job = $j;
    
                    if( $model->load( $post ) )  {
                        if( isset( $post[ 'new-application' ] ) )  {
                            $model->cv = UploadedFile::getInstance($model, 'cv');
                            $model->letter = UploadedFile::getInstance($model, 'letter');

                            if( $model->save() )  {
                            
                                if( $model->upload()  )  {
                                    return $this->redirect( '/jobs/' . $j );
                                }
                            }
                        }
                    }
    
                    return $this->render( '/app/new', [
                    'model' => $model,
                    'status' => Yii::t( 'app', 'Add' ),
                    'status_title' => Yii::t( 'app', 'New invoice task' ),
                    'saved' => false
                    ] );
                }

                break;
            
            default: // all
                
                $a = Application::find()->addOrderBy( [ 'created' => SORT_ASC ] )->all();
                foreach( $a as $i => $app )  {
                    $table[ 'rows' ][ $i ][ '#' ] = $i + 1;
                    $table[ 'rows' ][ $i ][ 'Fname' ] = ucfirst( $app->fname );
                    $table[ 'rows' ][ $i ][ 'Lname' ] = ucfirst( $app->lname );
                    $table[ 'rows' ][ $i ][ 'CV' ] = 
                        sprintf (
                            '<a href="%s" target="_blank" class="btn btn-primary">%s</a>',
                            Url::to("uploads/{$app->cv}"),
                            $app->cv
                        );
                    $table[ 'rows' ][ $i ][ 'Letter' ] =
                        sprintf (
                            '<a href="%s" target="_blank" class="btn btn-info">%s</a>',
                            Url::to("uploads/{$app->letter}"),
                            $app->letter
                        );
                }
                break;
        }
        return $this->render( 'applications', ['table' => $table] );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionJobs( $j = 'all' )
    {
        switch ( $j ) {
            case 'new':
                $model = new Job();
                $post = Yii::$app->request->post();

                if( $model->load( $post ) )  {
                    if( isset( $post[ 'new-job' ] ) )  {

                        if( $model->save()  )  {
                            $t = $model->id;
                            return $this->redirect( '/jobs/' . $t );
                        }
                    }
                }

                return $this->render( '/jobs/new', [
                'model' => $model,
                'status' => Yii::t( 'app', 'Add' ),
                'status_title' => Yii::t( 'app', 'New invoice task' ),
                'saved' => false
                ] );
                break;
            
            case 'all': // all
                $j = Job::find()->addOrderBy( [ 'created' => SORT_ASC ] )->all();
                break;
        
            default: // all
                $j = Job::findOne($j);
                return $this->render( '/jobs/single', ['job' => $j] );
        }
        return $this->render( 'jobs', ['jobs' => $j] );
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionJobCategories( $a = 'all' )
    {
        switch ( $a ) {
            case 'new':
                # code...
                break;
            
            default: // all
                $table = array();
                $table[ 'rows' ] = array();
                $table[ 'cols' ] = array(
                '#', 'Name', 'Description'
                );
                $a = JobCategories::find()->addOrderBy( [ 'created' => SORT_ASC ] )->all();
                foreach( $a as $i => $app )  {
                    $table[ 'rows' ][ $i ][ '#' ] = $i + 1;
                    $table[ 'rows' ][ $i ][ 'Name' ] = ucfirst( $app->name );
                    $table[ 'rows' ][ $i ][ 'Description' ] = $app->description;
                }
                break;
        }
        return $this->render( 'applications', ['table' => $table] );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

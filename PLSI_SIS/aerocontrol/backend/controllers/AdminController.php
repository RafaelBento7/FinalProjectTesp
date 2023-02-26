<?php

namespace backend\controllers;

use backend\models\AdminForm;
use common\models\Admin;
use common\models\AdminSearch;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['viewAdmin'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewAdmin'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createAdmin'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateAdmin'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteAdmin'],
                        ],
                    ],
                ]
            ]
        );
    }

    /**
     * Lists all Admin models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewAdmin')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param int $admin_id ID do Admin
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($admin_id)
    {
        if (!Yii::$app->user->can('viewAdmin')) new ForbiddenHttpException("Não tem acesso a esta página.");

        return $this->render('view', [
            'model' => $this->findModel($admin_id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createAdmin')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = new AdminForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create()) {

                //Criar logs
                Yii::info("Criar administrador", 'admin');

                return $this->redirect(['view', 'admin_id' => $model->admin_id]);
            }
        } else {
            $model->resetAttributesOnInvalid();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $admin_id ID do Admin
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($admin_id)
    {
        if (!Yii::$app->user->can('updateAdmin')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $validAdmin = $this->findModel($admin_id);
        $model = new AdminForm($validAdmin->admin_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->update()) {

            //Criar logs
            Yii::info("Editar administrador", 'admin');

            return $this->redirect(['view', 'admin_id' => $model->admin_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $admin_id ID do Admin
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($admin_id)
    {
        if (!Yii::$app->user->can('deleteAdmin')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $this->findModel($admin_id)->delete();

        //Criar logs
        Yii::info("Eliminar administrador", 'admin');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $admin_id ID do Admin
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($admin_id)
    {
        if (($model = Admin::findOne(['admin_id' => $admin_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

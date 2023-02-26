<?php

namespace backend\controllers;

use backend\models\EmployeeForm;
use common\models\Employee;
use common\models\EmployeeSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
                    'class' => VerbFilter::class,
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
                            'roles' => ['viewEmployee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewEmployee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createEmployee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateEmployee'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewEmployee')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param int $employee_id Employee ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $employee_id)
    {
        if (!Yii::$app->user->can('viewEmployee')) new ForbiddenHttpException("Não tem acesso a esta página.");

        return $this->render('view', [
            'model' => $this->findModel($employee_id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createEmployee')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = new EmployeeForm();

        if ($this->request->isPost && $model->load(Yii::$app->request->post()) && $model->create()) {

            //Criar logs
            Yii::info("Criar empregado", 'employee');

            return $this->redirect(['view', 'employee_id' => $model->employee_id]);
        } else {
            $model->resetAttributesOnInvalid();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $employee_id Employee ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($employee_id)
    {
        if (!Yii::$app->user->can('updateEmployee')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $validEmployee = $this->findModel($employee_id);
        $model = new EmployeeForm($validEmployee->employee_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->update()) {

            //Criar logs
            Yii::info("Editar empregado", 'employee');

            return $this->redirect(['view', 'employee_id' => $model->employee_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $employee_id Employee ID
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($employee_id)
    {
        if (($model = Employee::findOne(['employee_id' => $employee_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

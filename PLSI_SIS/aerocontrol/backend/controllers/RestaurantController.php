<?php

namespace backend\controllers;

use common\models\Restaurant;
use common\models\RestaurantSearch;
use yii\filters\AccessControl;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller
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
                            'roles' => ['viewRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewRestaurant'],
                            'roleParams' => function () {
                                return ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('id')])];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateRestaurant'],
                            'roleParams' => function () {
                                return ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('id')])];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteRestaurant'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete-logo'],
                            'roles' => ['deleteRestaurantLogo'],
                            'roleParams' => function () {
                                return ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('id')])];
                            },
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Restaurant models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewRestaurant')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->can('viewRestaurant', ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('id')])])) new ForbiddenHttpException("Não tem acesso a esta página.");

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createRestaurant')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = new Restaurant();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {

                    //Criar logs
                    Yii::info("Criar restaurante", 'restaurant');

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Restaurant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('updateRestaurant', ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('id')])])) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            //Criar logs
            Yii::info("Editar restaurante", 'restaurant');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Restaurant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('deleteRestaurant')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $this->findModel($id)->delete();

        //Criar logs
        Yii::info("Eliminar restaurante", 'restaurant');


        return $this->redirect(['index']);
    }


    //remover logo do restaurante
    public function actionDeleteLogo($id)
    {
        if (!Yii::$app->user->can('deleteRestaurantLogo', ['restaurant' => Restaurant::findOne(['id' => Yii::$app->request->get('id')])])) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = $this->findModel($id);
        if ($model->deleteLogo())
            $model->logo = null;

        if (!$model->save()){
            Yii::$app->session->setFlash('error', 'Algo correu mal ao efetuar a operação!');
        }else{
            //Criar logs
            Yii::info("Eliminar imagem do restaurante", 'restaurant');
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Restaurant::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

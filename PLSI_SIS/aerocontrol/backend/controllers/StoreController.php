<?php

namespace backend\controllers;

use common\models\Store;
use common\models\StoreSearch;
use yii\filters\AccessControl;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * StoreController implements the CRUD actions for Store model.
 */
class StoreController extends Controller
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
                            'roles' => ['viewStore'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewStore'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createStore'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateStore'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteStore'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete-logo'],
                            'roles' => ['deleteStoreLogo'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Store models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewStore')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $searchModel = new StoreSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Store model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->can('viewStore')) new ForbiddenHttpException("Não tem acesso a esta página.");

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Store model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createStore')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = new Store();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {

                    //Criar logs
                    Yii::info("Criar loja", 'store');

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
     * Updates an existing Store model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('updateStore')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            //Criar logs
            Yii::info("Editar loja", 'store');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Store model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('deleteStore')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $this->findModel($id)->delete();

        //Criar logs
        Yii::info("Eliminar loja", 'store');

        return $this->redirect(['index']);
    }


    //remover logo da loja
    public function actionDeleteLogo($id)
    {
        if (!Yii::$app->user->can('deleteStoreLogo')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = $this->findModel($id);
        if ($model->deleteLogo())
            $model->logo = null;

        if (!$model->save()){
            Yii::$app->session->setFlash('error', 'Algo correu mal ao efetuar a operação!');
        }else{
            //Criar logs
            Yii::info("Eliminar imagem da loja", 'store');
        }
           
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Store model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Store the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Store::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

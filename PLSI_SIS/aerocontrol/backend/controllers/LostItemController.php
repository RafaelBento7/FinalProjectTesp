<?php

namespace backend\controllers;

use common\models\LostItem;
use common\models\LostItemSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LostItemController implements the CRUD actions for LostItem model.
 */
class LostItemController extends Controller
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
                            'roles' => ['viewLostItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewLostItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createLostItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['updateLostItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteLostItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete-logo'],
                            'roles' => ['deleteLostItemLogo'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all LostItem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewLostItem')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $searchModel = new LostItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LostItem model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->can('viewLostItem')) new ForbiddenHttpException("Não tem acesso a esta página.");

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LostItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createLostItem')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = new LostItem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                //Criar logs
                Yii::info("Criar item perdido", 'lostItem');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LostItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('updateLostItem')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            //Criar logs
            Yii::info("Editar item perdido", 'lostItem');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LostItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('deleteLostItem')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $this->findModel($id)->delete();

        //Criar logs
        Yii::info("Eliminar item perdido", 'lostItem');

        return $this->redirect(['index']);
    }

    //remover imagem do lost item
    public function actionDeleteLogo($id)
    {
        if (!Yii::$app->user->can('deleteLostItemLogo')) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = $this->findModel($id);
        if ($model->deleteImage())
            $model->image = null;

        if (!$model->save()){
            Yii::$app->session->setFlash('error', 'Algo correu mal ao efetuar a operação!');
        }
        else{
            //Criar logs
            Yii::info("Eliminar imagem item perdido", 'lostItem');
        }


        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the LostItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LostItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LostItem::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

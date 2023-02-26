<?php

namespace frontend\controllers;

use common\models\base\UserForm;
use common\models\Client;
use common\models\ClientForm;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class AccountController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['profile'],
                            'roles' => ['updateClient'],
                            'roleParams' => function () {
                                return ['user' => User::findOne(['id' => Yii::$app->request->get('id')])];
                            },
                        ],
                    ],
                ]
            ]
        );
    }

    public function actionProfile($id)
    {
        if (!Yii::$app->user->can('updateClient', ['user' => User::findOne(['id' => Yii::$app->request->get('id')])])) new ForbiddenHttpException("Não tem acesso a esta página.");

        $validUser = $this->findModel($id);
        $model = new ClientForm($validUser->client_id);

        if ($this->request->isPost){
            if($model->load($this->request->post()) && $model->update())
                Yii::$app->session->setFlash('success', 'Dados Guardados com sucesso!');
            else Yii::$app->session->setFlash('failed', 'Ocorreu um erro, dados não foram guardados.');

        }

        return $this->render('edit-account', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $client_id ID do Cliente
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($client_id)
    {
        if (($model = Client::findOne(['client_id' => $client_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
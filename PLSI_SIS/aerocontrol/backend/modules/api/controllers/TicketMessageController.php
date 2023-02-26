<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomQueryAuth;
use common\models\SupportTicket;
use common\models\TicketMessage;
use common\models\TicketMessageForm;
use common\models\User;
use Yii;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnprocessableEntityHttpException;

class TicketMessageController extends ActiveController
{

    public $modelClass = 'common\models\TicketMessage';
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomQueryAuth::class,
        ];
        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'create' => ['POST'],
        ];
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if ($action === "create") {
            if (Yii::$app->params['id'] != $params['sender_id'] || Yii::$app->params['id'] != $params['client_id'])
                throw new ForbiddenHttpException('Proibido');
        }
    }

    public function actionCreate()
    {
        if (empty(Yii::$app->request->post())) throw new BadRequestHttpException('O body do request está vazio!');

        $model = new TicketMessageForm();
        $model->sender_id = $this->request->post('sender_id');
        $model->support_ticket_id = $this->request->post('support_ticket_id');

        $ticket = SupportTicket::findOne($model->support_ticket_id);

        $modelClass = $this->modelClass;
        $this->checkAccess('create', $modelClass, [
            'sender_id' => $model->sender_id,
            'client_id' => $ticket->client_id,
        ]);

        if ($model->load($this->request->post(), '') && $model->validate()) {
            if ($model->create(null)) {
                return $model;
            } else throw new ServerErrorHttpException("Não foi possivel enviar a mensagem.");
        } else throw new UnprocessableEntityHttpException(Json::encode($model->getErrors()));
    }
}

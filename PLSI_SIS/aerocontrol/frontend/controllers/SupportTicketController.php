<?php

namespace frontend\controllers;

use common\models\Client;
use common\models\SupportTicket;
use common\models\TicketMessage;
use common\models\User;
use common\models\SupportTicketForm;
use common\models\TicketMessageForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * SupportTicketController implements the CRUD actions for SupportTicket model.
 */
class SupportTicketController extends Controller
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
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['createSupportTicket'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewSupportTicket'],
                            'roleParams' => function () {
                                return ['supportTicket' => SupportTicket::findOne(['client_id' => Yii::$app->user->id])];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['finish'],
                            'roles' => ['updateSupportTicket'],
                            'roleParams' => function () {
                                return ['supportTicket' => SupportTicket::findOne(['client_id' => Yii::$app->user->id])];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['conclude-ticket'],
                            'roles' => ['updateSupportTicket'],
                            'roleParams' => function () {
                                return ['supportTicket' => SupportTicket::findOne(['client_id' => Yii::$app->user->id])];
                            },
                        ]
                    ],
                ]
            ]
        );
    }


    /**
     * Lists all SupportTicket models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new SupportTicketForm();
        $client = Client::findOne(['client_id' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => SupportTicket::find()->where(['client_id' => $client->client_id])->orderBy('state ASC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        if (!Yii::$app->user->can('createSupportTicket')) new ForbiddenHttpException("Não tem acesso a esta página.");


        $model = new SupportTicketForm();

        $client = Client::findOne(['client_id' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => SupportTicket::find()->where(['client_id' => $client->client_id])->orderBy('state ASC'),
        ]);

        $model->client_id = $client->client_id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create()) {
                // Dá reset aos inputs do modal na pagina
                $model = new SupportTicketForm();
            }
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionView($ticket_id)
    {
        $model = new TicketMessageForm();

        $user = User::findOne(['id' => Yii::$app->user->getId()]);

        $dataProvider = new ActiveDataProvider([
            'query' => TicketMessage::find()->where(['support_ticket_id' => $ticket_id])->orderBy('id ASC'),
        ]);

        $model->sender_id = $user->id;
        $model->support_ticket_id = $ticket_id;

        $ticket = SupportTicket::findOne($ticket_id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create($ticket)) {
                $this->refresh();
            }
        }

        return $this->render('view', [
            'ticket' => $ticket,
            'client_id' => $ticket->client_id,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionConcludeTicket($ticket_id)
    {
        $model = SupportTicket::findOne($ticket_id);

        if ($model->concludeSupportTicket())
            return $this->redirect(['index']);
        else
            Yii::$app->session->setFlash("error", "Não foi possivel concluir o ticket de suporte, tente novamente mais tarde.");
    }
}

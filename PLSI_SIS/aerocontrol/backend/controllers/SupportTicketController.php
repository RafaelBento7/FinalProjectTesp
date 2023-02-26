<?php

namespace backend\controllers;

use common\models\TicketMessageForm;
use common\models\LostItem;
use common\models\LostItemSearch;
use common\models\SupportTicketSearch;
use common\models\SupportTicket;
use common\models\TicketItem;
use common\models\TicketMessage;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
                            'roles' => ['viewSupportTicket'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['viewMessage', 'createMessage', 'viewSupportTicket'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['item'],
                            'roles' => ['viewTicketItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['add-item-to-ticket'],
                            'roles' => ['addTicketItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['remove-item-from-ticket'],
                            'roles' => ['deleteTicketItem'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['conclude-ticket'],
                            'roles' => ['updateSupportTicket'],
                        ]
                    ],
                ],
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
        $searchModel = new SupportTicketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SupportTicket model.
     * @param int $ticket_id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ticket_id)
    {
        $model = new TicketMessageForm();

        $dataProvider = new ActiveDataProvider([
            'query' => TicketMessage::find()->where(['support_ticket_id' => $this->findModel($ticket_id)])->orderBy('id ASC'),
        ]);

        $model->sender_id = Yii::$app->user->getId();
        $model->support_ticket_id = $ticket_id;

        $ticket = $this->findModel($ticket_id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->create($ticket)) {
                $this->refresh();
            }
        }

        return $this->render('view', [
            'supportTicket' => $ticket,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionConcludeTicket($ticket_id)
    {
        $model = $this->findModel($ticket_id);

        if ($model->concludeSupportTicket())
            return $this->redirect(['index']);
        else
            Yii::$app->session->setFlash("error", "Não foi possivel concluir o ticket de suporte, tente novamente mais tarde.");

        return $this->redirect(['view', 'ticket_id' => $ticket_id]);
    }

    public function actionItem($ticket_id)
    {

        $searchModel = new LostItemSearch();

        $ticket = $this->findModel($ticket_id);

        //  Se o ticket tiver item
        //  senão procura todos os LostItems com estado "Perdidos"
        if ($ticket->ticketItems)
            $query = LostItem::find()
                ->select('lost_item.*')
                ->leftJoin("ticket_item", '`ticket_item`.`lost_item_id` = `lost_item`.`id`')
                ->where(['support_ticket_id' => $ticket_id]);
        else $query = LostItem::find()->where(['state' => LostItem::STATE_LOST]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('item', [
            'ticket' => $ticket,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddItemToTicket($ticket_id, $lost_item_id)
    {
        $itemLost = LostItem::findOne($lost_item_id);

        if (SupportTicket::addItemToSupportTicket($ticket_id, $itemLost)) {
            Yii::$app->session->setFlash("success", "O item foi adicionado ao ticket de suporte!");
        } else Yii::$app->session->setFlash("error", "Ocorreu um erro e o item não foi adicionado!");

        return $this->redirect(['view', 'ticket_id' => $ticket_id]);
    }

    public function actionRemoveItemFromTicket($ticket_id, $lost_item_id)
    {

        $ticketItem = TicketItem::findOne(['lost_item_id' => $lost_item_id]);
        $itemLost = LostItem::findOne($lost_item_id);

        if (SupportTicket::removeItemFromSupportTicket($ticketItem, $itemLost)) {
            Yii::$app->session->setFlash("success", "Item removido com sucesso!");
        } else Yii::$app->session->setFlash("error", "Ocorreu um erro e o item não foi removido!");

        return $this->redirect(['view', 'ticket_id' => $ticket_id]);
    }

    /**
     * Finds the SupportTicket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SupportTicket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SupportTicket::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

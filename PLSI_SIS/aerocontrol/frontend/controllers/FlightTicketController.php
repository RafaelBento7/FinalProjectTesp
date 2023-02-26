<?php

namespace frontend\controllers;

use common\models\Client;
use common\models\Flight;
use common\models\FlightTicket;
use common\models\User;
use common\models\FlightReserveForm;
use Yii;
use yii\helpers\Url;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

/**
 * FlightTicketController implements the CRUD actions for FlightTicket model.
 */
class FlightTicketController extends Controller
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
                            'roles' => ['createTicket'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['checkin'],
                            'roles' => ['updateTicket'],
                            'roleParams' => function () {
                                return ['ticket' => FlightTicket::findOne(['flight_ticket_id' => Yii::$app->request->get('flight_ticket_id')])];
                            },
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteTicket'],
                            'roleParams' => function () {
                                return ['ticket' => FlightTicket::findOne(['flight_ticket_id' => Yii::$app->request->get('flight_ticket_id')])];
                            },
                        ],
                    ],
                ]
            ]
        );
    }

    /**
     * Lists all FlightTicket models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $client = Client::findOne(['client_id' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => FlightTicket::find()->where(['client_id' => $client->client_id])->orderBy('purchase_date DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new FlightTicket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($flightGoId, $flightBackId = null)
    {

        // Vai buscar o número de passageiros através da queryParams
        try {
            $numPassengers = Yii::$app->request->queryParams['FlightForm']['passengers'];
        } catch (ErrorException $e) {
            throw new ForbiddenHttpException("Ocorreu um erro, tente novamente mais tarde!");
        }


        $flightGo = Flight::findOne($flightGoId);
        if ($flightGo && $flightGo->passengers_left < $numPassengers) {
            throw new ForbiddenHttpException("O número de passageiros é superior aos passageiros restantes do voo de ida!");
        }

        if ($flightBackId) {
            $flightBack = Flight::findOne($flightBackId);
            if ($flightBack && $flightBack->passengers_left < $numPassengers) {
                throw new ForbiddenHttpException("O número de passageiros é superior aos passageiros restantes do voo de volta!");
            }
        } else $flightBack = null;

        $model = new FlightReserveForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                if ($model->create($numPassengers, $flightGo, $flightBack)) {
                    Yii::$app->session->setFlash("success", "Comprou o bilhete com sucesso. O pagamento vai ser processado!");
                    $userLogged = User::findOne(Yii::$app->user->id);
                    $model->sendEmail($userLogged, true);
                    if ($flightBack)
                        $model->sendEmail($userLogged, false);
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash("error", "Ocorreu um erro ao comprar o bilhete.");
                }
            }
        } else {
            $model->loadDefaultValues();
            if ($model->payment_method == null)
                throw new ServerErrorHttpException("Não existem métodos de pagamento disponivel, tente mais tarde!");
        }

        return $this->render('flight-reserve', [
            'flightGoId' => $flightGoId,
            'flightBackId' => $flightBackId,
            'numPassengers' => $numPassengers,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FlightTicket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $flight_ticket_id ID do Bilhete de Voo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCheckin($flight_ticket_id)
    {
        if (!Yii::$app->user->can('updateTicket', ['ticket' => FlightTicket::findOne(['flight_ticket_id' => Yii::$app->request->get('flight_ticket_id')])])) new ForbiddenHttpException("Não tem acesso a esta página.");

        $model = $this->findModel($flight_ticket_id);
        $model->checkin = true;
        if ($this->request->isPost && $model->save()) {
            Yii::$app->session->setFlash('success', 'O checkin foi efetuado!');
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('error', 'Não foi possivel efetuar o checkin!');
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing FlightTicket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $flight_ticket_id ID do Bilhete de Voo
     * @return \yii\web\Response
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ServerErrorHttpException if can't delete
     * @throws \Throwable
     */
    public function actionDelete($flight_ticket_id)
    {
        if (!Yii::$app->user->can('deleteTicket', ['ticket' => FlightTicket::findOne(['flight_ticket_id' => Yii::$app->request->get('flight_ticket_id')])])) new ForbiddenHttpException("Não tem acesso a esta página.");

        $flightTicket = $this->findModel($flight_ticket_id);


        if ($flightTicket->deleteTicket()) {
            Yii::$app->session->setFlash('success', 'O seu bilhete foi cancelado, será reembolsado em breve!');
            return $this->redirect(['index']);
            // Se o ticket não consegiu dar delete então verifica se foi um custom error
        } else if (!empty($flightTicket->getErrors('customErrorMessage')))
            Yii::$app->session->setFlash('error', $flightTicket->getErrors('customErrorMessage')[0]);
        else throw new ServerErrorHttpException("Ocorreu um erro ao cancelar.");

        return $this->redirect(['index']);
    }

    /**
     * Finds the FlightTicket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $flight_ticket_id ID do Bilhete de Voo
     * @return FlightTicket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($flight_ticket_id)
    {
        if (($model = FlightTicket::findOne(['flight_ticket_id' => $flight_ticket_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('O bilhete não existe.');
    }
}

<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomQueryAuth;
use common\models\Flight;
use common\models\User;
use common\models\FlightReserveForm;
use Yii;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnprocessableEntityHttpException;

class FlightTicketController extends ActiveController
{
    public $modelClass = 'common\models\FlightTicket';

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

    /*
         Com QueryParamAuth
    */

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
            'my-tickets' => ['GET'],
        ];
    }

    public function checkAccess($action, $model = null, $params = [])
    {

        if ($action === "delete" || $action === "update") {

            $flightTicket = $model->find()
                ->where(['client_id' => Yii::$app->params['id']])
                ->andWhere(['flight_ticket_id' => $params['ticket_id']])
                ->one();


            if (!$flightTicket)
                throw new ForbiddenHttpException('Proibido');
        } else if ($action === "my-tickets") {

            if (!isset(Yii::$app->authManager->getRolesByUser($model->id)['client']))
                throw new ForbiddenHttpException('Proibido');
        }
    }

    public function actionDelete($id)
    {
        $model = new $this->modelClass;

        $this->checkAccess('delete', $model, ['ticket_id' => $id]);

        $flightTicket = $model->findOne(['flight_ticket_id' => $id]);

        if ($flightTicket) {
            if ($flightTicket->deleteTicket()) {
                return [
                    'message' => 'Bilhete cancelado com successo',
                ];
            } else if (!empty($flightTicket->getErrors('customErrorMessage')))
                throw new ForbiddenHttpException($flightTicket->getErrors('customErrorMessage')[0]);
            else
                throw new ServerErrorHttpException("Ocorreu um erro ao cancelar");
        } else
            throw new NotFoundHttpException("Bilhete não encontrado");
    }

    public function actionMyTickets()
    {
        $user = User::findOne(Yii::$app->params['id']);
        if (!$user)
            throw new NotFoundHttpException();

        $this->checkAccess('my-tickets', $user);
        $i = 0;
        $array = array();

        foreach ($user->client->flightTickets as $flightTicket) {
            $array[$i]['id'] = $flightTicket->flight_ticket_id;
            $array[$i]['payment_method'] = $flightTicket->paymentMethod->name;
            $array[$i]['flightState'] = $flightTicket->flight->state;
            $array[$i]['flightOrigin'] = $flightTicket->flight->originAirport->city;
            $array[$i]['flightArrival'] = $flightTicket->flight->arrivalAirport->city;
            $array[$i]['flightOriginTime'] = date('H:i', strtotime($flightTicket->flight->estimated_departure_date));
            $array[$i]['flightArrivalTime'] = date('H:i', strtotime($flightTicket->flight->estimated_arrival_date));
            $array[$i]['terminal'] = $flightTicket->flight->terminal;
            $array[$i]['originalPrice'] = $flightTicket->flight->price;
            $array[$i]['paidPrice'] = $flightTicket->price;
            $array[$i]['flightDate'] = date('d-m-Y', strtotime($flightTicket->flight->estimated_departure_date));;
            $array[$i]['purchaseDate'] = $flightTicket->purchase_date;
            $array[$i]['distance'] = $flightTicket->flight->distance;
            $array[$i]['checkin'] = $flightTicket->checkin;
            $array[$i]['passengers'] = array();
            $j = 0;
            foreach ($flightTicket->passengers as $passenger) {
                $array[$i]['passengers'][$j]['id'] = $passenger->id;
                $array[$i]['passengers'][$j]['name'] = $passenger->name;
                $array[$i]['passengers'][$j]['gender'] = $passenger->gender;
                $array[$i]['passengers'][$j]['seat'] = $passenger->seat;
                $array[$i]['passengers'][$j]['extra_baggage'] = $passenger->extra_baggage;
                $j++;
            }
            $i++;
        }

        return $array;
    }

    public function actionUpdate($id)
    {
        $model = new $this->modelClass;
        $this->checkAccess('update', $model, ['ticket_id' => $id]);

        if (empty(Yii::$app->request->post())) throw new BadRequestHttpException('O body do request está vazio!');

        $checkIn = Yii::$app->request->post('checkin');

        $flightTicket = $model::findOne(['flight_ticket_id' => $id]);
        if ($flightTicket) {
            $flightTicket->checkin = $checkIn;
            if ($flightTicket->validate()) {
                if ($flightTicket->save()) {
                    return [
                        'message' => 'Check-in efetuado',
                    ];
                } else throw new ServerErrorHttpException("Ocorreu um erro ao efetuar a gravação");
            } else throw new UnprocessableEntityHttpException($flightTicket->getErrors('checkin')[0]);
        } else throw new NotFoundHttpException("Bilhete não encontrado");
    }

    public function actionCreate()
    {
        if (empty(Yii::$app->request->post())) throw new BadRequestHttpException('O body do request está vazio!');

        $model = new FlightReserveForm();
        $model->read_terms = 1;

        $flightGo = Flight::findOne($this->request->post("flightGo_id"));
        $flightBack = Flight::findOne($this->request->post("flightBack_id"));
        $numPassengers = $this->request->post("numPassengers");

        if ($model->load($this->request->post(), '') && $model->validate()) {
            if ($model->create($numPassengers, $flightGo, $flightBack)) {
                $userLogged = User::findOne(Yii::$app->params['id']);
                $model->sendEmail($userLogged, true);
                if ($flightBack)
                    $model->sendEmail($userLogged, false);
                return ['message' => 'success'];
            } else throw new ServerErrorHttpException("Ocorreu um erro ao comprar o bilhete.");
        } else throw new UnprocessableEntityHttpException(Json::encode($model->getErrors()));
    }
}

<?php

namespace common\models;

use common\models\base\UserForm;
use common\models\User;
use common\models\Client;
use Yii;
use yii\base\ErrorException;

class ClientForm extends UserForm
{
    // Client
    public $client_id;


    public function __construct($client_id = null, $config = [])
    {
        // Se existir um client_id então dá setup do correspondente Client com este form
        if ($client_id !== null) {
            $this->setupClientOnForm($client_id);
        }

        // Se existir um client_id então dá setup do correspondente User com este form
        parent::__construct($client_id, $config);
    }

    /**
     * Creates new client
     * @return bool
     */
    public function create()
    {
        $transaction = Client::getDb()->beginTransaction();
        try {
            if (!parent::create())
                return null;

            // Criar o client
            $client = new Client();
            $client->client_id = $this->user_id;
            if (!$client->save())
                throw new ErrorException();


            $auth = Yii::$app->authManager;
            $clientRole = $auth->getRole('client');
            $auth->assign($clientRole, $client->client_id);

            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            return null;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }


        return true;
    }

    /**
     * Updates client
     * @return bool
     */
    public function update()
    {
        // Updates user
        if (!parent::update())
            return null;


        return true;
    }


    /**
     * Setups client on form if you have the ID
     *
     * @param int $id Client ID
     */
    protected function setupClientOnForm($client_id)
    {
        $this->client_id = $client_id;
    }
}

<?php

namespace console\rules;


use common\models\User;
use yii\rbac\Item;
use yii\rbac\Rule;

class ClientRule extends Rule
{
    public $name = 'isClient';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['ticket'])) {
            $client = User::findOne($params['ticket']->client_id);
            return $client->id == $user;
        }
        if (isset($params['user'])) {
            return $params['user']->id == $user;
        }
        if (isset($params['supportTicket'])) {
            $client = User::findOne($params['supportTicket']->client_id);
            return $client->id == $user;
        }
        return false;
    }
}

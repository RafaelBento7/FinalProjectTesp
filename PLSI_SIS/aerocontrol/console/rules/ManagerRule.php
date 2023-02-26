<?php
namespace console\rules;

//use common\models\Restaurant;
use common\models\Manager;
use common\models\Restaurant;
use common\models\User;
use http\Exception;
use Yii;
use yii\rbac\Item;
use yii\rbac\Rule;
use function PHPUnit\Framework\throwException;

class ManagerRule extends Rule
{
    public $name = 'isManager';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['restaurant']))
        {
            foreach ($params['restaurant']->managers as $manager)
                if($manager->manager_id == $user)
                    return true;
        }
        return false;
    }
}
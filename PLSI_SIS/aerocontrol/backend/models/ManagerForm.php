<?php

namespace backend\models;

use common\models\base\UserForm;
use common\models\Manager;
use common\models\User;
use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;

class ManagerForm extends UserForm
{
    // Manager
    public $manager_id;

    public $restaurant_id;

    private $_manager;

    public function __construct($manager_id = null, $config = [])
    {
        // Se existir um $manager_id então dá setup do correspondente Manager com este form
        if ($manager_id !== null) {
            $this->setupManagerOnForm($manager_id);
        }

        // Se existir um $manager_id então dá setup do correspondente User com este form
        parent::__construct($manager_id, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();
        $newRules =[
            ['restaurant_id', 'required', 'message' => "É necessário escolher um restaurante."],
        ];
        return ArrayHelper::merge($rules, $newRules);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();

        $newAttributeLabels =
            [
                'restaurant_id' => 'Restaurante'
            ];

        return ArrayHelper::merge($attributeLabels, $newAttributeLabels);
    }

    /**
     * Creates new manager
     * @return bool
     */
    public function create()
    {
        $transaction = Manager::getDb()->beginTransaction();
        try {
            if (!parent::create())
                return null;

            // Criar o Manager
            $manager = new Manager();
            $manager->manager_id = $this->user_id;
            $manager->setAttributes($this->getManagerDetails(), false);
            if (!$manager->save())
                throw new ErrorException();


            $this->manager_id = $manager->manager_id;

            $auth = Yii::$app->authManager;
            $managerRole = $auth->getRole('manager');
            $auth->assign($managerRole, $manager->manager_id);

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
     * Updates manager
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
     * Setups manager on form if you have the ID
     *
     * @param int $id Manager ID
     */
    protected function setupManagerOnForm($manager_id)
    {
        $this->manager_id = $manager_id;
        $manager = $this->getManager();
        $this->setAttributes($manager->getAttributes());
    }

    /**
     * Gets employee by [[employee_id]]
     *
     * @return Manager|null
     */
    protected function getManager()
    {
        if ($this->_manager === null) {
            $this->_manager = Manager::findOne($this->manager_id);
        }

        return $this->_manager;
    }

    /**
     * Gets all the employee details.
     * @return array
     */
    private function getManagerDetails()
    {
        return [
            'restaurant_id' => $this->restaurant_id,
        ];
    }
}

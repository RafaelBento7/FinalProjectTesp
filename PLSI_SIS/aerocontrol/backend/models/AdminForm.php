<?php

namespace backend\models;

use common\models\Admin;
use common\models\base\UserForm;
use common\models\User;
use Yii;
use yii\base\ErrorException;

class AdminForm extends UserForm
{
    // Admin
    public $admin_id;

    private $_admin;

    public function __construct($admin_id = null, $config = [])
    {
        // Se existir um admin_id então dá setup do correspondente admin com este form
        if ($admin_id !== null) {
            $this->setupAdminOnForm($admin_id);
        }

        // Se existir um admin_id então dá setup do correspondente User com este form
        parent::__construct($admin_id, $config);
    }

    /**
     * Creates new admin
     * @return bool
     */
    public function create()
    {
        $transaction = Admin::getDb()->beginTransaction();
        try {
            if (!parent::create())
                return null;

            // Criar o admin
            $admin = new Admin();
            $admin->admin_id = $this->user_id;
            if (!$admin->save())
                throw new ErrorException();

            $this->admin_id = $admin->admin_id;

            $auth = Yii::$app->authManager;
            $adminRole = $auth->getRole('admin');
            $auth->assign($adminRole, $admin->admin_id);

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
     * Updates admin
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
     * Setups admin on form if you have the ID
     *
     * @param int $id Admin ID
     */
    protected function setupAdminOnForm($admin_id)
    {
        $this->admin_id = $admin_id;
        $admin = $this->getAdmin();
        $this->setAttributes($admin->getAttributes());
    }

    /**
     * Gets employee by [[employee_id]]
     *
     * @return Admin|null
     */
    protected function getAdmin()
    {
        if ($this->_admin === null) {
            $this->_admin = Admin::findOne($this->admin_id);
        }

        return $this->_admin;
    }
}

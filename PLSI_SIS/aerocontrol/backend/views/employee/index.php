<?php

use common\models\Employee;
use common\models\EmployeeFunction;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Trabalhadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">
    <p>
        <?= Html::a('Criar trabalhador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => "Nenhum resultado encontrado!",
        'columns' => [
            'employee_id',
            [
                'label' => 'Nº Empregado',
                'attribute' => 'num_emp',
                'value' => function ($model) {
                    return $model->num_emp;
                }
            ],
            [
                'label' => 'Username',
                'attribute' => 'user_username',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            [
                'label' => 'Nome',
                'attribute' => 'user_fullname',
                'value' => function ($model) {
                    return $model->user->getFullName();
                }
            ],
            [
                'label' => 'Email',
                'attribute' => 'user_email',
                'value' => function ($model) {
                    return $model->user->email;
                }
            ],
            [
                'label' => 'Telefone',
                'attribute' => 'user_phone',
                'value' => function ($model) {
                    return $model->user->phone_country_code . " " . $model->user->phone;
                }
            ],
            [
                'label' => 'Nº Contribuinte',
                'attribute' => 'tin',
                'value' => function ($model) {
                    return $model->tin;
                }
            ],
            [
                'label' => 'Função',
                'attribute' => 'function_id',
                'value' => function ($model) {
                    return $model->function->name;
                },
                'filter' => EmployeeFunction::getPossibleEmployeeFunctionsForDropdowns()
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {view}',
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'employee_id' => $model->employee_id]);
                }
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
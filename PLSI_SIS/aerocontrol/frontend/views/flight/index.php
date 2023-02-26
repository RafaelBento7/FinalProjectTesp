<?php
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \common\models\FlightForm $model */
/** @var \common\models\Airport[] $airports */

$this->title = "Voos";
?>

<div class="container" data-type="small-md">
    <section class="padding-block-700">
        <h1 class="fs-500 fw-semi-bold text-align-center">Reserve agora o seu voo</h1>
        <?= $this->render('_form', [
            'airports' => $airports,
            'model' => $model,
        ]) ?>
    </section>
</div>
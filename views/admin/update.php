<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Редактироавние заказа: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Админ-панель', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = 'Редактироавние заказа';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

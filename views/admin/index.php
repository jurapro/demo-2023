<?php

use app\models\Order;
use app\models\Status;
use yii\bootstrap5\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\SearchOrder $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
echo Nav::widget([
    'options' => ['class' => 'navbar navbar-expand-lg navbar-light bg-light'],
    'items' => [
        ['label' => 'Управление категориями', 'url' => ['category/index']],
        ['label' => 'Управление товарами', 'url' => ['product/index']],
    ]
]);
?>
<div class="order-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            [
                'label' => 'Статус',
                'attribute' => 'status_id',
                'filter' => ArrayHelper::map(Status::find()->asArray()->all(), 'id', 'name'),
                'value' => 'status.name'
            ],
            [
                'label' => 'Количество товаров',
                'value' => function ($data) {
                    return count($data->productOrders);
                }
            ],
            [
                'label' => 'ФИО заказчика',
                'value' => function ($data) {
                    return $data->user->name . ' ' . $data->user->surname . ' ' . $data->user->patronymic;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                        return $model->status->code === 'new';
                    },
                ]
            ],
        ],
    ]); ?>
</div>

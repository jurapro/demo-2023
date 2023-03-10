<?php

use app\models\Cart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="info alert alert-primary"></div>
    <?php Pjax::begin(['id' => 'cart']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'product.name',
            'count',
            [
                'label' => 'Добавить в корзину',
                'format' => 'raw',
                'value' => function ($data) {
                    return "<button onclick='addCart($data->product_id)' class='btn btn-success'> + </button>";
                },

            ],
            [
                'label' => 'Удалить',
                'format' => 'raw',
                'value' => function ($data) {
                    return "<button onclick='removeCart($data->product_id)' class='btn btn-success'> - </button>";
                },

            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>

    <div class="row g-2">
        <div class="col-auto">
            <?= Html::input('password', 'password', '',
                ['class' => 'form-control password']) ?>
        </div>
        <div class="col-auto">
            <?= Html::button('Оформить заказ', [
                'class' => 'btn btn-success',
                'onclick' => 'byOrder()'
            ]) ?>
        </div>
    </div>

</div>

<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Каталог товаров';
$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="info"></div>
    <?php Pjax::begin(['id' => 'cart']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            'name',
            'price',
            [
                'label' => 'Изображение',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img($data->file, ['width' => 200]);
                }
            ],
            [
                'label' => 'Добавить в корзину',
                'format' => 'raw',
                'value' => function ($data) {
                    return "<button onclick='addCart($data->id)' class='btn btn-success'>Добавить в корзину</button>";
                },
                'visible' => Yii::$app->user->identity
            ],
            'count',
        ],
    ]); ?>
    <?php Pjax::end() ?></div>

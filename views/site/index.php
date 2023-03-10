<?php

/** @var yii\web\View $this */

use app\models\Category;
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

$this->title = 'Каталог товаров';
$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="info alert alert-primary"></div>
    <?php
    $items = Category::find()
        ->select(['name'])
        ->indexBy('id')
        ->column();
    ?>
    <?= Html::dropDownList('list', null, $items,
        [
            'prompt' => 'Выберите категорию',
            'onchange' => 'getProduct(this.options[this.selectedIndex].value)'
        ]) ?>

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
            [
                'label' => '',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a('Подробнее', ['site/view', 'id' => $data->id]);
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?></div>

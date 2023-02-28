<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = "Карточка товара: " . $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->registerJsFile(
    '@web/js/main.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="order-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="info"></div>
    <?php Pjax::begin(['id' => 'cart']) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'name',
            'price',
            'year',
            'model',
            'country',
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
    ]) ?>
    <?php Pjax::end() ?>
</div>

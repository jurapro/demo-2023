<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Где нас найти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::img("@web/img/map.png", ['width' => 400]); ?>
    <?= Html::tag('p', 'Адрес: г. Томск') ?>
    <?= Html::tag('p', 'Номер телефона: 9-11') ?>
    <?= Html::tag('p', 'Email: admin@admin.ru') ?>

</div>

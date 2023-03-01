<?php

/** @var yii\web\View $this */

use app\models\Product;
use yii\helpers\Html;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title; ?>
<div class="site-about">
    <?= Html::img("@web/img/logo.png", ['width' => 100]); ?>
    <?= Html::tag('h3', 'Наш девиз: За все хорошее против всего плохого') ?>
    <?= Html::tag('h3', 'Новинки компании') ?>
    <?php
    $products = Product::find()->where(['>', 'count', 0])
        ->orderBy(['date' => SORT_DESC,])
        ->limit(5)
        ->all();
    ?>
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($products as $product) { ?>
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="<?= $product->file ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= $product->name ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>

</div>

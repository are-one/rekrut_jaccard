<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lowongan */

$this->title = 'Buat Lowongan';
$this->params['breadcrumbs'][] = ['label' => 'Lowongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lowongan-create">

    <h1 class="mb-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
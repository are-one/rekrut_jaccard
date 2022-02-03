<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Lowongan */

$this->title = 'Create Lowongan';
$this->params['breadcrumbs'][] = ['label' => 'Lowongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lowongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

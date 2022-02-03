<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SoalInterview */

$this->title = 'Update Soal Interview: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Soal Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soal-interview-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PilihanJawaban */

$this->title = 'Buat Pilihan Jawaban: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pilihan Jawabans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'soal_interview_id' => $model->soal_interview_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pilihan-jawaban-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
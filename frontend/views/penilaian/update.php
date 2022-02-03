<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Penilaian */

$this->title = 'Update Penilaian: ' . $model->interview_id;
$this->params['breadcrumbs'][] = ['label' => 'Penilaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->interview_id, 'url' => ['view', 'interview_id' => $model->interview_id, 'soal_interview_id' => $model->soal_interview_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penilaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

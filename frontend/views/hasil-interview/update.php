<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\HasilInterview */

$this->title = 'Update Hasil Interview: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hasil Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'interview_id' => $model->interview_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hasil-interview-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Penilaian */

$this->title = $model->interview_id;
$this->params['breadcrumbs'][] = ['label' => 'Penilaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="penilaian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'interview_id' => $model->interview_id, 'soal_interview_id' => $model->soal_interview_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'interview_id' => $model->interview_id, 'soal_interview_id' => $model->soal_interview_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'interview_id',
            'soal_interview_id',
            'nilai',
        ],
    ]) ?>

</div>

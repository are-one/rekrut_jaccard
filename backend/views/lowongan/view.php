<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Lowongan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lowongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lowongan-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?php if($model->hrd_nik == Yii::$app->user->identity->id): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>
        <?= Html::a('<i class="fas fa-arrow-left"></i> Kembali', ['index'], ['class' => 'btn btn-warning float-right']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama_pekerjaan',
            'tgl_publish',
            'tgl_penutupan',
            'deskripsi:ntext',
            'hrdNik.nama_lengkap',
        ],
    ]) ?>

</div>
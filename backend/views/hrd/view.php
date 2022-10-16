<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Hrd */

$this->title = $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Hrds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hrd-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <p>
        <?= Html::a('Update', ['update', 'nik' => $model->nik], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nik' => $model->nik], [
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
            'nik',
            'nama_lengkap',
            'alamat:ntext',
            [
                'attribute' => 'no_hp',
                'value' => function ($model) {
                    if ($model->no_hp) {
                        return $model->no_hp;
                    } else {
                        return "<i>{belum diatur}</i>";
                    }
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'posisi',
                'value' => function ($model) {
                    if ($model->posisi) {
                        return $model->posisi;
                    } else {
                        return "<i>{belum diatur}</i>";
                    }
                },
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>
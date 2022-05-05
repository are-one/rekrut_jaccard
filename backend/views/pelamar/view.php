<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pelamar */

$this->title = $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Pelamars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pelamar-view">

    <h1>Nama : <?= Html::encode($this->title) ?></h1>

    <p>
        <!-- <?= Html::a('Update', ['update', 'nik' => $model->nik], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'nik' => $model->nik], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'nik',
                'label' => 'NIK'
            ],
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat:ntext',
            'no_hp',
            'email:email',
            [
                'attribute' => 'file_cv',
                'value' => function($model)
                {
                    return Html::a('<i class="fas fa-eye"></i> Lihat',['/pelamar/file','id' => $model->file_cv,'j' => "CV"],['target' => '_blank']);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'file_ijazah',
                'value' => function($model)
                {
                    return Html::a('<i class="fas fa-eye"></i> Lihat',['/pelamar/file','id' => $model->file_ijazah,'j' => "Ijazah"],['target' => '_blank']);
                },
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>
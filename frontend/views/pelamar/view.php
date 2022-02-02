<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pelamar */

$this->title = $model->nik;
$this->params['breadcrumbs'][] = ['label' => 'Pelamars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pelamar-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'tempat_lahir',
            'tanggal_lahir',
            'alamat:ntext',
            'no_hp',
            'email:email',
            'file_cv',
            'file_ijazah',
        ],
    ]) ?>

</div>

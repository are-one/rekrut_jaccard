<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\PelamarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pelamars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelamar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pelamar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nik',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat:ntext',
            //'no_hp',
            //'email:email',
            //'file_cv',
            //'file_ijazah',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pelamar $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'nik' => $model->nik]);
                 }
            ],
        ],
    ]); ?>


</div>

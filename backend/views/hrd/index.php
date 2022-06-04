<?php

use backend\models\Hrd;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\HrdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar HRD';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <p>
        <?= Html::a('Tambah HRD', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nik',
            'nama_lengkap',
            'alamat:ntext',
            'no_hp',
            'posisi',
            [
                'class' => ActionColumn::className(),
                'visibleButtons' => [],
                'urlCreator' => function ($action, Hrd $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'nik' => $model->nik]);
                }
            ],
        ],
    ]); ?>


</div>
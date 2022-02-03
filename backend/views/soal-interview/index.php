<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SoalInterviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soal Interviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-interview-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Soal Interview', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'soal:ntext',
            'jawaban',
            'kategori',
            'hrd_nik',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SoalInterview $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

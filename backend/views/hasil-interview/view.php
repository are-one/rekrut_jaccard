<?php

use backend\models\Interview;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\HasilInterview */

$this->title = $modelLowongan->id;
$this->params['breadcrumbs'][] = ['label' => 'Hasil Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php if (Yii::$app->session->hasFlash('success')) : ?>
<div class="alert alert-success">
    <?= Yii::$app->session->getFlash("success") ?>
</div>
<?php endif; ?>

<div class="hasil-interview-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?php // Html::a('Update', ['update', 'id' => $model->id, 'interview_id' => $model->interview_id], ['class' => 'btn btn-primary']) 
        ?>
        <?php // Html::a('Delete', ['delete', 'id' => $model->id, 'interview_id' => $model->interview_id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ]) 
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $modelLowongan,
        'attributes' => [
            [
                'attribute' => 'nama_pekerjaan',
                'captionOptions' => ['style' => 'width:25%'],
            ],
            'deskripsi:ntext',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'headerRowOptions' => ['class' => 'table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'pelamar_nik',
                'label' => 'Pelamar',
                'value' => function ($model) {
                    $text = "<b class='text-dark'>" . $model->pelamarNik->nama_lengkap . "</b><br><i class='text-muted'>" . $model->pelamar_nik . "</i>";
                    return $text;
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Nilai Interview',
                'headerOptions' => ['style' => 'width:25%'],
                'value' => function ($model) {
                    if ($model->getHasilInterviews()->exists()) {
                        return $model->hasilInterviews[0]->hasil;
                    } else {
                        return Html::tag('span', 'Belum ada nilai', ['class' => 'badge badge-info']);
                    }
                },
                'format' => 'raw'
            ],

            [
                'label' => 'Keterangan',
                'headerOptions' => ['style' => 'width:25%'],
                'value' => function ($model) {
                    if ($model->getHasilInterviews()->exists()) {
                        return $model->hasilInterviews[0]->keterangan;
                    } else {
                        return Html::tag('span', 'Belum ada keterangan', ['class' => 'badge badge-info']);
                    }
                },
                'format' => 'raw'
            ],

            // 'pelamar_nik',
            [
                'class' => ActionColumn::class,
                'header' => 'Aksi',
                'urlCreator' => function ($action, Interview $model, $key, $index, $column) use ($modelLowongan) {
                    return Url::toRoute([$action, 'lowongan_id'=> $modelLowongan->id, 'interview_id' => $model->id]);
                },
                'template' => '{delete}'
            ],
        ],
    ]); ?>

</div>
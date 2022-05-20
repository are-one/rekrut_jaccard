<?php

use backend\models\Interview;
use backend\models\Penilaian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\InterviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal & Soal Interview';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2><small><?= Html::encode($this->title) ?></small></h2>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive-sm">
                    <!-- <p>
        <?php Html::a('Create Interview', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'headerRowOptions' => ['class' => 'table-bordered'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            [
                                'attribute' => 'lowongan_id',
                                'label' => 'Lowongan',
                                'value' => function ($model) {
                                    return $model->lowongan->nama_pekerjaan;
                                }
                            ],
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
                                'attribute' => 'tanggal_interview',
                                'label' => 'Jadwal Interview / Tes',
                                'headerOptions' => ['style' => 'width:25%'],
                                'value' => function ($model) {
                                    if ($model->tanggal_interview != null) {
                                        $waktu = strtotime($model->tanggal_interview);
                                        if ($waktu > time()) {
                                            return date('j F Y', $waktu) . "<br><i class='badge badge-success'>Waktu Interview/Tes Diatur</i>";
                                        } else {
                                            return date('j F Y', $waktu) . " <i class='badge badge-danger'>Waktu Interview/Tes Telah Selesai</i>";
                                        }
                                    } else {
                                        return '<i class="badge badge-warning">Jadwal belum diatur</i>';
                                    }
                                },
                                'format' => 'raw'
                            ],
                            [
                                'label' => 'Pilih Soal',
                                'value' => function ($model) {
                                    $jumlahSoal = Penilaian::find()->where(['interview_id' => $model->id])->count();
                                    if ($jumlahSoal > 0) {
                                        return Html::a($jumlahSoal . ' Soal', ['/soal-interview/pilih-soal', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']);
                                    } else {
                                        return Html::a($jumlahSoal . ' Soal', ['/soal-interview/pilih-soal', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger']);
                                    }
                                },
                                'format' => 'raw',
                            ],
                            // 'pelamar_nik',
                            [
                                'class' => ActionColumn::className(),
                                'header' => 'Aksi',
                                'urlCreator' => function ($action, Interview $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                },
                                'template' => '{view}'
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>

</div>
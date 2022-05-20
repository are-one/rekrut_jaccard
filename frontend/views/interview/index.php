<?php

use frontend\models\Penilaian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\InterviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Interview';
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

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
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
                            // 'pelamar_nik',
                            [
                                'attribute' => 'tanggal_interview',
                                'label' => 'Jadwal',
                                'value' => function ($model) {

                                    $waktu = strtotime($model->tanggal_interview);
                                    $textWaktu = date('j F Y', $waktu);

                                    $dataTes = Penilaian::find()->where(['interview_id' => $model->id])->andWhere(['pilih' => null])->one();
                                    // print_r($dataTes);
                                    // die;

                                    if ($model->tanggal_interview == null) {
                                        return "<span class='badge badge-warning'>Belum Ada Jadwal</span>";
                                    } else {

                                        if ($dataTes != null) {

                                            if ($waktu > time()) {
                                                return $textWaktu . " " . Html::a('<i class="fa fa-pen"></i> Ikuti Tes', ['/interview/test', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']);
                                            } else {
                                                return '<span class="badge badge-success"> Waktu Tes Telah Selesai</span>';
                                            }
                                        } else {
                                            $ada = Penilaian::find()->where(['interview_id' => $model->id])->one();

                                            if ($ada) {
                                                return $textWaktu . ' <br><span class="badge badge-success"> Interview/Tes sudah dikerjakan</span>';
                                            }

                                            return $textWaktu . ' <br><span class="badge badge-info">Data Interview/Tes sedang diproses</span>';
                                        }
                                    }
                                },
                                'format' => 'raw'
                            ],
                            [
                                'header' => 'Aksi',
                                'class' => ActionColumn::class,
                                'buttons' => [
                                    'detail-lowongan' => function ($url, $model, $key) {
                                        return Html::a('Detail Lowongan', ['/lowongan/view', 'id' => $model->lowongan_id], ['class' => 'btn btn-success btn-xs']);
                                    }
                                ],
                                'template' => '{detail-lowongan}'
                            ]
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>

</div>
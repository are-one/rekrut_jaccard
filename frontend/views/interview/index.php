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
                                'value' => function($model)
                                {
                                    return $model->lowongan->nama_pekerjaan;
                                }
                            ],
                            // 'pelamar_nik',
                            [
                                'attribute' => 'tanggal_interview',
                                'label' => 'Jadwal',
                                'value' => function($model)
                                {

                                    $dataTes = Penilaian::findOne(['interview_id' => $model->id]);

                                    if($dataTes == null){

                                        if($model->tanggal_interview == null){
                                            return "<span>Belum Ada Jadwal</span> <br>". Html::a('<i class="fa fa-pen"></i> Ikuti Tes', "#",['class' => 'btn btn-sm btn-danger disabled']);
                                        }else{
                                            $waktu = strtotime($model->tanggal_interview);
                                            if($waktu > time()){
                                                return $model->tanggal_interview . " ". Html::a('<i class="fa fa-pen"></i> Ikuti Tes', ['/interview/test','id' => $model->id],['class' => 'btn btn-sm btn-primary']);
                                            }if(time() > $waktu){
                                                return '<span class="badge badge-info"> Waktu Tes Telah Selesai</span>';
                                            }else{
                                                return $model->tanggal_interview . " ". Html::a('<i class="fa fa-pen"></i> Ikuti Tes', "#",['class' => 'btn btn-sm btn-warning']);
                                            }
                                        }
                                        
                                    }else{
                                        return '<span class="badge badge-success"> Interview/Tes sudah dikerjakan</span>';
                                    }
                                },
                                'format' => 'raw'
                            ],
                            [
                                'header' => 'Aksi',
                                'class' => ActionColumn::class,
                                'buttons' => [
                                    'detail-lowongan' => function($url, $model, $key)
                                    {
                                        return Html::a('Detail Lowongan',['/lowongan/view','id'=> $model->id],['class' => 'btn btn-success btn-xs']);
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
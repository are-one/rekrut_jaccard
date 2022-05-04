<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Lowongan */

$this->title = "Persyaratan";
$this->params['breadcrumbs'][] = ['label' => 'Lowongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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

                    <p>
                        <?php // Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?php 
                        // Html::a('Delete', ['delete', 'id' => $model->id], [
                        //     'class' => 'btn btn-danger',
                        //     'data' => [
                        //         'confirm' => 'Are you sure you want to delete this item?',
                        //         'method' => 'post',
                        //     ],
                        // ]) ?>

                        <?= Html::a('Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-warning float-right']) ?>
                    <div class="clearfix"></div>
                    </p>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'nama_pekerjaan',
                            'tgl_publish',
                            'tgl_penutupan',
                            'deskripsi:ntext',
                            // 'hrd_nik',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>

</div>
<?php

use yii\bootstrap4\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = "Pilih Soal";


?>

<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2><small><?= Html::encode($this->title) ?></small></h2>
        </div>
    </div>

    <?php 
        ActiveForm::begin();
    ?>
    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">

                <?= Html::submitButton('Simpan',['class' => 'btn btn-success mb-2']) ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'headerRowOptions' => ['class' => 'table-bordered'],
                    'columns' => [
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'headerOptions' => ['style' => 'width:10%'],
                            'name' => 'pilihan',
                            'checkboxOptions' => function($model, $key, $index, $column) use ($pilihanSoalLama) {
                                $bool = in_array($model->id, $pilihanSoalLama); 
                                return ['checked' => $bool];
                            }
                        ],
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'headerOptions' => ['style' => 'width:10%']
                        ],
                        [
                            'attribute' => 'id',
                            'label' => 'Kode Soal',
                            'headerOptions' => ['style' => 'width:20%']
                        ],
                        'soal',
                    ]
                ]); ?>

            </div>
        </div>
    </div>
    <?php 
        ActiveForm::end();
    ?>
</div>
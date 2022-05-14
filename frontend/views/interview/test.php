<?php

use common\models\main\PilihanJawaban;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = "Test";

?>

<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h3>Soal Interview/Test</h3>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-12">
                <section class="mt-4">
                    <div class="container-fluid">

                        <!-- <div class="card">

                            <div class="card-body"> -->
                        <?php if($sudahTest){ ?>

                        <div class="alert alert-success">
                            Interview/Test telah selesai.
                        </div>

                        <?php }else{ ?>
                        <?php $form = ActiveForm::begin(); ?>

                        <div class="panel">
                            <div class="panel-heading">
                                <b>Petunjuk Pengisian:</b><br>
                                Pilih salah satu jawaban pada jawaban yang tersedia.

                            </div>
                            <div class="panel-body">

                                <table class="table">
                                    <tr>
                                        <th>No.</th>
                                        <th>Pertanyaan</th>
                                    </tr>
                                    <?php 
                                    $i = 1;
                                    $alpha = 'A';
                                    $letters = range('A','J');
                                    foreach ($soal as $key => $value) {
                                        
                                                $pilihanJawaban = PilihanJawaban::find()->where(['soal_interview_id' => $value->soal_interview_id])->all();
                                            ?>
                                    <tr>
                                        <td style="vertical-align: top;" width="5%"><?= $i ?></td>
                                        <td>
                                            <?= $value->soalInterview->soal ?>
                                            <br>
                                            <br>
                                            <?= Html::radioList("jawab[$value->soal_interview_id]",null,ArrayHelper::map($pilihanJawaban,'id',function($model) use($pilihanJawaban, $letters)
                                                    {   
                                                        $i = array_search($model, $pilihanJawaban);
                                                        $letter = $letters[$i];
                                                        $teks = "$letter. $model->pilihan";
                                                        return $teks;
                                                    }),['separator' => '<br>', 'itemOptions' => ['required'=> true]]); ?>
                                        </td>
                                    </tr>
                                    <?php
                                        
                                            $i++;
                                        } ?>
                                </table>

                            </div>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Simpan<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>', ['class' => 'btn btn-lg btn-block btn-success']) ?>
                        </div>


                        <?php ActiveForm::end(); ?>
                        <?php } ?>
                        <!-- </div>
            </div> -->
                    </div>
                </section>
            </div>
        </div>
    </div>

</div>
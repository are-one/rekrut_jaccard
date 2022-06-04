<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hrd */

$this->title = 'Edit Akun: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Hrds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'nik' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2><small><?= Html::encode($this->title) ?></small></h2>
        </div>
    </div>

    <div class="full price_table padding_infor_info">
        <div class="row">
            <div class="col-lg-6">

                <?= $this->render('_form_akun', [
                    'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>

</div>
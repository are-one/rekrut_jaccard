<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SoalInterview */

$this->title = 'Create Soal Interview';
$this->params['breadcrumbs'][] = ['label' => 'Soal Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soal-interview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HasilInterview */

$this->title = 'Create Hasil Interview';
$this->params['breadcrumbs'][] = ['label' => 'Hasil Interviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hasil-interview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

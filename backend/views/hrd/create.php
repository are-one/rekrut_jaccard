<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hrd */

$this->title = 'Create Hrd';
$this->params['breadcrumbs'][] = ['label' => 'Hrds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

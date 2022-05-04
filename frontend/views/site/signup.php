<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use common\widgets\Alert;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login_section">
    <div class="logo_login">
        <div class="center">
            <img width="210" src="<?= Url::base("https") ?>/template/images/logo/logo.png" alt="#" />
        </div>
    </div>
    <div class="login_form">
        <?= Alert::widget() ?>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <fieldset>
            <div class="field">

                <?= $form->field($model, 'nik',[
                'options' => ['tag' => false],
                'inputOptions' => ['class' => false],
                'labelOptions' => ['class' => 'label_field']
                ])->textInput(['autofocus' => true, 'placeholder' => 'Masukkan NIK'])->label("NIK") ?>

                <!-- <label class="label_field">Email Address</label> -->
                <!-- <input type="email" name="email" placeholder="E-mail" /> -->
            </div>

            <div class="field">

                <?= $form->field($model, 'nama_lengkap',[
                    'options' => ['tag' => false],
                    'inputOptions' => ['class' => false],
                    'labelOptions' => ['class' => 'label_field']
                    ])->textInput(['autofocus' => true, 'placeholder' => 'Masukkan Nama Lengkap']) ?>

                <!-- <label class="label_field">Email Address</label> -->
                <!-- <input type="email" name="email" placeholder="E-mail" /> -->
            </div>

            <div class="field">

                <?= $form->field($model, 'username',[
                    'options' => ['tag' => false],
                    'inputOptions' => ['class' => false],
                    'labelOptions' => ['class' => 'label_field']
                    ])->textInput(['autofocus' => true, 'placeholder' => 'Masukkan Username']) ?>

                <!-- <label class="label_field">Email Address</label> -->
                <!-- <input type="email" name="email" placeholder="E-mail" /> -->
            </div>

            <div class="field">

                <?= $form->field($model, 'email',[
                    'options' => ['tag' => false],
                    'inputOptions' => ['class' => false],
                    'labelOptions' => ['class' => 'label_field']
                    ])->textInput(['autofocus' => true, 'placeholder' => 'Masukkan Email']) ?>

                <!-- <label class="label_field">Email Address</label> -->
                <!-- <input type="email" name="email" placeholder="E-mail" /> -->
            </div>

            <div class="field">

                <?= $form->field($model, 'password',[
                    'options' => ['tag' => false],
                    'inputOptions' => ['class' => false],
                    'labelOptions' => ['class' => 'label_field']
                    ])->passwordInput(['placeholder' => 'Masukkan Password']) ?>

                <!-- <label class="label_field">Password</label> -->
                <!-- <input type="password" name="password" placeholder="Password" /> -->
            </div>

            <div class="field margin_0">
                <label class="label_field hidden">hidden label</label>
                <button class="main_bt">Signup</button>
            </div>
        </fieldset>

        <?php ActiveForm::end(); ?>

    </div>

    <div class="row text-center mb-4">
        <div class="col-md-12">
            <?= Html::a("Login",['/site/login'],['class' => 'btn btn-link']) ?>
        </div>
    </div>
</div>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
// use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Login';
?>
<div class="login_section">
    <div class="logo_login">
        <div class="center">
            <img width="210" src="<?= Url::to('@web') ?>/template/images/logo/logo.png" alt="#" />
        </div>
    </div>
    <div class="login_form">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <fieldset>
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

                <?= $form->field($model, 'password',[
                    'options' => ['tag' => false],
                    'inputOptions' => ['class' => false],
                    'labelOptions' => ['class' => 'label_field']
                    ])->passwordInput(['placeholder' => 'Masukkan Password']) ?>

                <!-- <label class="label_field">Password</label> -->
                <!-- <input type="password" name="password" placeholder="Password" /> -->
            </div>
            <div class="field">
                <label class="label_field hidden">hidden label</label>

                <?= $form->field($model, 'rememberMe',[
                    'options' => ['tag' => false],
                    'checkEnclosedTemplate' => "\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n",
                    'inputOptions' => ['class' => false],
                    'checkOptions' => [
                        'labelOptions' => [
                            'class' => ['widget' => 'form-check-label']
                            ]
                        ]
                    ])->checkbox(['class' => 'form-check-input'],true) ?>

                <!-- <label class="form-check-label"><input type="checkbox" class="form-check-input">Remember Me</label> -->
                <a class="forgot" href="">Forgotten Password?</a>
            </div>
            <div class="field margin_0">
                <label class="label_field hidden">hidden label</label>
                <button class="main_bt">Sing In</button>
            </div>
        </fieldset>

        <?php ActiveForm::end(); ?>

    </div>
</div>
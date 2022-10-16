<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class Akun extends Model
{
    public $email, $username, $password, $ulangi_password;

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['ulangi_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Ulangi password harus sama dengan "Password Baru"'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password Baru',
            'ulangi_password' => 'Ulangi Password Baru'
        ];
    }

    public function loadOldData()
    {
        $this->email = Yii::$app->user->identity->email;
        $this->username = Yii::$app->user->identity->username;
    }

    public function updateAkun()
    {
        if ($this->validate()) {
            $user = User::findOne(['id' => Yii::$app->user->identity->id]);
            $user->email = $this->email;
            $user->username = $this->username;
            if ($this->password) {
                $user->setPassword($this->password);
            }

            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Data berhasil disimpan.');
                return true;
            }
        }

        return false;
    }
}

<?php

namespace backend\models;

use common\models\main\Hrd as MainHrd;
use common\models\User;
use Yii;

class Hrd extends MainHrd
{
    public $email, $username, $password;
    const SCENARIO_INSERT = "scenario_insert";

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['email', 'username', 'password'], 'required', 'on' => self::SCENARIO_INSERT],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength'], 'on' => self::SCENARIO_INSERT],

            ['username', 'trim', 'on' => self::SCENARIO_INSERT],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username ini sudah digunakan.', 'on' => self::SCENARIO_INSERT],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on' => self::SCENARIO_INSERT],

            ['email', 'trim', 'on' => self::SCENARIO_INSERT],
            ['email', 'email', 'on' => self::SCENARIO_INSERT],
            ['email', 'string', 'max' => 255, 'on' => self::SCENARIO_INSERT],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Alamat Email ini sudah digunakan.', 'on' => self::SCENARIO_INSERT],
        ]);
    }

    public function hapusAkun()
    {
        $user = User::findOne(['id' => $this->nik]);

        if ($user->delete()) {
            return true;
        }

        return false;
    }

    public function buatAkun()
    {
        $user = new User();
        $user->id = $this->nik;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->is_hrd = 1;

        if ($user->save()) {
            return true;
        }

        return false;
    }
}

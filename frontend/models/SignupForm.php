<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nik;
    public $nama_lengkap;
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['nik', 'required'],
            ['nik', 'string', 'max' => 45],

            ['nama_lengkap', 'required'],
            ['nama_lengkap', 'string', 'max' => 255],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        try {
            $transaction = Yii::$app->db->beginTransaction();
            
            if (!$this->validate()) {
                return null;
            }
            
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();

            // Insert Pelamar
            $pelamar = new Pelamar(['scenario' => Pelamar::SCENARIO_INSERT]);
            $pelamar->nik = $this->nik;
            $pelamar->nama_lengkap = $this->nama_lengkap;
            $pelamar->email = $this->email;
    
            if($user->save() && $this->sendEmail($user) && $pelamar->save()){
                $transaction->commit();
                return true;
            }else{
                Yii::$app->session->setFlash('error','Terjadi masalah pada sistem, gagal membuat akun.');
                $transaction->rollBack();
            }
            
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error','Terjadi masalah pada sistem : '. $e->getMessage());
        }

        return false;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
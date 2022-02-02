<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "pelamar".
 *
 * @property string $nik
 * @property string|null $nama_lengkap
 * @property string|null $tempat_lahir
 * @property string|null $tanggal_lahir
 * @property string|null $alamat
 * @property string|null $no_hp
 * @property string|null $email
 * @property string|null $file_cv
 * @property string|null $file_ijazah
 *
 * @property Interview[] $interviews
 */
class Pelamar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pelamar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nik'], 'required'],
            [['tanggal_lahir'], 'safe'],
            [['alamat'], 'string'],
            [['nik', 'tempat_lahir', 'no_hp'], 'string', 'max' => 45],
            [['nama_lengkap', 'email', 'file_cv', 'file_ijazah'], 'string', 'max' => 255],
            [['nik'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'Nik',
            'nama_lengkap' => 'Nama Lengkap',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'email' => 'Email',
            'file_cv' => 'File Cv',
            'file_ijazah' => 'File Ijazah',
        ];
    }

    /**
     * Gets query for [[Interviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterviews()
    {
        return $this->hasMany(Interview::className(), ['pelamar_nik' => 'nik']);
    }
}

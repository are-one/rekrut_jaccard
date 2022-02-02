<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "hrd".
 *
 * @property string $nik
 * @property string|null $nama_lengkap
 * @property string|null $alamat
 * @property string|null $no_hp
 * @property string|null $posisi
 *
 * @property Lowongan[] $lowongans
 * @property SoalInterview[] $soalInterviews
 */
class Hrd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hrd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nik'], 'required'],
            [['alamat'], 'string'],
            [['nik', 'no_hp', 'posisi'], 'string', 'max' => 45],
            [['nama_lengkap'], 'string', 'max' => 255],
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
            'alamat' => 'Alamat',
            'no_hp' => 'No Hp',
            'posisi' => 'Posisi',
        ];
    }

    /**
     * Gets query for [[Lowongans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLowongans()
    {
        return $this->hasMany(Lowongan::className(), ['hrd_nik' => 'nik']);
    }

    /**
     * Gets query for [[SoalInterviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoalInterviews()
    {
        return $this->hasMany(SoalInterview::className(), ['hrd_nik' => 'nik']);
    }
}

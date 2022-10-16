<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "lowongan".
 *
 * @property int $id
 * @property string|null $nama_pekerjaan
 * @property string|null $tgl_publish
 * @property string|null $tgl_penutupan
 * @property string|null $deskripsi
 * @property string $hrd_nik
 *
 * @property Hrd $hrdNik
 * @property Interview[] $interviews
 */
class Lowongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lowongan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pekerjaan', 'deskripsi', 'tgl_publish', 'tgl_penutupan'], 'required'],
            [['deskripsi'], 'string'],
            [['hrd_nik'], 'required'],
            [['nama_pekerjaan', 'hrd_nik'], 'string', 'max' => 45],
            [['hrd_nik'], 'exist', 'skipOnError' => true, 'targetClass' => Hrd::className(), 'targetAttribute' => ['hrd_nik' => 'nik']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_pekerjaan' => 'Nama Pekerjaan',
            'tgl_publish' => 'Tgl Publish',
            'tgl_penutupan' => 'Tgl Penutupan',
            'deskripsi' => 'Deskripsi',
            'hrd_nik' => 'Hrd Nik',
        ];
    }

    /**
     * Gets query for [[HrdNik]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHrdNik()
    {
        return $this->hasOne(Hrd::className(), ['nik' => 'hrd_nik']);
    }

    /**
     * Gets query for [[Interviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterviews()
    {
        return $this->hasMany(Interview::className(), ['lowongan_id' => 'id']);
    }
}

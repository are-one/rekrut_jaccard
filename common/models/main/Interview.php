<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "interview".
 *
 * @property int $id
 * @property int $lowongan_id
 * @property string $pelamar_nik
 *
 * @property HasilInterview[] $hasilInterviews
 * @property Lowongan $lowongan
 * @property Pelamar $pelamarNik
 * @property Penilaian[] $penilaians
 * @property SoalInterview[] $soalInterviews
 */
class Interview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lowongan_id', 'pelamar_nik'], 'required'],
            [['lowongan_id'], 'integer'],
            [['pelamar_nik'], 'string', 'max' => 45],
            [['lowongan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lowongan::className(), 'targetAttribute' => ['lowongan_id' => 'id']],
            [['pelamar_nik'], 'exist', 'skipOnError' => true, 'targetClass' => Pelamar::className(), 'targetAttribute' => ['pelamar_nik' => 'nik']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lowongan_id' => 'Lowongan ID',
            'pelamar_nik' => 'Pelamar Nik',
        ];
    }

    /**
     * Gets query for [[HasilInterviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHasilInterviews()
    {
        return $this->hasMany(HasilInterview::className(), ['interview_id' => 'id']);
    }

    /**
     * Gets query for [[Lowongan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLowongan()
    {
        return $this->hasOne(Lowongan::className(), ['id' => 'lowongan_id']);
    }

    /**
     * Gets query for [[PelamarNik]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPelamarNik()
    {
        return $this->hasOne(Pelamar::className(), ['nik' => 'pelamar_nik']);
    }

    /**
     * Gets query for [[Penilaians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaians()
    {
        return $this->hasMany(Penilaian::className(), ['interview_id' => 'id']);
    }

    /**
     * Gets query for [[SoalInterviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoalInterviews()
    {
        return $this->hasMany(SoalInterview::className(), ['id' => 'soal_interview_id'])->viaTable('penilaian', ['interview_id' => 'id']);
    }
}

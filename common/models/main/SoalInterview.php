<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "soal_interview".
 *
 * @property string $id
 * @property string|null $soal
 * @property string|null $jawaban
 * @property string|null $kategori
 * @property string $hrd_nik
 *
 * @property Hrd $hrdNik
 * @property Interview[] $interviews
 * @property Penilaian[] $penilaians
 * @property PilihanJawaban[] $pilihanJawabans
 */
class SoalInterview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'soal_interview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hrd_nik'], 'required'],
            [['soal'], 'string'],
            [['id', 'jawaban', 'kategori', 'hrd_nik'], 'string', 'max' => 45],
            [['id'], 'unique'],
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
            'soal' => 'Soal',
            'jawaban' => 'Jawaban',
            'kategori' => 'Kategori',
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
        return $this->hasMany(Interview::className(), ['id' => 'interview_id'])->viaTable('penilaian', ['soal_interview_id' => 'id']);
    }

    /**
     * Gets query for [[Penilaians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaians()
    {
        return $this->hasMany(Penilaian::className(), ['soal_interview_id' => 'id']);
    }

    /**
     * Gets query for [[PilihanJawabans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPilihanJawabans()
    {
        return $this->hasMany(PilihanJawaban::className(), ['soal_interview_id' => 'id']);
    }
}

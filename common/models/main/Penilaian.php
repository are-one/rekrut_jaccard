<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "penilaian".
 *
 * @property int $interview_id
 * @property int $soal_interview_id
 * @property int|null $nilai
 *
 * @property Interview $interview
 * @property SoalInterview $soalInterview
 */
class Penilaian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penilaian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['interview_id', 'soal_interview_id'], 'required'],
            [['interview_id', 'soal_interview_id', 'nilai'], 'integer'],
            [['interview_id', 'soal_interview_id'], 'unique', 'targetAttribute' => ['interview_id', 'soal_interview_id']],
            [['interview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interview::className(), 'targetAttribute' => ['interview_id' => 'id']],
            [['soal_interview_id'], 'exist', 'skipOnError' => true, 'targetClass' => SoalInterview::className(), 'targetAttribute' => ['soal_interview_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'interview_id' => 'Interview ID',
            'soal_interview_id' => 'Soal Interview ID',
            'nilai' => 'Nilai',
        ];
    }

    /**
     * Gets query for [[Interview]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterview()
    {
        return $this->hasOne(Interview::className(), ['id' => 'interview_id']);
    }

    /**
     * Gets query for [[SoalInterview]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoalInterview()
    {
        return $this->hasOne(SoalInterview::className(), ['id' => 'soal_interview_id']);
    }
}

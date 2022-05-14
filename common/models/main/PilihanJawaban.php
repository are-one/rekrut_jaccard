<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "pilihan_jawaban".
 *
 * @property int $id
 * @property string|null $pilihan
 * @property string $soal_interview_id
 *
 * @property SoalInterview $soalInterview
 */
class PilihanJawaban extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pilihan_jawaban';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['soal_interview_id'], 'required'],
            [['pilihan'], 'string', 'max' => 255],
            [['soal_interview_id'], 'string', 'max' => 45],
            [['soal_interview_id'], 'exist', 'skipOnError' => true, 'targetClass' => SoalInterview::className(), 'targetAttribute' => ['soal_interview_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pilihan' => 'Pilihan',
            'soal_interview_id' => 'Soal Interview ID',
        ];
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

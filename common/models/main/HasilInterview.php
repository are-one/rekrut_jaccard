<?php

namespace common\models\main;

use Yii;

/**
 * This is the model class for table "hasil_interview".
 *
 * @property int $id
 * @property string|null $keterangan
 * @property int $interview_id
 * @property int $hasil
 *
 * @property Interview $interview
 */
class HasilInterview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hasil_interview';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'interview_id', 'hasil'], 'required'],
            [['id', 'interview_id', 'hasil'], 'integer'],
            [['keterangan'], 'string'],
            [['id', 'interview_id'], 'unique', 'targetAttribute' => ['id', 'interview_id']],
            [['interview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Interview::className(), 'targetAttribute' => ['interview_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keterangan' => 'Keterangan',
            'interview_id' => 'Interview ID',
            'hasil' => 'Hasil',
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
}

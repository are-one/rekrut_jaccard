<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Interview;

/**
 * InterviewSearch represents the model behind the search form of `backend\models\Interview`.
 */
class InterviewSearch extends Interview
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lowongan_id'], 'integer'],
            [['pelamar_nik'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Interview::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'lowongan_id' => $this->lowongan_id,
        ]);

        $query->andFilterWhere(['like', 'pelamar_nik', $this->pelamar_nik]);

        return $dataProvider;
    }
}

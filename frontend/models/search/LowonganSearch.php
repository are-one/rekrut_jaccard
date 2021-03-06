<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Lowongan;

/**
 * LowonganSearch represents the model behind the search form of `frontend\models\Lowongan`.
 */
class LowonganSearch extends Lowongan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nama_pekerjaan', 'tgl_publish', 'tgl_penutupan', 'deskripsi', 'hrd_nik'], 'safe'],
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
        $query = Lowongan::find();

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
            'tgl_publish' => $this->tgl_publish,
            'tgl_penutupan' => $this->tgl_penutupan,
        ]);

        $query->andFilterWhere(['like', 'nama_pekerjaan', $this->nama_pekerjaan])
            ->andFilterWhere(['like', 'deskripsi', $this->deskripsi])
            ->andFilterWhere(['like', 'hrd_nik', $this->hrd_nik]);

        return $dataProvider;
    }
}

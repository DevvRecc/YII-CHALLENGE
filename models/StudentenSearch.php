<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Studenten;

/**
 * StudentenSearch represents the model behind the search form of `app\models\Studenten`.
 */
class StudentenSearch extends Studenten
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['naam_student', 'klas', 'reden_student'], 'safe'],
            [['aantal_minuten_te_laat', 'id'], 'integer'],
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
        $query = Studenten::find();

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
            'aantal_minuten_te_laat' => $this->aantal_minuten_te_laat,
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'naam_student', $this->naam_student])
            ->andFilterWhere(['like', 'klas', $this->klas])
            ->andFilterWhere(['like', 'reden_student', $this->reden_student]);

        return $dataProvider;
    }
}

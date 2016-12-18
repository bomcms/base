<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Statistics;

/**
 * StatisticsSearch represents the model behind the search form about `app\models\Statistics`.
 */
class StatisticsSearch extends Statistics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['sessions', 'date_log', 'sources', 'ip', 'address', 'opera', 'browser', 'date_contact', 'full_name', 'email', 'phone', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Statistics::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
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
            'date_log' => $this->date_log,
            'date_contact' => $this->date_contact,
        ]);

        $query->andFilterWhere(['like', 'sessions', $this->sessions])
            ->andFilterWhere(['like', 'sources', $this->sources])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'opera', $this->opera])
            ->andFilterWhere(['like', 'browser', $this->browser])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}

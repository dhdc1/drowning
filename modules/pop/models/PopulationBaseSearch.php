<?php

namespace app\modules\pop\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pop\models\PopulationBase;

/**
 * PopulationBaseSearch represents the model behind the search form of `app\modules\pop\models\PopulationBase`.
 */
class PopulationBaseSearch extends PopulationBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ampurcode', 'changwatcode', 'byear'], 'safe'],
            [['pop_male', 'pop_female'], 'integer'],
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
        $query = PopulationBase::find();

        // add conditions that should always apply here
        $query->joinWith(['cchangwat','campur']);
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
            'pop_male' => $this->pop_male,
            'pop_female' => $this->pop_female,
        ]);

        $query->andFilterWhere(['like', 'campur.ampurname', $this->ampurcode])
            ->andFilterWhere(['like', 'cchangwat.changwatname', $this->changwatcode])
            ->andFilterWhere(['like', 'byear', $this->byear]);

        return $dataProvider;
    }
}

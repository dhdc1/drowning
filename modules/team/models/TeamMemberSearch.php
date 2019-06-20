<?php

namespace app\modules\team\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\team\models\TeamMember;

/**
 * TeamMemberSearch represents the model behind the search form of `app\modules\team\models\TeamMember`.
 */
class TeamMemberSearch extends TeamMember
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'team_id'], 'integer'],
            [['fullname', 'team_position', 'office', 'tel', 'email'], 'safe'],
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
        $query = TeamMember::find();

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
            'team_id' => $this->team_id,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'team_position', $this->team_position])
            ->andFilterWhere(['like', 'office', $this->office])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}

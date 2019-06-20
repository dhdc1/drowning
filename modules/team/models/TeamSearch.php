<?php

namespace app\modules\team\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\team\models\Team;

/**
 * TeamSearch represents the model behind the search form of `app\modules\team\models\Team`.
 */
class TeamSearch extends Team {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['team_name', 'changwat', 'ampur', 'team_level', 'approv_date', 'myear'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Team::find();

        // add conditions that should always apply here
        $query->joinWith(['cchangwat', 'campur']);
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
            'approv_date' => $this->approv_date,
        ]);

        $query->andFilterWhere(['like', 'team_name', $this->team_name])
                ->andFilterWhere(['like', 'cchangwat.changwatname', $this->changwat])
                ->andFilterWhere(['like', 'campur.ampurname', $this->ampur])
                ->andFilterWhere(['=', 'team_level', $this->team_level])
                ->andFilterWhere(['=','myear', $this->myear]);

        return $dataProvider;
    }

}

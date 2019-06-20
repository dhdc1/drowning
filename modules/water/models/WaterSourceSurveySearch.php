<?php

namespace app\modules\water\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\water\models\WaterSourceSurvey;

/**
 * WaterSourceSurveySearch represents the model behind the search form of `app\models\WaterSourceSurvey`.
 */
class WaterSourceSurveySearch extends WaterSourceSurvey
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'distance_village_mater'], 'integer'],
            [['province', 'amphur', 'tambon', 'village_no', 'village_name', 'source_type', 'safty_manage', 'lat', 'lon', 'survey_date', 'surveyer', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
        $query = WaterSourceSurvey::find();
        
        // add conditions that should always apply here

        $query->joinWith(['cchangwat','campur','ctambon']);
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
            'distance_village_mater' => $this->distance_village_mater,
            'survey_date' => $this->survey_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'cchangwat.changwatname', $this->province])
            ->andFilterWhere(['like', 'campur.ampurname', $this->amphur])
            ->andFilterWhere(['like', 'ctambon.tambonname', $this->tambon])
            ->andFilterWhere(['like', 'village_no', $this->village_no])
            ->andFilterWhere(['like', 'village_name', $this->village_name])
            ->andFilterWhere(['like', 'source_type', $this->source_type])
            ->andFilterWhere(['like', 'safty_manage', $this->safty_manage])
            ->andFilterWhere(['like', 'lat', $this->lat])
            ->andFilterWhere(['like', 'lon', $this->lon])
            ->andFilterWhere(['like', 'surveyer', $this->surveyer])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}

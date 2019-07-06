<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReportDead;

/**
 * ReportDeadSearch represents the model behind the search form of `app\models\ReportDead`.
 */
class ReportDeadSearch extends ReportDead {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'cid', 'no_addr', 'moo_addr', 'province_addr', 'amphur_addr', 'tambon_addr', 'age', 'drowning_province', 'drowning_amphur', 'drowning_tambon', 'drowning_number', 'drowning_number_dead', 'drowning_number_alive', 'report_tel', 'report_fax'], 'integer'],
            [['s_age', 's_nation', 's_year', 'icd_code', 'drowning_date', 'drowning_time', 'dead_date', 'pname', 'fname', 'lname', 'sex', 'home_addr', 'national', 'can_swim', 'drowning_type', 'pool_depth', 'location_lat', 'location_lon', 'picture', 'drowning_location', 'drowning_safty', 'drowning_safty_des', 'before_with', 'drowning_with', 'drowning_why', 'drowning_why_des', 'drowning_risk_alcohol', 'drowning_risk_addicted', 'drowning_risk_drug', 'drowning_risk_disability', 'drowning_risk_none', 'drowning_risk_disease', 'drowning_risk_disease_des', 'drowning_risk_other', 'drowning_risk_other_des', 'drowning_length', 'drowning_accessory', 'drowning_accessory_yes', 'drowning_accessory_yes_des', 'drowning_after_dead', 'drowning_helper', 'drowning_helper_drop_des', 'drowning_rescue_water', 'drowning_recue_no_des', 'drowning_recue_yes', 'drowning_rescue_yes_des', 'drowning_refer', 'drowning_refer_hosp', 'drowning_des', 'defend_drowning', 'defend_drowning_des', 'report_name', 'report_job', 'report_office', 'report_province', 'report_date', 'd_update'], 'safe'],
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
        $query = ReportDead::find();

        // add conditions that should always apply here
        $query->joinWith(['changwatdrown', 'ampurdrown', 'tambondrown', 'changwataddr', 'ampuraddr', 'tambonaddr']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'cid' => $this->cid,
            'drowning_date' => $this->drowning_date,
            'drowning_time' => $this->drowning_time,
            'dead_date' => $this->dead_date,
            'no_addr' => $this->no_addr,
            'moo_addr' => $this->moo_addr,
            'province_addr' => $this->province_addr,
            'amphur_addr' => $this->amphur_addr,
            'tambon_addr' => $this->tambon_addr,
            //'age' => $this->age,
            'drowning_province' => $this->drowning_province,
            'drowning_amphur' => $this->drowning_amphur,
            'drowning_tambon' => $this->drowning_tambon,
            'drowning_number' => $this->drowning_number,
            'drowning_number_dead' => $this->drowning_number_dead,
            'drowning_number_alive' => $this->drowning_number_alive,
            'report_tel' => $this->report_tel,
            'report_fax' => $this->report_fax,
            'report_date' => $this->report_date,
            'd_update' => $this->d_update,
            's_year' => $this->s_year,
            's_nation' => $this->s_nation,
                //'s_age'=>$this->s_age
        ]);

        if (!empty($this->s_age)) {
            $s_age = explode("-", $this->s_age);
            $query->andFilterWhere(['between', 'age', $s_age[0], $s_age[1]]);
        }


        $query->andFilterWhere(['like', 'icd_code', $this->icd_code])
                ->andFilterWhere(['like', 'pname', $this->pname])
                ->andFilterWhere(['like', 'fname', $this->fname])
                ->andFilterWhere(['like', 'lname', $this->lname])
                ->andFilterWhere(['like', 'sex', $this->sex])
                ->andFilterWhere(['like', 'home_addr', $this->home_addr])
                ->andFilterWhere(['like', 'national', $this->national])
                ->andFilterWhere(['like', 'can_swim', $this->can_swim])
                ->andFilterWhere(['like', 'drowning_type', $this->drowning_type])
                ->andFilterWhere(['like', 'pool_depth', $this->pool_depth])
                ->andFilterWhere(['like', 'location_lat', $this->location_lat])
                ->andFilterWhere(['like', 'location_lon', $this->location_lon])
                ->andFilterWhere(['like', 'picture', $this->picture])
                ->andFilterWhere(['like', 'drowning_location', $this->drowning_location])
                ->andFilterWhere(['like', 'drowning_safty', $this->drowning_safty])
                ->andFilterWhere(['like', 'drowning_safty_des', $this->drowning_safty_des])
                ->andFilterWhere(['like', 'before_with', $this->before_with])
                ->andFilterWhere(['like', 'drowning_with', $this->drowning_with])
                ->andFilterWhere(['like', 'drowning_why', $this->drowning_why])
                ->andFilterWhere(['like', 'drowning_why_des', $this->drowning_why_des])
                ->andFilterWhere(['like', 'drowning_risk_alcohol', $this->drowning_risk_alcohol])
                ->andFilterWhere(['like', 'drowning_risk_addicted', $this->drowning_risk_addicted])
                ->andFilterWhere(['like', 'drowning_risk_drug', $this->drowning_risk_drug])
                ->andFilterWhere(['like', 'drowning_risk_disability', $this->drowning_risk_disability])
                ->andFilterWhere(['like', 'drowning_risk_none', $this->drowning_risk_none])
                ->andFilterWhere(['like', 'drowning_risk_disease', $this->drowning_risk_disease])
                ->andFilterWhere(['like', 'drowning_risk_disease_des', $this->drowning_risk_disease_des])
                ->andFilterWhere(['like', 'drowning_risk_other', $this->drowning_risk_other])
                ->andFilterWhere(['like', 'drowning_risk_other_des', $this->drowning_risk_other_des])
                ->andFilterWhere(['like', 'drowning_length', $this->drowning_length])
                ->andFilterWhere(['like', 'drowning_accessory', $this->drowning_accessory])
                ->andFilterWhere(['like', 'drowning_accessory_yes', $this->drowning_accessory_yes])
                ->andFilterWhere(['like', 'drowning_accessory_yes_des', $this->drowning_accessory_yes_des])
                ->andFilterWhere(['like', 'drowning_after_dead', $this->drowning_after_dead])
                ->andFilterWhere(['like', 'drowning_helper', $this->drowning_helper])
                ->andFilterWhere(['like', 'drowning_helper_drop_des', $this->drowning_helper_drop_des])
                ->andFilterWhere(['like', 'drowning_rescue_water', $this->drowning_rescue_water])
                ->andFilterWhere(['like', 'drowning_recue_no_des', $this->drowning_recue_no_des])
                ->andFilterWhere(['like', 'drowning_recue_yes', $this->drowning_recue_yes])
                ->andFilterWhere(['like', 'drowning_rescue_yes_des', $this->drowning_rescue_yes_des])
                ->andFilterWhere(['like', 'drowning_refer', $this->drowning_refer])
                ->andFilterWhere(['like', 'drowning_refer_hosp', $this->drowning_refer_hosp])
                ->andFilterWhere(['like', 'drowning_des', $this->drowning_des])
                ->andFilterWhere(['like', 'defend_drowning', $this->defend_drowning])
                ->andFilterWhere(['like', 'defend_drowning_des', $this->defend_drowning_des])
                ->andFilterWhere(['like', 'report_name', $this->report_name])
                ->andFilterWhere(['like', 'report_job', $this->report_job])
                ->andFilterWhere(['like', 'report_office', $this->report_office])
                ->andFilterWhere(['like', 'report_province', $this->report_province]);


        return $dataProvider;
    }

}

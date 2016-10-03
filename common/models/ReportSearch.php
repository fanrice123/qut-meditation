<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Report;
use yii\db\Query;

/**
 * ReportSearch represents the model behind the search form about `common\models\Report`.
 */
class ReportSearch extends Report
{
    public $start, $end, $duration;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportID', 'courseID', 'studentID'], 'integer'],
            [['title', 'content', 'date', 'start', 'end', 'duration'], 'safe'],
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
        $subquery = (new Query())->select(['r.reportID', 'r.studentID', 'r.title', 'r.date', 'r.content', 'c.*'])->from('report r')
            ->innerJoin('course c', 'r.courseID=c.courseID');
        $query = (new Query())->from(['t' => $subquery]);

        //$query = Report::find();

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
            'reportID' => $this->reportID,
            'courseID' => $this->courseID,
            'studentID' => $this->studentID,
        ]);
        $query->andFilterWhere(['like', 'date', $this->date]);
        $query->andFilterWhere(['like', 'start', $this->start]);
        $query->andFilterWhere(['like', 'duration', $this->duration]);
        $query->andFilterWhere(['like', 'end', $this->end,]);
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}

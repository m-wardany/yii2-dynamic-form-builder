<?php

namespace wardany\dform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use wardany\dform\models\DynamicForm;

/**
 * DynamicFormSearch represents the model behind the search form of `wardany\dform\models\DynamicForm`.
 */
class DynamicFormSearch extends DynamicForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'note', 'extra_validation_rules', 'custom_form_file', 'custom_search_file', 'custom_view_file'], 'safe'],
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
        $query = DynamicForm::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'extra_validation_rules', $this->extra_validation_rules])
            ->andFilterWhere(['like', 'custom_form_file', $this->custom_form_file])
            ->andFilterWhere(['like', 'custom_search_file', $this->custom_search_file])
            ->andFilterWhere(['like', 'custom_view_file', $this->custom_view_file]);

        return $dataProvider;
    }
}

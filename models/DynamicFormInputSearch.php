<?php

namespace wardany\dform\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use wardany\dform\models\DynamicFormInput;

/**
 * DynamicFormInputSearch represents the model behind the search form of `wardany\dform\models\DynamicFormInput`.
 */
class DynamicFormInputSearch extends DynamicFormInput
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'form_id', 'type'], 'integer'],
            [['name', 'label', 'html_attributes_options', 'validation_rules'], 'safe'],
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
    public function search($params, $id= null)
    {
        $query = DynamicFormInput::find();

        // add conditions that should always apply here
        if($id)
            $query->andWhere (['form_id'=> $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['sortOrder'=>SORT_ASC]]
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
            'form_id' => $this->form_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'html_attributes_options', $this->html_attributes_options])
            ->andFilterWhere(['like', 'validation_rules', $this->validation_rules]);

        return $dataProvider;
    }
}

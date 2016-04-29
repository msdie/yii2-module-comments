<?php

namespace msdie\modules\comments\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use msdie\modules\comments\models\CommentsFields;

/**
 * CommentsFieldsSearch represents the model behind the search form about `app\modules\comments\models\CommentsFields`.
 */
class CommentsFieldsSearch extends CommentsFields
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comments_id', 'field_name'], 'integer'],
            [['value'], 'safe'],
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
        $query = CommentsFields::find();

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
            'comments_id' => $this->comments_id,
            'field_name' => $this->field_name,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}

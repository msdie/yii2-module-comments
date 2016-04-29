<?php

namespace msdie\modules\comments\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use msdie\modules\comments\models\Comments;

/**
 * CommentsSearch represents the model behind the search form about `app\modules\comments\models\Comments`.
 */
class CommentsSearch extends Comments
{
    public $pageUrl;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'status_id', 'parent_id'], 'integer'],
            [['title', 'text','pageUrl'], 'safe'],
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
        $query = Comments::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith('commentsLink');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status_id' => $this->status_id,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like','comments_link.url',$this->pageUrl]);


        return $dataProvider;
    }
}

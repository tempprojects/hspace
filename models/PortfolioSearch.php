<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Portfolio;

/**
 * PortfolioSearch represents the model behind the search form about `backend\models\Portfolio`.
 */
class PortfolioSearch extends Portfolio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'owner_id', 'moderation', 'status', 'likes', 'views', 'group_id', 'date'], 'integer'],
            [['images'], 'safe'],
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
        if(isset($params['id'])){
            $this->owner_id=$params['id'];
        }
        $query = Portfolio::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'item_id' => $this->item_id,
            'owner_id' => $this->owner_id,
            'moderation' => $this->moderation,
            'status' => $this->status,
            'likes' => $this->likes,
            'views' => $this->views,
            'group_id' => $this->group_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}

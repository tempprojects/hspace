<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PortfolioCollections;

/**
 * PortfolioCollectionsSearch represents the model behind the search form about `backend\models\PortfolioCollections`.
 */
class PortfolioCollectionsSearch extends PortfolioCollections
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'main'], 'integer'],
            [['items', 'name', 'about'], 'safe'],
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
        $query = PortfolioCollections::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'main' => $this->main,
        ]);

        $query->andFilterWhere(['like', 'items', $this->items])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'about', $this->about]);

        return $dataProvider;
    }
}

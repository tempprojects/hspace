<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Users;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
    */
    public function rules()
    {
        return [
            [['id', 'status', 'paid_status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'account_activation_token', 'password_reset_token', 'email', 'first_name', 'last_name', 'city', 'country', 'roles'], 'safe'],
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
        $query = Users::find();

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
            'status' => $this->status,
            'paid_status' => $this->paid_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'account_activation_token', $this->account_activation_token])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'roles', $this->roles]);

            if ($this->getAttribute('status')) {
               $query->andFilterWhere(['status'=> $this->status]);
            }
            else{
                $query->andFilterWhere(['status'=> [0, 10]]);
            }
        return $dataProvider;
    }
}
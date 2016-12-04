<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Window;

/**
 * WindowSearch represents the model behind the search form about `app\models\Window`.
 */
class WindowSearch extends Window
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'rain_sensor', 'light_sensor', 'voice_sensor'], 'integer'],
            [['datetime'], 'safe'],
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
        $query = Window::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
                'pagination' => [
                'pageSize' => 50000,
            ],
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
            'status' => $this->status,
            'rain_sensor' => $this->rain_sensor,
            'light_sensor' => $this->light_sensor,
            'voice_sensor' => $this->voice_sensor,
            'datetime' => $this->datetime,
        ]);

        return $dataProvider;
    }
}

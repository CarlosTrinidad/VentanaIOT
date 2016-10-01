<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alarmas;

/**
 * AlarmasSearch represents the model behind the search form about `app\models\Alarmas`.
 */
class AlarmasSearch extends Alarmas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'listo', 'estado_ventana', 'estado_cortina'], 'integer'],
            [['dia_hora'], 'safe'],
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
        $query = Alarmas::find();

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
            'dia_hora' => $this->dia_hora,
            'listo' => $this->listo,
            'estado_ventana' => $this->estado_ventana,
            'estado_cortina' => $this->estado_cortina,
        ]);

        return $dataProvider;
    }
}

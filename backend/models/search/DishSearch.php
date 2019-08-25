<?php
 
namespace app\models\search;
 
use app\models\Dishes;
use yii\data\ActiveDataProvider;
 
class DishSearch extends Dishes
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['dish_name'], 'string', 'max' => 255],
        ];
    }
    public function search($params)
    {
        $query = static::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->filterWhere(['id' => $this->id]);
        $query->andFilterWhere(['LIKE', 'dish_name', $this->dish_name]);
 
        return $dataProvider;
    }
}
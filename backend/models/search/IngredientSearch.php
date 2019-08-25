<?php
 
namespace app\models\search;
 
use app\models\Ingredients;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
 
class IngredientSearch extends Ingredients
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ingredient_name'], 'string', 'max' => 255],
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
        $query->andFilterWhere(['LIKE', 'ingredient_name', $this->ingredient_name]);
 
        return $dataProvider;
    }
}
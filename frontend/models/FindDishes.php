<?php

namespace frontend\models;

use yii\db\Query;

class FindDishes extends \yii\db\ActiveRecord
{
    const DISHES = 'dishes';
    const IDS = 'ingredients_dishes';
    const ING = 'ingredients';

    public $ingredients_array;
    public $dishes;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredient_name'], 'required'],
            [['ingredient_name'], 'unique'],
            [['ingredient_name'], 'string', 'max' => 255],
            [['ingredients_array'], 'safe'],
            [['dishes'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ingredient_name' => 'Ingredient Name',
            'ingredients_array' => 'Выберите ингредиенты'
        ];
    }
    public function getDishesWithIngredients()
    {
        $query  = new Query(); 
        return $query
                ->select(['dishes_id', 'dish_name', 'count' => 'COUNT(dishes_id)'])
                ->from(['i' => self::tableName()])
                ->join('INNER JOIN', ['ids' => self::IDS], 'i.id = ids.ingredients_id')
                ->join('INNER JOIN', ['d' => self::DISHES], 'ids.dishes_id = d.id')
                ->where(['ingredients_id' => $this->ingredients_array])
                ->groupBy(['dishes_id', 'dish_name'])
                ->orderBy(['count' => SORT_DESC])
                ->all();
    }
    public function getResultDishes()
    {
        $dishes = $this->getDishesWithIngredients();
        $checkbox = true;
        foreach ($dishes as $dish) {
            if ($dish['count'] < 2) {
                continue;
            } elseif ($dish['count'] >= 5) {
                $this->dishes[] = $dish['dish_name'];
                $checkbox = false;
            } elseif ($checkbox) {
                $this->dishes[] = $dish['dish_name'];
            }
        }
        return $this->dishes;
    }
    public function getMistake()
    {
        $mistake = '';
        if (!empty($this->ingredients_array) && sizeof($this->ingredients_array) >= 2) {
            $mistake = 'Ничего не найдено';
        } else {
            $mistake = 'Выберите больше ингредиентов';
        }
        return $mistake;
    }
}

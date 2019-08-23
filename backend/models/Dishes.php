<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id
 * @property string $dish_name
 *
 * @property IngredientsDishes[] $ingredientsDishes
 * @property Ingredients[] $ingredients
 */
class Dishes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dish_name'], 'required'],
            [['dish_name'], 'unique'],
            [['dish_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_name' => 'Dish Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientsDishes()
    {
        return $this->hasMany(IngredientsDishes::className(), ['dishes_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasMany(Ingredients::className(), ['id' => 'ingredients_id'])->viaTable('ingredients_dishes', ['dishes_id' => 'id']);
    }
}

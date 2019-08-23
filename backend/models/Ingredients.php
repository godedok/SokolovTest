<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string $ingredient_name
 *
 * @property IngredientsDishes[] $ingredientsDishes
 * @property Dishes[] $dishes
 */
class Ingredients extends \yii\db\ActiveRecord
{
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
            [['ingredient_name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredientsDishes()
    {
        return $this->hasMany(IngredientsDishes::className(), ['ingredients_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasMany(Dishes::className(), ['id' => 'dishes_id'])->viaTable('ingredients_dishes', ['ingredients_id' => 'id']);
    }
}

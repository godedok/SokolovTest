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
    public $ingredients_array;
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
            [['ingredients_array'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dish_name' => 'Название блюда',
            'ingredients_array' => 'Ингредиенты',
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
        return $this->hasMany(Ingredients::className(), ['id' => 'ingredients_id'])->via('ingredientsDishes');
    }

    public function afterFind()
    {
        $this->ingredients_array = $this->ingredients;
    }

    public function afterSave($insert, $changedAttributes)
    
    {
        parent::afterSave($insert, $changedAttributes);

        $arr = \yii\helpers\ArrayHelper::map($this->ingredients, 'id', 'id');
        $model = new IngredientsDishes();
        $model->dishId = $this->id;
        if (!empty($this->ingredients_array)) {
            foreach ($this->ingredients_array as $value) {
                if(!in_array($value, $arr)) {
                    $model->ingredientsId = $value;
                }
                if (isset($arr[$value])) {
                    unset($arr[$value]);
                }
            }
        }
        $model->insertRecords();
        IngredientsDishes::deleteAll(['ingredients_id' => $arr, 'dishes_id' => $this->id]);
    }
}

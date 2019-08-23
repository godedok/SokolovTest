<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingredients_dishes".
 *
 * @property int $ingredients_id
 * @property int $dishes_id
 *
 * @property Dishes $dishes
 * @property Ingredients $ingredients
 */
class IngredientsDishes extends \yii\db\ActiveRecord
{
    /**
     * Add ingredients and dish ID in object
     */
    private $ingredientsId = [];
    private $dishId = null;
    public function setIngredientsId(int $id): void
    {
        $this->ingredientsId[] = $id;
    }
    public function setDishId(int $id): void
    {
        $this->dishId = $id;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients_dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredients_id', 'dishes_id'], 'required'],
            [['ingredients_id', 'dishes_id'], 'integer'],
            [['ingredients_id', 'dishes_id'], 'unique', 'targetAttribute' => ['ingredients_id', 'dishes_id']],
            [['dishes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dishes::className(), 'targetAttribute' => ['dishes_id' => 'id']],
            [['ingredients_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['ingredients_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ingredients_id' => 'Ingredients ID',
            'dishes_id' => 'Dishes ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasOne(Dishes::className(), ['id' => 'dishes_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasOne(Ingredients::className(), ['id' => 'ingredients_id']);
    }
    /**
     * Insert records into table
     */
    public function insertRecords()
    {
        $dishId = $this->dishId;
        $ingredientsId = $this->ingredientsId;
        Yii::$app->db
            ->createCommand()
            ->batchInsert(self::tableName(), ['ingredients_id', 'dishes_id'],
                array_map(function ($ingredientId) use ($dishId) {
                    return [$ingredientId, $dishId];
                }, $ingredientsId))
            ->execute();
        return true;
    }
}

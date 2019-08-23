<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredients_dishes}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ingredients}}`
 * - `{{%dishes}}`
 */
class m190822_145414_create_junction_table_for_ingredients_and_dishes_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredients_dishes}}', [
            'ingredients_id' => $this->integer(),
            'dishes_id' => $this->integer(),
            'PRIMARY KEY(ingredients_id, dishes_id)',
        ]);

        // creates index for column `ingredients_id`
        $this->createIndex(
            '{{%idx-ingredients_dishes-ingredients_id}}',
            '{{%ingredients_dishes}}',
            'ingredients_id'
        );

        // add foreign key for table `{{%ingredients}}`
        $this->addForeignKey(
            '{{%fk-ingredients_dishes-ingredients_id}}',
            '{{%ingredients_dishes}}',
            'ingredients_id',
            '{{%ingredients}}',
            'id',
            'CASCADE'
        );

        // creates index for column `dishes_id`
        $this->createIndex(
            '{{%idx-ingredients_dishes-dishes_id}}',
            '{{%ingredients_dishes}}',
            'dishes_id'
        );

        // add foreign key for table `{{%dishes}}`
        $this->addForeignKey(
            '{{%fk-ingredients_dishes-dishes_id}}',
            '{{%ingredients_dishes}}',
            'dishes_id',
            '{{%dishes}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ingredients}}`
        $this->dropForeignKey(
            '{{%fk-ingredients_dishes-ingredients_id}}',
            '{{%ingredients_dishes}}'
        );

        // drops index for column `ingredients_id`
        $this->dropIndex(
            '{{%idx-ingredients_dishes-ingredients_id}}',
            '{{%ingredients_dishes}}'
        );

        // drops foreign key for table `{{%dishes}}`
        $this->dropForeignKey(
            '{{%fk-ingredients_dishes-dishes_id}}',
            '{{%ingredients_dishes}}'
        );

        // drops index for column `dishes_id`
        $this->dropIndex(
            '{{%idx-ingredients_dishes-dishes_id}}',
            '{{%ingredients_dishes}}'
        );

        $this->dropTable('{{%ingredients_dishes}}');
    }
}

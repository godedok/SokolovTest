<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Ingredients;

/* @var $this yii\web\View */
/* @var $model app\models\Dishes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dishes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dish_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingredients_array')->widget(\kartik\select2\Select2::classname(), [
        'data' => ArrayHelper::map(
        \app\models\Ingredients::find()->all(), 'id', 'ingredient_name'),
        'options' => ['placeholder' => 'Select a ingredient ...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 15
        ],
    ]);
?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

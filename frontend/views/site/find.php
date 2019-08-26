<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


?>

<div class="ingredients-form">
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ingredients_array')->widget(\kartik\select2\Select2::classname(), [
        'data' => ArrayHelper::map(
        $model->find()->all(), 'id', 'ingredient_name'),
        'options' => [
            'placeholder' => 'Select a ingredient ...',
            'multiple' => true
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
            'maximumSelectionLength' => 5,
            'maximumInputLength' => 15
        ],
        'toggleAllSettings' => [
            'selectLabel' => '',
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredients */

$this->title = 'Update Ingredients: ' . $model->ingredient_name;
$this->params['breadcrumbs'][] = ['label' => 'Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ingredient_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingredients-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

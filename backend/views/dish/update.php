<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dishes */

$this->title = 'Update Dishes: ' . $model->dish_name;
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dish_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dishes-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Ingredients;

/* @var $this yii\web\View */
/* @var $model app\models\Dishes */

$this->title = 'Create Dishes';
$this->params['breadcrumbs'][] = ['label' => 'Dishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dishes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

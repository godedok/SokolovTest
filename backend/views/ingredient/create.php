<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredients */

$this->title = 'Create Ingredients';
$this->params['breadcrumbs'][] = ['label' => 'Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredients-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

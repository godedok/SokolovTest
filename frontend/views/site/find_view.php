<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dishes */

$this->title = 'Блюда';

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dishes-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' => 'Блюда',
                    'value' => isset($dishes) ? implode(', ', array_map(function($dish) {
                        return $dish;
                    }, $dishes)) : $model->mistake,
                ],
            ],
        ]) ?>

</div>

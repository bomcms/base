<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StatisticsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="statistics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sessions') ?>

    <?= $form->field($model, 'date_log') ?>

    <?= $form->field($model, 'sources') ?>

    <?= $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'opera') ?>

    <?php // echo $form->field($model, 'browser') ?>

    <?php // echo $form->field($model, 'date_contact') ?>

    <?php // echo $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'content') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

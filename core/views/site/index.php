<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Vinpearl Bãi Dài';
?>

<?php $form = ActiveForm::begin([
			'id' => 'contact-form',
			'enableAjaxValidation' => true,
			'validationUrl' => Url::toRoute(['validate-form'])
			]); ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'phone') ?>

<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>


<?php $form = ActiveForm::begin([
			'id' => 'contact-form-2',
			'enableAjaxValidation' => true,
			'validationUrl' => Url::toRoute(['validate-form'])
			]); ?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'phone') ?>

<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button-2']) ?>
    </div>

<?php ActiveForm::end(); ?>
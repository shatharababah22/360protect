<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\Countries $model */
/** @var yii\widgets\ActiveForm $form */
?>






<div class="country-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] 
    ]); ?>

    <div class="row mb-2">
        <div class="col-sm-6">
            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'active')->dropDownList(
                [
                    '0' => 'Inactive',
                    '1' => 'Active',
                ],
                ['class' => 'form-select']
            ) ?>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-6">
            <?= $form->field($model, 'callCode')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-6">
            <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'zone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group d-flex justify-content-end ">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary save-button']) ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>
<!-- End Form -->


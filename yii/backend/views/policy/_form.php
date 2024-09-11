<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Policy $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="policy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'from_airport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DepartCountryCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departure_date')->textInput() ?>

    <?= $form->field($model, 'going_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ArrivalCountryCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_date')->textInput() ?>

    <?= $form->field($model, 'ProposalState')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ItineraryID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PNR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PolicyNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PolicyPurchasedDateTime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PolicyURLLink')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'source')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

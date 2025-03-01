<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Discount $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="discount-form">

    <?php $form = ActiveForm::begin(); ?>


    

    <div class="row mb-3">
    <div class="col-sm-6">
        <label class="form-label">Promo Code</label>
        <?= $form->field($model, 'promo_code')->textInput(['maxlength' => true])->label(false) ?>
    </div>

    <div class="col-sm-6">
        <label class="form-label">Discount Percentage</label>
        <?= $form->field($model, 'discount_percentage')->textInput(['maxlength' => true])->label(false) ?>
    </div>
</div>

    <div class="row mb-3">


    <label class="form-label">Insurance Type</label>
        <?= $form->field($model, 'insurance_id', ['options' => ['class' => 'col-sm-12']])->dropDownList(
            \yii\helpers\ArrayHelper::map(
                \common\models\Insurances::find()->all(),
                'id',
                'name'
            ),
            ['class' => 'form-select']
            )->label(false) ?>
    </div>
    <div class="form-group d-flex justify-content-end ">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary save-button']) ?>

</div>

    <?php ActiveForm::end(); ?>

</div>

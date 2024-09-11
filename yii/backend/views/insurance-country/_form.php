<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\InsuranceCountries $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="insurance-countries-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
    <div class="row mb-3">
        <?= $form->field($model, 'source_country', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'insurance_id', ['options' => ['class' => 'col-sm-6']])->dropDownList(
            \yii\helpers\ArrayHelper::map(
                \common\models\Insurances::find()->all(),
                'id',
                'name'
            ),
            ['class' => 'form-select']
        ) ?>
    </div>
    <div class="row mb-4">
        <?= $form->field($model, 'country_code', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'source_country_code', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>
    </div>
    <label class="form-label">Photo</label><hr class="mb-2" style="margin: 1px 2px ;">

    <?php $photoUrl = $model->company_logo ? Url::to('@web/images/' . $model->company_logo) : Url::to('@web/svg/illustrations/oc-browse.svg') ?>
    <div class="row mb-3 align-items-center">
        <div class="col-md-auto">
            <img id="defaultImage" class="avatar avatar-xl avatar-4x3 mb-3" src="<?= $photoUrl ?>" alt="Image Description" data-hs-theme-appearance="default">
        </div>
        <div class="col-md">
            <?= $form->field($model, 'company_logo')->fileInput(['class' => 'form-control image-form', 'id' => 'basicFormFile', ])->label(false) ?>
        </div>
    </div>


             
    <hr class="mb-4 border-0" style="margin: 1px 2px ;">
<label class="form-label mb-4">  <h4 class="card-header-title">Translation Fields</h4></label><hr class="mb-4" style="margin: 1px 2px ;">
<div class="mb-4">
<label class="form-label">Source Country (Arabic)</label>
<?= $form->field($model, 'source_country_ar')->textInput(['maxlength' => true])->label(false) ?>
</div>


    <div class="form-group d-flex justify-content-end ">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary save-button']) ?>
   
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Insurances $model */
/** @var yii\widgets\ActiveForm $form */



?>





<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // Important for file uploads
]);
?>
<label class="form-label">Name</label>
<?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>


<div class="row">
    <div class="col-sm-6">
        <!-- Form -->
        <div class="mb-4">
            <label for="price" class="form-label">Price</label>



            <div class="quantity-counter ">
                <div class="js-quantity-counter row align-items-center">
                    <div class="col">
                        <!-- <span class="d-block small">Select quantity</span> -->

                        <?= $form->field($model, 'price', ['options' => ['class' => 'mt-1']])->textInput(['class' => 'js-result  form-control form-control-quantity-counter'])->label(false)->error(false) ?>

                    </div>
                    <!-- End Col -->

                    <div class="col-auto">
                        <a class="js-minus btn btn-outline-secondary btn-xs btn-icon rounded-circle" href="javascript:;">
                            <svg width="8" height="2" viewBox="0 0 8 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 1C0 0.723858 0.223858 0.5 0.5 0.5H7.5C7.77614 0.5 8 0.723858 8 1C8 1.27614 7.77614 1.5 7.5 1.5H0.5C0.223858 1.5 0 1.27614 0 1Z" fill="currentColor" />
                            </svg>
                        </a>
                        <a class="js-plus btn btn-outline-secondary btn-xs btn-icon rounded-circle" href="javascript:;">
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 0C4.27614 0 4.5 0.223858 4.5 0.5V3.5H7.5C7.77614 3.5 8 3.72386 8 4C8 4.27614 7.77614 4.5 7.5 4.5H4.5V7.5C4.5 7.77614 4.27614 8 4 8C3.72386 8 3.5 7.77614 3.5 7.5V4.5H0.5C0.223858 4.5 0 4.27614 0 4C0 3.72386 0.223858 3.5 0.5 3.5H3.5V0.5C3.5 0.223858 3.72386 0 4 0Z" fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

            </div>

            <?php if ($model->hasErrors('price')) : ?>
                <div class="help-block">
                    <?= $model->getFirstError('price') ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- End Form -->
    </div>
  
    <?= $form->field($model, 'benefits_link', [
    'options' => ['class' => 'col-sm-6'],
    'template' => '{label}<div>{input}</div>{error}',
    'labelOptions' => ['class' => 'your-custom-label-class', 'style' => 'color: black; padding-bottom: 8px;']
])->fileInput(['maxlength' => true, 'class' => 'form-control']); ?>




</div>


<label class="form-label">Description <span class="form-label-secondary">(Optional)</span></label>

<div class="mb-4">
    <div>
        <?= $form->field($model, 'description')->textarea([
            'class' => 'form-control',
            'rows' => '7', 
        ])->label(false) ?>
    </div>
</div>




<label class="form-label">Overview <span class="form-label-secondary">(Optional)</span></label>
<div class="mb-4">
    <div>
        <?= $form->field($model, 'overview')->textarea([
            'class' => 'form-control',
            'rows' => '7',
        ])->label(false) ?>
    </div>
</div>


<label class="form-label">Photo</label><hr class="mb-2" style="margin: 1px 2px ;">

<?php $photoUrl = $model->photo ? Url::to('@web/images/' . $model->photo) : Url::to('@web/svg/illustrations/oc-browse.svg') ?>
<div class="row mb-3 align-items-center">
    <div class="col-md-auto">
        <img id="defaultImage" class="avatar avatar-xl avatar-4x3 mb-3 mt-2" src="<?= $photoUrl ?>" alt="Image Description" data-hs-theme-appearance="default">
    </div>
    <div class="col-md">
        <?= $form->field($model, 'photo')->fileInput(['class' => 'form-control image-form', 'id' => 'basicFormFile',])->label(false) ?>
    </div>
</div>
<hr class="mb-4 border-0" style="margin: 1px 2px ;">
<label class="form-label mb-4">  <h4 class="card-header-title">Translation Fields</h4></label><hr class="mb-4" style="margin: 1px 2px ;">
<div class="mb-4">
<label class="form-label">Name (Arabic)</label>
<?= $form->field($model, 'name_ar')->textInput(['maxlength' => true])->label(false) ?>
</div>


<label class="form-label">Description (Arabic)<span class="form-label-secondary">(Optional)</span></label>

<div class="mb-4">
    <div>
        <?= $form->field($model, 'description_ar')->textarea([
            'class' => 'form-control',
            'rows' => '7', 
        ])->label(false) ?>
    </div>
</div>




<label class="form-label">Overview (Arabic)<span class="form-label-secondary">(Optional)</span></label>
<div class="mb-4">
    <div>
        <?= $form->field($model, 'overview_ar')->textarea([
            'class' => 'form-control',
            'rows' => '7',
        ])->label(false) ?>
    </div>
</div>



<div class="form-group d-flex justify-content-end ">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary save-button']) ?>

</div>

<?php ActiveForm::end(); ?>
<!-- End Card -->
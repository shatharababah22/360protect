<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Plans $model */
/** @var yii\widgets\ActiveForm $form */
?>




                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data']
                ]); ?>






                <div class="row mb-3">
        <?= $form->field($model, 'name', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'insurance_id', ['options' => ['class' => 'col-sm-6']])->dropDownList(
            \yii\helpers\ArrayHelper::map(
                \common\models\Insurances::find()->all(),
                'id',
                'name'
            ),
            ['class' => 'form-select']
        ) ?>
    </div>




    

    <div class="row mb-3">
        <?= $form->field($model, 'plan_code', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'source_id', ['options' => ['class' => 'col-sm-6']])->dropDownList(
            \yii\helpers\ArrayHelper::map(
                \common\models\InsuranceCountries::find()->all(),
                'id',
                'source_country'
            ),
            ['class' => 'form-select']
        ) ?>
    </div>






                


                <div class="row">



                
                <div class="col-sm-6">
                        <!-- Form -->
                        <div class="mb-4">
                            <label for="price" class="form-label">Min age</label>



                            <div class="quantity-counter ">
                                <div class="js-quantity-counter row align-items-center">
                                    <div class="col">
                                        <!-- <span class="d-block small">Select min age</span> -->

                                        <?= $form->field($model, 'min_age',['options'=>['class'=>'mt-1']])->textInput(['class' => 'js-result form-control form-control-quantity-counter'])->label(false)->error(false) ?>

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
                            <?php if ($model->hasErrors('min_age')) : ?>
                                <div class="help-block">
                                    <?= $model->getFirstError('min_age') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- End Form -->
                    </div>
                    <div class="col-sm-6">
                        <!-- Form -->
                        <div class="mb-4">
                            <label for="price" class="form-label">Max age</label>



                            <div class="quantity-counter ">
                                <div class="js-quantity-counter row align-items-center">
                                    <div class="col">
                                        <!-- <span class="d-block small">Select max age</span> -->

                                        <?= $form->field($model, 'max_age',['options'=>['class'=>'mt-1']])->textInput(['class' => 'js-result form-control form-control-quantity-counter'])->label(false)->error(false) ?>

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
                            <?php if ($model->hasErrors('max_age')) : ?>
                                <div class="help-block">
                                    <?= $model->getFirstError('max_age') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- End Form -->
                    </div>


                </div>





                <label class="form-label">Description <span class="form-label-secondary">(Optional)</span></label>

                <?= $form->field($model, 'description')->textarea([
    'class' => 'form-control',
    'rows' => '7',
])->label(false) ?>

                <label class="form-label">Overview <span class="form-label-secondary">(Optional)</span></label>

<?= $form->field($model, 'overview')->textarea([
    'class' => 'form-control',
    'rows' => '7',
])->label(false)  ?>


             
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
  
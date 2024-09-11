<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Pricing $model */
/** @var yii\widgets\ActiveForm $form */
?>







<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<?php $form = ActiveForm::begin(); ?>





<div class="row mb-2">
    <?= $form->field($model, 'plan_id', ['options' => ['class' => 'col-sm-6']])->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\Plans::find()->all(),
            'id',
            'plan_code'
        ),
        ['class' => 'form-select']
    ) ?>

    <?= $form->field($model, 'passenger', ['options' => ['class' => 'col-sm-6']])->dropDownList(
        [
            '' => 'Please select',
            'adult' => 'Adult',
            'child' => 'Child',
            'Infant' => 'INF',
        ],
        [

            'class' => 'form-select',


        ]
    ) ?>


</div>

<div class="row mb-2">





    <div class="col-sm-6">
        <!-- Form -->
        <div class="mb-4">
            <label for="price" class="form-label">Price</label>



            <div class="quantity-counter ">
                <div class="js-quantity-counter row align-items-center">
                    <div class="col">
                        <!-- <span class="d-block small">Select quantity</span> -->

                        <?= $form->field($model, 'price', ['options' => ['class' => 'mt-1']])->textInput(['class' => 'js-result form-control form-control-quantity-counter', 'placeholder' => '1.00' ])->label(false)->error(false) ?>


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
        </div>
        <!-- End Form -->
    </div>

    <?= $form->field($model, 'duration', ['options' => ['class' => 'col-sm-6']])->dropDownList(
        [
            '' => 'Please select duration',
            '7' => '7 days',
            '10' => '10 days',
            '15' => '15 days',
            '21' => '21 days',
            '30' => '1 month',
            '60' => '2 months',
            '90' => '3 months',
            '180' => '6 months',
            '365' => '1 year',
            '730' => '2 years',
            '1095' => '3 years',
        ],
        [
            'class' => 'form-select',

        ]
    ) ?>

</div>













<div class="row mb-2">





    <div class="col-sm-6">
        <!-- Form -->
        <div class="mb-4">
            <label for="discount_price" class="form-label">Discount price</label>



            <div class="quantity-counter ">
                <div class="js-quantity-counter row align-items-center">
                    <div class="col">


                        <?= $form->field($model, 'discount_price', ['options' => ['class' => 'mt-1']])->textInput(['class' => 'js-result form-control form-control-quantity-counter'])->label(false)->error(false) ?>


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
        </div>
        <!-- End Form -->
    </div>




    <div class="col-sm-6">
        <?= $form->field($model, 'status')->dropDownList(
            [
                '' => 'Please select',
                '0' => 'Inactive',
                '1' => 'Active',
            ],
            [
                'class' => 'form-select',


            ]
        ) ?>

    </div>

</div>























<!-- Plan Code -->


<div class="form-group d-flex justify-content-end ">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary save-button']) ?>

</div>

<?php ActiveForm::end(); ?>
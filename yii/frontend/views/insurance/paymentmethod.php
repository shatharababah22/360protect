<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use borales\extensions\phoneInput\PhoneInput;
use common\widgets\Alert;
use yii\bootstrap5\Modal;

/** @var \common\models\PolicyDraft $policy */

$this->title = 'Paymnet Method';
?>
<div class="pattern-square"></div>
<!--Pageheader start-->
<section class="pt-10 pb-10 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable"><span class="text-warning"><?= Yii::t('app', 'Payment') ?></span> <?= Yii::t('app', 'Method') ?></h1>
            </div>
        </div>
    </div>
</section>





<section class="mb-xl-9 my-5">
    <div class="container">
        <div class="row d-flex justify-content-center p-4">

            <div
                class="col-lg-6 text-center  offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-md-12 col-12">
                <?= Alert::widget() ?>
                <div class="row g-xl-7 gy-5">
                    <div class="col-md-12 col-12">
                        <div class="card shadow-sm  p-4">


                            <h5 class="m-2">Choose Paymnet Method: </h5>




                            <div class="d-flex justify-content-center gap-1 m-3">

                                <?= Html::a(Yii::t('app', 'MEBs Payment'), ['/asurance/payment', 'id' => base64_encode($policy->id), 'method' => 'meps'], [
                                    'class' => 'btn btn-meps d-flex align-items-start text-white'
                                ]) ?>

                                <!-- <?= Html::a(Yii::t('app', 'Alawneh Payment'), '#', [
                                    'class' => 'btn btn-alwaneh d-flex align-items-start text-white'
                                ]) ?> -->

<?php
                            Modal::begin([
                                'headerOptions' => ['id' => 'modalHeader'],
                                'id' => 'modal-phone',
                                'size' => 'modal-md',
                                'title' => Yii::t('app', 'Phone Number'),
                                'toggleButton' => ['label' =>  Yii::t('app', 'Alawneh Payment'), 'class'=>'btn btn-alwaneh d-flex align-items-start text-white'],
                            ]);
                            $form = ActiveForm::begin([
                                'action' => \yii\helpers\Url::to(['/asurance/payment-method', 'id' => base64_encode($policy->id), 'method' => 'alawneh'])
                            ]);
                            ?>  
                            
                            <div class="modal-body">
    <p class="text-left fs-6">
        <?= Yii::t('app', 'Please write your phone number to complete the payment process to purchase the policy.'); ?>
    </p>
    <div class="form-group">
    <?= $form->field($model, 'mobile')->widget(\yii\widgets\MaskedInput::class, [
        'mask' => '+962-7##-###-###', 
        'options' => [
            'class' => 'form-control',
            'placeholder' => Yii::t('app', 'Enter your phone number'),
        ],
    ])->label(false); ?>
</div>


</div>

<div class="modal-footer">
                                    <?php
                                    echo '<button type="button" class="btn btn-outline-danger me-2" data-bs-dismiss="modal">'.Yii::t('app', 'Cancel').'</button>';
                                    echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary me-2']);
                                    ?>
                                </div>
                 
                            <?php

                            ActiveForm::end();
                            Modal::end();
                            ?>


                            </div>
                        
     



                                <?= Html::hiddenInput('paymentmethod', '', ['id' => 'paymentmethod-hidden']) ?>
                            </div>




                          


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
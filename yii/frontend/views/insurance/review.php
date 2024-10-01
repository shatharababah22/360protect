<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\PolicyDraft $policy */

use common\models\Customers;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;
use yii\helpers\Url;

$this->title = 'Review Your Insurance Details';
?>
<div class="pattern-square"></div>
<!--Pageheader start-->
<section class="pt-10 pb-10 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable">
                    <span class="text-warning"><?= Yii::t('app', 'Purchase') ?></span>
                    <?= Yii::t('app', 'Summary') ?> 
                </h1>
                
            </div>
        </div>
    </div>
</section>
<!--Pageheader end-->
<!--Contact us start-->
<section class="mb-xl-9 my-5">
    <div class="container">
        <div class="row">

            <div
                class="col-lg-10 offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-md-12 col-12">
                <?= Alert::widget() ?>
                <div class="row g-xl-7 gy-5">
                    <div class="col-md-12 col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><?= Yii::t('app', 'Insurance Type') ?></td>
                                            <td><strong><?=Yii::$app->language == 'ar' ? $policy->insurance->name_ar:$policy->insurance->name?></strong>
                                            </td>
                                            <td><?= Yii::t('app', 'Plan') ?></td>
                                            <td><strong><?=Yii::$app->language == 'ar' ?  $policy->plan->name_ar:  $policy->plan->name ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= Yii::t('app', 'Departing from') ?></td>
                                            <td><strong><?= $policy->DepartCountryCode ?>
                                                    (<?= $policy->from_airport ?>)</strong></td>
                                            <td><?= Yii::t('app', 'Going To') ?></td>
                                            <td><strong><?= $policy->ArrivalCountryCode ?>
                                                    (<?= $policy->going_to ?>)</strong></td>
                                        </tr>
                                        <tr>
                                            <td><?= Yii::t('app', 'Date') ?></td>
                                            <td><strong><?= $policy->departure_date ?></strong></td>
                                            <td><?= Yii::t('app', 'Return Date') ?></td>
                                            <td><strong><?= $policy->return_date ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td><?= Yii::t('app', 'Email') ?></td>
                                            <td><strong><?= $policy->email ?></strong></td>
                                            <td><?= Yii::t('app', 'Phone') ?></td>
                                            <td><strong><?= $policy->mobile ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><?= Yii::t('app', 'Passengers') ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th><?= Yii::t('app', 'NO') ?></th>
                                                            <th><?= Yii::t('app', 'Name') ?></th>
                                                            <th><?= Yii::t('app', 'Gender') ?></th>
                                                            <th><?= Yii::t('app', 'Nationality') ?></th>
                                                            <th><?= Yii::t('app', 'DOB') ?></th>
                                                            <th><?= Yii::t('app', 'Country') ?></th>
                                                            <th><?= Yii::t('app', 'Actions') ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($policy->policyDraftPassengers as $index => $passenger): ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td><?= $passenger->id_number ?></td>
                                                            <td><?= $passenger->first_name . ' ' . $passenger->last_name ?>
                                                            </td>
                                                            <td><?= $passenger->gender ?></td>
                                                            <td><?= $passenger->nationality ?></td>
                                                            <td><?= $passenger->dob ?></td>
                                                            <td><?= $passenger->country ?></td>
                                                            <td>
                                                                <a class="text-body" href="javascript:;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#importProductsModal">
                                                                    <i class="bi bi-camera fs-5"></i>
                                                                    <?= Yii::t('app', 'Retake') ?>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php $customer = Customers::findOne(['mobile' => $policy->mobile]); ?>
                                        <tr>
                                            <td colspan="2" class="text-start">
                                                <i class="bi bi-cash-stack"></i> <?= Yii::t('app', 'Due Amount') ?>:
                                                <strong class="text-success">USD $<?= $policy->price ?></strong>
                                            </td>

                                            <?php if ($customer !== null && $customer->credit != 0): ?>
                                            <td colspan="2" class="text-start">
                                                <i class="bi bi-wallet-fill"></i> <?= Yii::t('app', 'Your Wallet') ?>:
                                                <strong class="text-success">USD $<?= $customer->credit ?></strong>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    </table>

                                </div> <?php 
          
          $price = (float) $policy->price;
          $credit = (float) $customer->credit;

     
          $remainingAmount = max(0, $price - $credit);

        
          $formattedAmount = number_format($remainingAmount, 2);
          
      ?>
                                <?php if ($customer !== null &&  $customer->credit==$price ): ?>
                                <div class="mt-2">


                                    <?= Html::a(Yii::t('app', 'Continue') . ' ' .'($'. $formattedAmount.')', ['/asurance/payment', 'id' => base64_encode($policy->id)], ['class' => 'btn btn-warning w-100']) ?>
                                </div>
                                <?php else: ?>
                                <div class="mt-2">
                                    <?= Html::a(
    Yii::t('app', 'Pay Now') . ' ' . '($' . $formattedAmount . ')',
    '#',
    [
        'class' => 'btn btn-warning w-100',
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#paymentModal'
    ]
) ?>
                                </div>
                                <?php endif; ?>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<div id="preloader">
    <div id="loader" class="<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-loader"></div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please choose a payment method:</p>
                <div class="d-flex justify-content-start gap-1">
                  
                        <?= Html::a(Yii::t('app', 'MEBs Payment'), ['/asurance/payment', 'id' => base64_encode($policy->id)], ['class' => 'btn btn-meps d-flex align-items-start' ,'id'=>'mebsPayment']) ?>
                   
             
            

                    <?= Html::a(Yii::t('app', 'Alawneh Payment'), ['/asurance/payment', 'id' => base64_encode($policy->id)], ['class' => 'btn btn-alwaneh d-flex align-items-start' ,'id'=>'mebsPayment']) ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- retake -->
<div class="modal fade" id="importProductsModal" tabindex="-1" aria-labelledby="importProductsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="importProductsModalLabel">Retake Passport</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- End Header -->
            <?php
            $encodedPassengerId = base64_encode($passenger->id);
            $encodedPolicyId = base64_encode($policy->id);

            $actionUrl = Url::to([
                'asurance/review',
                'id' => $encodedPassengerId,
                'draft' => $encodedPolicyId
            ]);
            ?>
            <!-- Body -->
            <div class="modal-body">
                <p><span>Download the sample passport template to see an example of the format required for retaking
                        your passport photo.</span></p>

                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'id' => 'retakePassportForm'
                    ],
                    'action' => $actionUrl
                ]); ?>

                <?= $form->field($model, 'file')->fileInput(['class' => 'form-control', 'id' => 'basicFormFile',])->label(false) ?>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            <?php ActiveForm::end(); ?>
            <!-- End Footer -->
        </div>
    </div>
</div>







<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('retakePassportForm');
    const preloader = document.getElementById('preloader');
    const modal = document.getElementById('importProductsModal');

    form.addEventListener('submit', function(event) {
        event.preventDefault();


        const bootstrapModal = bootstrap.Modal.getInstance(modal);
        bootstrapModal.hide();


        preloader.style.display = 'block';


        setTimeout(() => {
            form.submit();
        }, 500);
    });

    window.addEventListener('load', function() {
        preloader.style.display = 'none';
    });
});
</script>
<!--Contact us end
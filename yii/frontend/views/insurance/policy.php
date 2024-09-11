<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\Customers $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use borales\extensions\phoneInput\PhoneInput;
use common\widgets\Alert;


$this->registerJs("
  $(document).ready(function() {
    $('.clickable-row').on('click', function() {
      var index = $(this).data('index');
      $('.details-row-' + index).toggle();
      var icon = $(this).find('i');

      icon.toggleClass('bi-caret-down-fill bi-caret-up-fill');
    });
  });
");

if (isset($apiResponse)) {
    echo $this->render('_api-response', ['apiResponse' => $apiResponse]);
}
$this->title = 'Check Policy';
?>
<script src="https://www.google.com/recaptcha/api.js"></script>


<div class="pattern-square"></div>
<!--Pageheader start--><section class="pt-10 pb-10 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable"><span class="text-warning"><?= Yii::t('app', 'Check') ?></span> <?= Yii::t('app', 'Your Policy') ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="mb-9 mt-5">
    <div class="d-flex justify-content-center container">
        <div class="row justify-content-center w-100 w-lg-75">

            <div class="col-lg-8 col-md-10 col-12 w-100 w-lg-75">
                <?= Alert::widget() ?>
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="policy-form">
                            <?php $form = ActiveForm::begin(['id' => 'demo-form']); ?>
                            <!-- <p class="text-bold text-black"><?= Yii::t('app', 'Review your policy details to ensure all insurance specifics are accurate and meet your needs:') ?></p> -->

                            <div class="col-sm-6 mx-auto text-center">
                                <label for="price" class="form-label text-black mb-2" style="font-size: 15px; color: #0F172A;">
                                    <?= Yii::t('app', 'Enter your mobile') ?>
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mt-2 mx-auto " dir="ltr">
                                    <?= $form->field($model, 'mobile')->widget(PhoneInput::class, [
                                        'jsOptions' => [
                                            'preferredCountries' => ['jo'],
                                            'class' => '',
                                            'nationalMode' => false
                                            ,
                                            'style' => 'padding-right:90px;'
                                        ]
                                    ])->label(false); ?>
                                </div>
                            </div>

                            <div class="d-flex mt-2 justify-content-center">
                                <div>
                                    <?= Html::submitButton(
                                        Yii::t('app', 'Send OTP'),
                                        [
                                            'class' => 'btn btn-primary p-2 g-recaptcha',
                                            'style' => 'width: 150px',
                                            'data-sitekey' => '6LfeOw8qAAAAAAMfV9GShxK0ZwZEnw-JWIMgnyR5',
                                            'data-callback' => 'onSubmit',
                                            'data-action' => 'submit',
                                        ]
                                    ) ?>
                                </div>
                            </div>

                            <div class="col-sm-10">
                                <?= $form->field($model, 'reCaptcha')->widget(
                                    \himiklab\yii2\recaptcha\ReCaptcha3::class,
                                    ['siteKey' => '6LfeOw8qAAAAAAMfV9GShxK0ZwZEnw-JWIMgnyR5']
                                )->label(false) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function onSubmit(token) {
        // console.log(token);
        document.getElementById("demo-form").submit();
    }
</script>
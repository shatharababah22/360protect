<?php

/** @var yii\web\View $this */
/** @var yii\base\DynamicModel $model */

use yii\helpers\Html;
use yii\helpers\Url;

use yii\bootstrap5\ActiveForm;


$this->title = 'Payment Details';

$this->registerJsFile('https://secure-jordan.paytabs.com/payment/js/paylib.js');
$clientKey = 'CRKMVQ-TTBM6T-DKDG2B-MPGMDH';

$price = Yii::$app->request->get('price');

$js = <<<JS
var myform = document.getElementById('payform');
paylib.inlineForm({
  'key': '$clientKey',
  'form': myform,
  'autoSubmit': false,
  'callback': function(response) {
    document.getElementById('paymentErrors').innerHTML = '';
    if (response.error) {             
      paylib.handleError(document.getElementById('paymentErrors'), response);
    } else {
      // Assign the token to a hidden field
      document.getElementById('payment-token').value = response.token;
      // Submit the form
      myform.submit();
    }
  }
});
JS;
$this->registerJs($js);
?>

<div class="pattern-square"></div>

<section class="pt-10 pb-5 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-2 text-white-stable"><span class="text-warning">Payment</span> Details - New Order</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="card px-4">
        <p class="h8 py-3" style="color: #0F172A;">Payment Details</p>
        <div class="row gx-3">
            <?php $form = ActiveForm::begin(['id' => 'payform']); ?>
            <!-- <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Person Name</p>
                                                            <?= $form->field($model, 'number')->textInput(['placeholder' => 'Valid card number',  'autocomplete' => 'off', 'class' => 'form-control', 'required' => true])->label(false) ?>

                        <input class="form-control mb-2" type="text" placeholder="Name" value="Barry Allen">
                    </div>
                </div> -->
            <div class="col-12">
                <div class="d-flex flex-column">
                    <p class="text mb-1">Card Number</p>
                    <?= $form->field($model, 'number')->textInput([
                        'placeholder' => '1234 5678 4356 7878',
                        'autocomplete' => 'off',
                        'class' => 'form-control mb-2',
                        'required' => true
                    ])->label(false) ?>

                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Expiry Month</p>
                        <?= $form->field($model, 'expmonth')->dropDownList(
                            [
                                '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                            ],
                            ['prompt' => 'Select Month', 'class' => 'form-control mb-2', 'required' => true]
                        )->label(false) ?>
                    </div>
                </div>

                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Expiry Year</p>
                        <?= $form->field($model, 'expyear')->dropDownList(
                            array_combine(range(date('Y'), date('Y') + 20), range(date('Y'), date('Y') + 20)),
                            ['prompt' => 'Select Year', 'class' => 'form-control mb-2', 'required' => true]
                        )->label(false) ?>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">CVV/CVC</p>
                        <?= $form->field($model, 'cvv')->textInput([
                            'placeholder' => 'CVV',
                            'autocomplete' => 'off',
                            'class' => 'form-control mb-2 pt-2',
                            'required' => true
                        ])->label(false) ?>
                    </div>
                </div>

                <div class="col-12">
                    <?= Html::hiddenInput('payment-token', '', ['id' => 'payment-token']) ?>
                    <div class=" mb-2 ">
                        <?= Html::submitButton('Confirm Payment', ['class' => ' subscribe btn btn-primary btn-block shadow-sm d-flex justify-content-center align-items-center']) ?>
                        <span class="fas fa-arrow-right "></span>
                    </div>
                </div>




                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>




    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');


        .card {
            max-width: 450px;
            margin: auto;
            color: black;
            border-radius: 20 px;
        }

        p {
            margin: 0px;
        }

        .container .h8 {
            font-size: 30px;
            font-weight: 800;
            text-align: center;
        }

        .btn.btn-primary {
            width: 100%;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
            background-image: linear-gradient(to right, #2FAE86 0%, #00C9AF 51%, #77A1D3 100%);
            border: none;
            transition: 0.5s;
            background-size: 200% auto;

        }


        .btn.btn.btn-primary:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }



        .btn.btn-primary:hover .fas.fa-arrow-right {
            transform: translate(15px);
            transition: transform 0.2s ease-in;
        }

        .form-control {
            color: #A9A9A7;
            /* background-color: #223C60; */
            /* border: 2px solid #223C60; */
            height: 50px;
            padding-left: 10px;
            vertical-align: middle;
        }



        .text {
            font-size: 14px;
            font-weight: 600;
        }

        ::placeholder {
            font-size: 14px;
            font-weight: 500;
        }
    </style>
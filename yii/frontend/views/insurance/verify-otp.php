<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \yii\base\DynamicModel $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use common\widgets\Alert;

$this->title = 'Verify OTP';
$this->registerJs("
const inputs = ['input-0', 'input-1', 'input-2', 'input-3'];

inputs.forEach((id) => {
    const input = document.getElementById(id);
    if (input) addListener(input);
});

function addListener(input) {
    input.addEventListener('keyup', (event) => {
        const code = input.value;
        if (code.match(/^[0-9]$/)) {
            const next = input.nextElementSibling;
            if (next && next.tagName === 'INPUT') next.focus();
        } else {
            input.value = '';
        }

        const key = event.key;
        if (key === 'Backspace' || key === 'Delete') {
            const prev = input.previousElementSibling;
            if (prev && prev.tagName === 'INPUT') prev.focus();
        }
    });
}
");
$sessionData = Yii::$app->session->get('session_data', []);
$lastResendTimestamp = isset($sessionData['last_resend_timestamp']) ? $sessionData['last_resend_timestamp'] : 5 * 60;
$currentTimestamp = time();


$interval = 5 * 60;


$remainingTime = ($lastResendTimestamp ? max(0, $interval - ($currentTimestamp - $lastResendTimestamp)) : 0);




?>

<div class="pattern-square"></div>


<section class="pt-10 pb-10 bg-dark text-center ">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable"><span class="text-warning"><?= Yii::t('app', 'Verify') ?></span> <?= Yii::t('app', 'Your OTP') ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="my-5 wrapper">
    <div class="container w-100 w-lg-75">
        <?= Alert::widget() ?>
        <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-3 col-xl-6 offset-xl-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-3 text-center">
            <?php $form = ActiveForm::begin(['options' => ['class' => 'rounded bg-white shadow p-5']]) ?>

            <h4 class="text-dark fw-bolder d-md-none mb-3"><?= Yii::t('app', 'Two Step Verification') ?></h4>
            <h3 class="text-dark fw-bolder d-none d-md-block"><?= Yii::t('app', 'Two Step Verification') ?></h3>
            <div class="fw-normal text-muted d-none d-md-block mb-4">
                <?= Yii::t('app', 'Enter the verification code we sent to') ?>
            </div>

            <div class="otp_input text-start mb-2" dir="ltr">
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <?php for ($i = 0; $i < 4; $i++) : ?>
                        <input type="text" name="DynamicModel[otp][]" autocomplete="off" class="form-control otp-digit ms-2" maxlength="1" id="input-<?= $i ?>" placeholder="">
                    <?php endfor; ?>
                </div>
            </div>

            <div class="col-md-12 d-flex justify-content-center">
                <?= Html::submitButton(Yii::t('app', 'Verify'), ['class' => 'btn btn-primary submit_btn my-2 w-50 w-lg-25']) ?>
            </div>

            <div class="fw-normal text-muted mb-2">
                <?php if ($remainingTime > 0): ?>
                    <div id="div1" class="fa text-warning fs-4"></div>
                    <span class="fw-bold text-decoration-none" style="color:#0F172A;font-size:small;">
                        <?= Yii::t('app', 'Please wait {minutes}m {seconds}s', ['minutes' => intval($remainingTime / 60), 'seconds' => $remainingTime % 60]) ?>
                    </span>
                <?php else: ?>
                    <?= Yii::t('app', 'Didn’t get the code?') ?>
                    <a href="<?= Url::to(['/asurance/resend', 'mobile' => $mobile]) ?>" class="fw-bold text-decoration-none" style="color:#0F172A;">
                        <?= Yii::t('app', 'Resend') ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        let remainingTime = <?= $remainingTime ?>;
        const countdownElement = document.querySelector('.fw-bold.text-decoration-none');

        if (remainingTime > 0 && countdownElement) {
            const updateCountdown = () => {
                if (remainingTime <= 0) {
                    countdownElement.innerHTML = '<a href="<?= Url::to(['/asurance/resend', 'mobile' => $mobile]) ?>" class="fw-bold text-decoration-none" style="color:#0F172A">Resend</a>';
                    clearInterval(intervalId);
                    return;
                }
                let minutes = Math.floor(remainingTime / 60);
                let seconds = remainingTime % 60;
                countdownElement.innerHTML = `Please wait ${minutes}m ${seconds}s to retry sending the message`;
                remainingTime--;
            };

            updateCountdown();
            const intervalId = setInterval(updateCountdown, 1000);
        }
    });
</script>


<script>
    function hourglass() {
        var a;
        a = document.getElementById("div1");
        a.innerHTML = "&#xf251;";
        setTimeout(function() {
            a.innerHTML = "&#xf252;";
        }, 1000);
        setTimeout(function() {
            a.innerHTML = "&#xf253;";
        }, 2000);
    }
    hourglass();
    setInterval(hourglass, 9000);
</script>



<?php ActiveForm::end() ?>
</div>
</div>
</section>


<!-- 

<style>
 
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');



    /* Main CSS OTP Verification New Changing */
    .wrapper {
        padding: 0 0 30px;
        /* margin: auto !important; */
        background-image: url("images/bg.png");
        background-position: bottom center;
        background-repeat: no-repeat;
        background-size: contain;
        background-attachment: fixed;
        min-height: 100%;
        /* height:100vh;
    display:flex;
    align-items:center;
    justify-content:center; */
    }

    .wrapper .logo img {
        max-width: 40%;
    }

    .wrapper input {
        background-color: var(--light-white);
        border-color: var(--light-white);
        color: var(--gray);
    }

    .wrapper input:focus {
        box-shadow: none;
    }

    .wrapper .password-info {
        font-size: 10px;
    }

    .wrapper .submit_btn {
        padding: 10px 15px;
        font-weight: 500;
        width: 22%;
    }

    .wrapper .login_with {
        padding: 8px 15px;
        font-size: 13px;
        font-weight: 500;
        transition: 0.3s ease-in-out;
    }

    /* .wrapper .submit_btn:focus,
.wrapper .login_with:focus{
    box-shadow: none;
} */
    .wrapper .login_with:hover {
        background-color: var(--gray-1);
        /* border-color:var(--gray-1); */
    }

    .wrapper .login_with img {
        max-width: 7%;
    }

    /* OTP Verification CSS */
    .wrapper .otp_input input {
        width: 14%;
        height: 70px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
    }

    @media (max-width:1200px) {
        .wrapper .otp_input input {
            height: 50px;
        }
    }

    @media (max-width:767px) {
        .wrapper .otp_input input {
            height: 40px;
        }
    }
</style> -->
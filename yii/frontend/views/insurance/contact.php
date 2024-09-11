<?php

/** @var yii\web\View $this */
/** @var \common\models\Policy[] $policies */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use common\widgets\Alert;


$this->title = 'Contact us';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="pattern-square"></div>




<section class="pt-10 pb-10 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable"><span class="text-warning"><?= Yii::t('app', 'Contact us') ?></span></h1>
                <p><?= Yii::t('app', 'Home / Contact us') ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Contact 1 - Bootstrap Brain Component -->
<section class="mb-xl-5" style="margin-top:5%">
    <div class="d-flex justify-content-center container">
        <div class="row justify-content-center w-75">
            <div class="col-12">
                <div class="contactinfo_content text-center aos-init aos-animate" data-aos="fade-up">
                    <h2><?= Yii::t('app', 'Lets get in touch!') ?></h2>
                    <p class="mb-4 text-center"><?= Yii::t('app', 'The best way to contact us is to use our contact form below.<br> Please fill out all of the required fields and we will get back to you as soon as possible.') ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:2.5%;">
        <div class="row justify-content-center">
            <?= Alert::widget() ?>
            <div class="col-12 col-lg-9">
                <div class="bg-white border rounded shadow-sm overflow-hidden">
                    <?php $form = ActiveForm::begin(['options' => ['class' => 'p-3']]) ?>
                    <div class="row align-items-center gy-3 gy-xl-5 p-4 p-xl-5">
                        <div class="col-12">
                            <label for="fullname" class="form-label"><?= Yii::t('app', 'Full Name <span class="text-danger">*</span>') ?></label>
                            <?= $form->field($model, 'name')->textInput(['class' => 'form-control pb-3', 'id' => 'fullname'])->label(false) ?>
                        </div>
                        <div class="col-12 col-md-6 mt-1">
                            <label for="email" class="form-label"><?= Yii::t('app', 'Email <span class="text-danger">*</span>') ?></label>
                            <?= $form->field($model, 'email')->textInput(['class' => 'form-control pb-3', 'id' => 'email'])->label(false) ?>
                        </div>

                      
                        <div class="col-12 col-md-6 mt-1">
   
                            <label for="phone" class="form-label"><?= Yii::t('app', 'Phone Number') ?></label>
                            <div dir='ltr'>
                            <?= $form->field($model, 'mobile')->widget(PhoneInput::class, [
    'jsOptions' => [
        'preferredCountries' => ['jo'],
        'class' => 'form-control pb-3 ',
        'id' => 'phone',
    ],
])->label(false)->error(false); ?>


<div class="invalid-feedback">
                    The arrival country can't be blank.
                </div>
                            </div>

                        </div>
                        <div class="col-12 mt-1">
                            <label for="message" class="form-label"><?= Yii::t('app', 'Message <span class="text-danger">*</span>') ?></label>
                            <?= $form->field($model, 'message')->textarea([
                                'class' => 'form-control',
                                'rows' => '3',
                            ])->label(false) ?>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="d-grid">
                                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn w-100 btn-primary text-white', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</section>






<section class="contactinfo-con">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contactinfo_content text-center aos-init aos-animate" data-aos="fade-up">
                    <h2 class="mb-2"><span class="text-warning"><?= Yii::t('app', 'Our Contact Information') ?></span></h2>
                    <p class="mb-5"><?= Yii::t('app', 'We’re here to assist you with any questions or concerns. Feel free to reach out to us using the contact details below.') ?></p>
                </div>
            </div>
        </div>
        <div class="row aos-init aos-animate" data-aos="fade-up" style="margin-top:2.5%;">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box">
                    <figure class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" width="11%" alt="image" class="img-fluid">
                    </figure>
                    <h4><?= Yii::t('app', 'Our Location') ?></h4>
                    <p class="text-size-16">Swaifieh, Amman, Jordan</p>
                    <div class="clearfix"></div>
                    <a href="https://www.google.com/maps/place/121+King+St,+Melbourne+VIC+3000,+Australia/@-37.8172467,144.9532001,17z/data=!3m1!4b1!4m6!3m5!1s0x6ad65d4dd5a05d97:0x3e64f855a564844d!8m2!3d-37.817251!4d144.955775!16s%2Fg%2F11g0g8c54h?entry=ttu"
                        class="text-decoration-none button"><?= Yii::t('app', 'Get Directions') ?><i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box mb-0">
                    <figure class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/3247/3247310.png" width="11%" alt="image" class="img-fluid">
                    </figure>
                    <h4><?= Yii::t('app', 'Phone Number') ?></h4>
                    <p class="text-size-16"><?= Yii::t('app', '+962790751376') ?></p>
                    <div class="clearfix"></div>
                    <a href="tel:+962790751376" class="text-decoration-none button"><?= Yii::t('app', 'Call us Now') ?>
                    <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box mb-0">
                    <figure class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/15047/15047587.png" alt="image" class="img-fluid" width="11%">
                    </figure>
                    <h4><?= Yii::t('app', 'Our Email') ?></h4>
                    <p class="text-size-16"><?= Yii::t('app', 'ahmad@relenas.com') ?></p>
                    <div class="clearfix"></div>
                    <a href="mailto:ahmad@relenas.com" class="text-decoration-none button"><?= Yii::t('app', 'Email us') ?>
                    
                    
                    <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- <style>


    .contactinfo-con {
        padding: 88px 0 130px;
    }

    .contactinfo-con .contactinfo_content h6 {
        margin-bottom: 17px;
    }

    .contactinfo-con .contactinfo_content h2 {
        margin-bottom: 52px;
    }

    .contactinfo-con .contact-box {
        padding: 42px 40px;
        background-color: var(--e-global-color-white);
        border: 1px solid var(--e-global-color-white);
        box-shadow: 0 12px 105px 12px rgb(0 0 0 / 3%);
        border-radius: 20px;
        transition: all 0.3s ease-in-out;
    }

    .contactinfo-con .contact-box:hover {
        border: 1px solid #0F172A;
    }

    .contactinfo-con .contact-box .icon {
        margin-bottom: 26px;
        display: inline-block;
        transition: all 0.3s ease-in-out;
    }

    .contactinfo-con .contact-box:hover .icon {
        transform: translateY(-5px);
    }

    .contactinfo-con .contact-box h4 {
        margin-bottom: 14px;
    }

    .contactinfo-con .contact-box p,
    .contactinfo-con .contact-box a {
        margin-bottom: 15px;
        display: inline-block;
        transition: all 0.3s ease-in-out;
    }

    .contactinfo-con .contact-box a:hover {
        color: #0F172A;
    }

    .contactinfo-con .contact-box .button {
        font-size: 14px;
        line-height: 14px;
        font-weight: 600;
        margin-bottom: 0 !important;
        position: relative;
        color: #0F172A;
        transition: all 0.3s ease-in-out;
    }

    .contactinfo-con .contact-box .button i {
        font-size: 12px;
        margin-left: 12px;
        transition: all 0.3s ease-in-out;
        color: #0F172A;
    }

    .contactinfo-con .contact-box .button:hover {
        color: var(--e-global-color-text);
    }

    .contactinfo-con .contact-box .button:hover i {
        transform: translateX(4px);
        color: var(--e-global-color-text);
    }


    @media screen and (max-width: 991px) {
        .contactinfo-con .contact-box {
            padding: 20px;
        }
    }



    @media screen and (max-width: 767px) {
        .contactinfo-con .contact-box {
            padding: 25px 45px;
            width: 330px;
            margin: 0 auto 30px;
            text-align: center;
        }
    }

    @media screen and (max-width: 575px) {
        .contactinfo-con .contact-box {
            width: 320px;
            margin: 0 auto 15px;
        }
    }
</style> -->
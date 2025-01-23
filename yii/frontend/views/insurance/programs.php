<?php

/** @var yii\web\View $this */
/** @var \frontend\models\InquiryForm $model */

use common\models\Countries;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = $insurance->name;


$language = Yii::$app->language;


$flashMessage = Yii::$app->session->getFlash('errorr');
if ($flashMessage) {
    $this->registerJs("
        $(document).ready(function() {
            $('#flashMessageContent').text('{$flashMessage}');
            $('#flashMessageModal').modal('show');
        });
    ");
}


?>





<!-- <style>
    .footer-color {
        background: #2DAE87;
    }

    .footer-btn {
        background: #415762;
    }


    .angle::after {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        top: -1px;
        left: 48%;
        background: #fff;
        clip-path: polygon(50% 50%, 0 0, 100% 0);
    }
</style> -->


<!--hero start-->


<section class="bg-primary-dark pt-9 <?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-slant-shape" data-cue="fadeIn">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-12">
                <div class="text-center text-lg-start mb-7 mb-lg-0 mt-3" data-cues="slideInDown">
                    <div class="mb-4">
                        <small class="text-uppercase ls-lg"><?= Yii::t('app', 'Immediate Insurance Coverage') ?></small>
                        <h1 class="mb-5 display-5 text-white-stable">
                            <?= Yii::t('app', 'Get Instant') ?>
                            <span class="text-warning"><?= ucwords(strtolower($language === 'ar' ? $insurance->name_ar : $insurance->name)) ?></span>
                        </h1>
                        <p class="mb-0 text-white-stable lead">
                            <?= Yii::t('app', $language === 'ar' ? $insurance->overview_ar : $insurance->overview) ?>
                        </p>
                    </div>
                    <div data-cues="slideInDown">
                        <a href="#booking" class="btn btn-primary me-2"><?= Yii::t('app', 'Get Started') ?></a>

                        <?=
                        Html::a(
                            '<i class="bi bi-arrow-down-square me-1"></i> Policy Wording',
                            Yii::$app->request->baseUrl . '/dashboard/images/' . $insurance->benefits_link,
                            [
                                'class' => 'btn btn-outline-warning',
                                'target' => '_blank',
                                'download' => $insurance->benefits_link,
                            ]
                        );
                        ?>



                    </div>
                </div>
            </div>
            <div class="offset-lg-1 col-lg-5 col-12">
                <div class="position-relative z-1 pt-lg-9" data-cue="slideInRight">
                    <div class="position-relative">
                        <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" alt="video" class="img-fluid rounded-3" width="837" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="" id="booking">
    <div class="container position-relative z-1 py-xl-9 py-6">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="row align-items-center g-5">

                    <?= $this->render('from', [
                        'model' => $model,

                        'insurance' => $insurance,

                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Testimonial start-->

<!-- <section class="my-xl-9 my-5">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-3"><?= Yii::t('app', 'Certified Insurance Companies') ?></h2>
                    <p class="mb-4">
                        <?= Yii::t('app', 'We’re proud to collaborate with top insurance companies, matching you with experts for tailored solutions.') ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-8 ">
                <div class="row">
                    <?php foreach (\common\models\InsuranceCountries::find()->where(['insurance_id' => $insurance->id])->all() as $Countries) : ?>
                        <div class="col" data-cue="slideInLeft">
                            <figure class="text-center">
                                <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $Countries->company_logo ?>" alt="<?= Yii::t('app', 'Company Logo') ?>" width="110" />
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!--Testimonial end-->

<!--5m member start-->
<!-- <section class="pt-xl-9 py-5 bg-primary-dark">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-12">
                <div class="text-center mb-xl-7 mb-5">
                    <h2 class="text-white-stable mb-3">Explore with Confidence: <span class="text-warning">Travel Insurance</span></h2>
                    <p class="mb-0 text-white-50">
                        Ensure worry-free adventures with our comprehensive travel insurance plans. Whether you're embarking on a family vacation, solo expedition, or business trip, we've got you covered with protection against unexpected mishaps and emergencies.
                    </p>
                </div>
            </div>
        </div>
        <div class="row mb-7 pb-4 g-5 text-center text-lg-start">
            <div class="col-md-4" data-cue="fadeIn">
                <img src="/images/4066885_building_company_coverage_insurance_office_icon.png" width="80" />
                <h4 class="text-white-stable">Medical Assistance</h4>
                <p class="text-white-50 mb-3">Stay protected against unforeseen medical emergencies while traveling.</p>
                <ul class="text-white-50">
                    <li>Medical Expenses Coverage</li>
                    <li>Emergency Medical Evacuation</li>
                    <li>24/7 Medical Assistance</li>
                </ul>
            </div>
            <div class="col-md-4" data-cue="fadeIn">
                <img src="/images/4066893_coverage_insurance_liability_protect_travel_icon.png" width="80" />
                <h4 class="text-white-stable">Trip Protection</h4>
                <p class="text-white-50 mb-3">Safeguard your investment with coverage for trip cancellations and interruptions.</p>
                <ul class="text-white-50">
                    <li>Trip Cancellation & Interruption Insurance</li>
                    <li>Travel Delay Reimbursement</li>
                    <li>Baggage Delay/Loss Coverage</li>
                </ul>
            </div>
            <div class="col-md-4" data-cue="fadeIn">
                <img src="/images/4066902_coverage_insurance_liability_professional_protection_icon.png" width="80" />
                <h4 class="text-white-stable">Enhanced Coverage</h4>
                <p class="text-white-50 mb-3">Elevate your travel experience with added protection and convenience.</p>
                <ul class="text-white-50">
                    <li>Cancel for Any Reason (CFAR) Coverage</li>
                    <li>Enhanced Baggage Protection</li>
                    <li>Personal Liability Coverage</li>
                </ul>
            </div>
        </div>
    </div>
</section> -->
<!--5m member end-->





<!--5m member start-->
<!-- <section class="pt-xl-9 py-5 bg-primary-dark">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-12">
                <div class="text-center mb-xl-7 mb-5">
                    <h2 class="text-white-stable mb-3">Protect with Confidence: <span class="text-warning"><?= $insurance->name ?></span></h2>
                    <p class="mb-0 text-white-50">
                        <?= $insurance->description ?> </p>
                </div>
            </div>
        </div>

    </div>
</section> -->
<!--5m member end-->




<!--5m member start--><!--5m member start-->
<section class="pt-xl-9 py-5 bg-primary-dark">
    <div class="container" data-cue="fadeIn">
        <!-- <div class="row">
            <div class="col-xl-8 offset-xl-2 col-12" data-cue="fadeIn">
                <div class="text-center mb-xl-7 mb-5">
                    <h2 class="text-white-stable mb-3">
                        <?= Yii::t('app', 'Protect with Confidence: <span class="text-warning">Travel Insurance</span>') ?>
                    </h2>
                    <p class="mb-0 text-white-50">
                        <?= Yii::t('app', 'Ensure worry-free living with our comprehensive insurance plans. Whether you need health, life, auto, or home insurance, we\'ve got you covered with protection against unexpected events and emergencies.') ?>
                    </p>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="text-center mb-xl-7 mb-5">
                    <h2 class="text-white-stable mb-3">
                        <?= Yii::t('app', 'Protect with Confidence: <span class="text-warning">Travel Assurance</span>') ?>
                    </h2>
                    <p class="mb-0 text-white-50">
                        <?= Yii::t('app', 'Ensure worry-free living with our comprehensive assurance plans. Whether you need health, life, auto, or home
assurance, we\'ve got you covered with protection against unexpected events and emergencies.') ?>
                    </p>
                </div>
            </div>
        </div>


        <!-- <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-2"><?= Yii::t('app', 'Insurances') ?></h2>
                    <p class="mb-0"><?= Yii::t('app', 'Explore various related insurance options that might suit your needs.') ?></p>
                </div>
            </div>
        </div> -->



        <div class="row mb-7 pb-4 g-5 text-center text-lg-start">

            <div class="col-md-4" data-cue="fadeIn" data-duration="1000">
                <img width="80" height="80" src="/images/icons8-travel-insurance-64 (1).png" class="mb-2" alt="Travel Assurance" />
                <h4 class="text-white-stable"><?= Yii::t('app', 'Travel Assurance') ?></h4>
                <p class="text-white-50 mb-3"><?= Yii::t('app', 'Stay protected against unforeseen medical emergencies.') ?></p>
                <ul class="text-white-50 d-none d-md-block">
                    <li><?= Yii::t('app', 'Accidental & Sickness Medical Reimbursement.') ?></li>
                    <li><?= Yii::t('app', 'Emergency Medical Evacuation') ?></li>
                    <li><?= Yii::t('app', '24/7 Medical Assistance') ?></li>
                </ul>
                <span class="d-block d-md-none text-white-50">
                    <?= Yii::t('app', 'Accidental & Sickness Medical Reimbursement.') ?><br>
                    <?= Yii::t('app', 'Emergency Medical Evacuation') ?><br>
                    <?= Yii::t('app', '24/7 Medical Assistance') ?>
                </span>
            </div>

            <div class="col-md-4" data-cue="fadeIn" data-duration="1000">
                <img width="70" height="70" src="/images/education (4).png" class="mb-2" alt="Travel Assurance" />
                <h4 class="text-white-stable"><?= Yii::t('app', 'Student Assurance') ?></h4>
                <p class="text-white-50 mb-3"><?= Yii::t('app', 'Student Assurance offers comprehensive protection for students.') ?></p>
                <ul class="text-white-50 d-none d-md-block">
                    <li><?= Yii::t('app', 'Coverage for Personal Accidents') ?></li>
                    <li><?= Yii::t('app', 'Emergency Medical Evacuation & Repatriation.') ?></li>
                    <li><?= Yii::t('app', 'Protection against Travel Inconveniences.') ?></li>
                </ul>

                <span class="d-block d-md-none text-white-50">
                    <?= Yii::t('app', 'Coverage for Personal Accidents') ?><br>
                    <?= Yii::t('app', 'Emergency Medical Evacuation & Repatriation.') ?><br>
                    <?= Yii::t('app', 'Protection against Travel Inconveniences.') ?>
                </span>
            </div>
            <div class="col-md-4" data-cue="fadeIn" data-duration="1000">
                <img width="80" height="80" src="/images/icons8-health-insurance-64 (1).png" class="mb-2" alt="Health Assurance" />
                <h4 class="text-white-stable"><?= Yii::t('app', 'Cancellation Assurance') ?></h4>
                <p class="text-white-50 mb-3"><?= Yii::t('app', 'Cancellation Assurance covers non-refundable travel expenses in case of trip changes.') ?></p>
                <ul class="text-white-50 d-none d-md-block">
                    <li><?= Yii::t('app', 'Recover Non-Refundable Flight Tickets.') ?></li>
                    <li><?= Yii::t('app', 'Reimbursement for Accommodation.') ?></li>
                    <li><?= Yii::t('app', 'Coverage for Rail & Cruise Cancellations.') ?></li>
                </ul>

                <span class="d-block d-md-none text-white-50">
                    <?= Yii::t('app', 'Recover Non-Refundable Flight Tickets') ?><br>
                    <?= Yii::t('app', 'Reimbursement for Accommodation.') ?><br>
                    <?= Yii::t('app', 'Coverage for Rail & Cruise Cancellations.') ?>
                </span>
            </div>




        </div>
    </div>
</section>

<!--5m member end-->



<!-- 
<section class="my-xl-7 py-5">


    <div class="container" data-cue="fadeIn">
        <div class="row" >
            <div class="col-lg-8 offset-lg-2" data-cue="fadeIn">
                <div class="text-center mb-7 pb-2">
                    <h2 class="mb-3">Certified Insurance Companies</h2>
                    <p class="mb-4">
                        We’re proud to collaborate with top insurance companies, matching you with experts for tailored solutions.
                    </p>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="row row row-cols-2 row-cols-lg-4 row-cols-md-3 justify-content-center g-5">

                    <?php foreach (\common\models\InsuranceCountries::find()->all() as $Countries) : ?>
                        <div class="col" data-cue="slideInLeft">
                            <figure class="text-center">
                                <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $Countries->company_logo ?>" alt="Company Logo" width="110" />
                            </figure>
                        </div> <?php endforeach; ?>




                </div>
            </div>
        </div>
    </div>
</section> -->


<!--Get block card start-->

<!--Get block card start-->
<section class="my-xl-7 py-5">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-5 text-center">
                    <h2 class="mb-3">
                        <?= Yii::t('app', 'How to Obtain Assurance in 3 Easy Steps') ?>
                    </h2>
                    <p class="mb-0"><?= Yii::t('app', 'Secure your trip in three easy steps: compare plans, choose coverage, and buy') ?></p>
                </div>
            </div>
        </div>
        <div class="table-responsive-xl">
            <div class="row flex-nowrap pb-4 pb-lg-0 me-5 me-lg-0">
                <div class="col-lg-4 col-md-6 col-12" data-cue="slideInLeft">
                    <div class="p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <div class="icon-xl icon-shape rounded-circle bg-warning border border-warning-subtle border-4 text-dark fw-semibold fs-3">1</div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right text-body-tertiary" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                            </span>
                        </div>
                        <h3 class="h4"><?= Yii::t('app', 'Compare Plans') ?></h3>
                        <p class="mb-0"><?= Yii::t('app', 'Evaluate different plan options to find the most suitable coverage for your needs.') ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12" data-cue="slideInLeft">
                    <div class="p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <div class="icon-xl icon-shape rounded-circle bg-warning border border-warning-subtle border-4 text-dark fw-semibold fs-3">2</div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right text-body-tertiary" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                            </span>
                        </div>
                        <h3 class="h4"><?= Yii::t('app', 'Choose Coverage') ?></h3>
                        <p class="mb-0"><?= Yii::t('app', 'Select the type of assurance you need, such as Travel, Student, Adventure, Shop, Cancellation assurance, and more.') ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12" data-cue="slideInLeft">
                    <div class="p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-5">
                            <div class="icon-xl icon-shape rounded-circle bg-warning border border-warning-subtle border-4 text-dark fw-semibold fs-3">3</div>
                        </div>
                        <h3 class="h4"><?= Yii::t('app', 'Purchase Assurance') ?></h3>
                        <p class="mb-0"><?= Yii::t('app', 'Finalize your Assurance purchase online to ensure comprehensive protection.') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!--Get block card end-->
<!--Get block card end-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.js-flatpickr', {
            dateFormat: "d/m/Y",
            minDate: 'today'
        });
    });
</script>
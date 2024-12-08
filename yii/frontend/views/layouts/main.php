<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;
$languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr';
$language = Yii::$app->language;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>



<html lang="<?= Yii::$app->language ?>" dir="<?= Yii::$app->language === 'ar' ? 'rtl' : 'ltr' ?>">
<!-- <p>Current language: <?= Yii::$app->language ?></p> -->





<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="msapplication-TileColor" content="#8b3dff" />
    <meta name="msapplication-config" content="/images/logo/logo-dark.png" />
    <meta name="description" content="Protect your adventures with our specialized travel and luggage insurance. Get peace of mind with tailored coverage for your trips, including health, delays, and lost baggage. Explore our options today for a worry-free journey.">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preload" href="/images/logo/logo-dark.png" as="image">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/facts/fact-4/assets/css/fact-4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">







    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    <!--hero start-->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->

    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->



    <!-- <link rel="shortcut icon" href="favicon.ico" />

<link rel="icon" type="image/x-icon" href="favicon.ico" /> -->
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />

    <!-- 

<link rel="shortcut icon" href="favicon.ico" />

<link rel="icon" type="image/x-icon" href="favicon.ico" />  -->

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- <script src="/js/vendors/color-modes.js"></script> -->

</head>

<body>
    <?php $this->beginBody() ?>
    <header>
    <nav class="navbar navbar-expand-lg transparent navbar-transparent navbar-dark">
    <div class="container px-3">
        <a class="navbar-brand" href="/"><img class="img-fluid" width="100"  height="120" src="<?= Yii::$app->request->baseUrl ?>/images/logo/logo-dark.png" alt="<?= Yii::t('app', '360Protect') ?>" /></a>
        <button class="navbar-toggler offcanvas-nav-btn" type="button" aria-label="<?= Yii::t('app', 'Toggle navigation') ?>">
            <i class="bi bi-list"></i>
        </button>

        <div class="offcanvas offcanvas-start offcanvas-nav" style="width: 20rem">
            <div class="offcanvas-header" >
                <a href="/" class="text-inverse"><img class="img-fluid" width="100"  height="120" src="<?= Yii::$app->request->baseUrl ?>/images/logo/logo-dark.png" alt="<?= Yii::t('app', '360Protect') ?>" /></a>
            <div dir="ltr"> <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="<?= Yii::t('app', 'Close') ?>"></button>
            </div></div>   
            <div class="offcanvas-body pt-0 align-items-center">
                <ul class="navbar-nav navbar-nav-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?> mx-auto align-items-lg-center">
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= Yii::t('app', 'Countries') ?></a>
                      <ul class="dropdown-menu">
                            <?php
                            $countries = \common\models\InsuranceCountries::find()
                                ->select(['source_country', 'slug'])
                                ->distinct()
                                ->all();
                            ?>

                            <?php foreach ($countries as $country) : ?>
                                <li>
                                    <?= Html::a(
                                        Yii::t('app', ucwords(strtolower($country->source_country))),
                                        ['/site/index', 'slug' => $country->slug],
                                        ['class' => 'dropdown-item', 'data-cue' => 'fadeUp']
                                    ) ?>
                                </li> <?php endforeach; ?>

                        </ul>
                        <?php
                            $countries = $language === 'ar' ? \common\models\InsuranceCountries::find()
                                ->select(['source_country_ar', 'slug'])
                                ->distinct()
                                ->all(): \common\models\InsuranceCountries::find()
                                ->select(['source_country', 'slug'])
                                ->distinct()
                                ->all();
                            ?>

                        <ul class="dropdown-menu">
    <?php foreach ($countries as $country) : ?>
        <li>
            <?php
           
          

          
            $countryName = $language === 'ar' 
                ? $country->source_country_ar   
                : $country->source_country;    

           
            echo Html::a(
                Yii::t('app', ucwords(strtolower($countryName))),
                ['/site/index', 'slug' => $country->slug],
                ['class' => 'dropdown-item', 'data-cue' => 'fadeUp']
            );
            ?>
        </li>
    <?php endforeach; ?>
</ul>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= Yii::t('app', 'Types of Assurances') ?></a>
                        <ul class="dropdown-menu">
                            <?php foreach (\common\models\Insurances::find()->all() as $insurance) : ?>
                                <li>
                                    <?= Html::a(Yii::t('app', ucwords(strtolower( $language === 'ar' ?$insurance->name_ar:$insurance->name))), ['/insurance/programs', 'slug' => $insurance->slug], ['class' => 'dropdown-item', 'data-cue' => 'fadeUp']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= Yii::t('app', 'Company') ?></a>

                        <ul class="dropdown-menu">
                        <li>
                                <?= Html::a(Yii::t('app', 'Contact Us'), ['/asurance/contact'], ['class' => 'dropdown-item', 'data-cue' => 'fadeUp']) ?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app', 'Terms & Conditions'), ['/asurance/terms'], ['class' => 'dropdown-item', 'data-cue' => 'fadeUp']) ?>
                            </li>
                          
                        </ul>
                    </li>

                    <li class="nav-item">
                        <?= Html::a(Yii::t('app', 'Check Policy'), ['/asurance/check'], ['class' => 'nav-link', 'data-cue' => 'fadeUp']) ?>
                    </li>

                        
                    <li class="nav-item">
    <?= Html::a(Yii::t('app', 'Claim'), '#', [
        'class' => 'nav-link',
        'data-bs-toggle' => 'modal',
        'data-bs-target' => "#exampleModal",
        'data-cue' => 'fadeUp',
    ]) ?>
</li>                  

                </ul>

                <div class="mt-3 mt-lg-0 d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="btn btn-outline-light lang dropdown-toggle" id="dropdownLanguage" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-translate "></i> <?= Yii::$app->language == 'en-US' ? Yii::t('app', 'English') : Yii::t('app', 'Arabic') ?>
                        </a>
                        <ul class="dropdown-menu">



    <li>
    <a class="dropdown-item <?= Yii::$app->language == 'en-US' ? 'active' : '' ?>" 
       href="<?= \yii\helpers\Url::current(['language' => 'en-US']) ?>">
        <?= Yii::t('app', 'English') ?>
    </a>
</li>
<li>
    <a class="dropdown-item <?= Yii::$app->language == 'ar' ? 'active' : '' ?>" 
       href="<?= \yii\helpers\Url::current(['language' => 'ar']) ?>">
        <?= Yii::t('app', 'Arabic') ?>
    </a>
</li>

</ul>


                    </div>   
                    <a href="/" class="me-2"><img src="<?= Yii::$app->request->baseUrl ?>/images/jordan.png" alt="<?= Yii::t('app', 'Company Logo') ?>" class="bg-white rounded" width="120">
                    </a>
              
                </div>
         

                <!-- <div class="mt-3 mt-lg-0 d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="btn btn-outline-light dropdown-toggle" id="dropdownLanguage" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-translate "></i> <?= Yii::$app->language == 'en-US' ? Yii::t('app', 'English') : Yii::t('app', 'العربية') ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item <?= Yii::$app->language == 'en-US' ? 'active' : '' ?>" href="<?= Yii::$app->urlManager->createUrl(['site/index', 'language' => 'en-US']) ?>">
                                    <?= Yii::t('app', 'English') ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= Yii::$app->language == 'ar' ? 'active' : '' ?>" href="<?= Yii::$app->urlManager->createUrl(['site/index', 'language' => 'ar']) ?>">
                                    <?= Yii::t('app', 'العربية') ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</nav>

    </header>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header m-2 mb-3">
                <h4 class="modal-title " id="claim-modal-label"><b><?= Yii::t('app', 'Claim Process') ?></b></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-2">
            <p>Please download <?= Html::a('the Claim Form', ['images/Claim form JOFICO.pdf'], [
    'class' => 'text-dark',
    'download' => true,
]) ?> and attach a good scan copy of the following documents:</p>

                <ol class="text-start" >
                    <li>Copy of flight itinerary</li>
                    <li>Certificate of assurance</li>
                    <li>Original medical reports from the treating doctor</li>
                    <li>Original bills/receipts issued by the clinic or hospital</li>
                </ol>
                <p><b>Medical report must show the following information:</b></p>
                <ul class="text-start" >
                    <li>Symptoms presented with</li>
                    <li>Past medical history (if any)</li>
                    <li>Vital signs at the time of examination</li>
                    <li>Investigation/laboratory reports with X-ray/CT/MRI (if performed)</li>
                    <li>Medications given</li>
                    <li>Diagnosis</li>
                </ul>
                <p>Please note we may require other documents, which we will advise upon evaluating your case.</p>
                <p>
                    Kindly send an email with the subject as the Policy number, briefly request reimbursement, 
                    and attach the Claim Form and other required documents to the following email address:
                </p>
                <span class="mb-3"><i class="bi bi-envelope-at me-1 text-warning fs-4"></i><a class="text-dark" href="mailto:mena-claims@amaglobalassistance.com">mena-claims@amaglobalassistance.com</a></span>
                
            </div>
        </div>
    </div>
</div>















<!-- Modal HTML -->


    <!-- 
    <style>


        #preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(2, 6, 23, 0.1);
}
#loader {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #00112C;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}
#loader:before {
    content: "";
    position: absolute;
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #FFC107;
    -webkit-animation: spin 3s linear infinite;
    animation: spin 3s linear infinite;
}
#loader:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    border-top-color: #FFFFFF;
    -webkit-animation: spin 1.5s linear infinite;
    animation: spin 1.5s linear infinite;
}
@-webkit-keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes spin {
    0%   {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
</style> -->
    <div id="main-wrapper">


        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>


    </div>
    <!-- <div id="preloader">
  <div id="loader"></div>
</div> -->

    <footer class="pt-7 border border-1">
        <div class="container ">
            <!-- Footer 4 column -->
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-lg-5 col-md-7">
                    <div class="mb-7 mb-xl-0">
                        <div class="mb-4">
                            <a href="/">
                                <img class="img-fluid" width="80" height="auto" src="/images/logo/logo-dark.png" alt="360Protect" loading="eager">
                            </a>
                        </div>
                        <p class="mb-5 mt-2"><?= Yii::t('app', 'Safeguard your travels through our assurance companies partners. Whether you\'re
embarking on a new Adventure, Shopping, Study, or simply seeking peace of mind, our
goal is to offer tailored coverage that meets your unique needs.') ?></p>
                        <div class="text-md-end d-flex align-items-center justify-content-md-start">
                            <div class=" d-flex gap-2">
                                <a href="#!" class="text-reset btn btn-instagram btn-icon" aria-label="Follow us on Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                    </svg>
                                </a>
                                <a href="#!" class="text-reset btn btn-facebook btn-icon" aria-label="Follow us on Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                    </svg>
                                </a>
                                <a href="#!" class="text-reset btn btn-twitter btn-icon" aria-label="Follow us on Twitter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" offset-xxl-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-xxl-6 col-lg-6 offset-md-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-md-4 ">
                    <div class="row" id="ft-links">
                        <div class="col-lg-4 col-12">
                            <div class="position-relative">
                                <div class="mb-3 pb-2 d-flex justify-content-between border-bottom border-bottom-lg-0">
                                    <h5> <?= Yii::t('app', 'Types of Assurances') ?></h5>


                                   
                                    <a class="d-block d-lg-none text-inherit" data-bs-toggle="collapse" href="#collapseLanding" role="button" aria-expanded="false" aria-controls="collapseLanding" aria-label="Toggle collapse">
                                        <i class="bi bi-chevron-down"></i>
                                    </a>

                                </div>
                                <div class="collapse d-lg-block" id="collapseLanding" data-bs-parent="#ft-links">
                                <ul class="list-unstyled mb-0 py-3 py-lg-0 px-0">
                                        <?php foreach (\common\models\Insurances::find()->limit(6)->all() as $insurance) : ?>
                                            <li class="mb-2">
                                                <?= Html::a(Yii::t('app',  ucwords(strtolower($language === 'ar' ?$insurance->name_ar:$insurance->name))), ['/insurance/programs', 'slug' => $insurance->slug],
                                                 ['class' => 'text-decoration-none', 'style' => 'color:#64748B;']) ?>

                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="mb-3 pb-2 d-flex justify-content-between border-bottom border-bottom-lg-0">
                                <h5> <?= Yii::t('app', 'Countries') ?></h5>
                                <a class="d-block d-lg-none  text-inherit" data-bs-toggle="collapse" href="#collapseResources" role="button" aria-expanded="false" aria-controls="collapseResources" aria-label="Toggle collapse">
                                    <i class="bi bi-chevron-down"></i>
                                </a>
                            </div>
                            <div class="collapse d-lg-block" id="collapseResources" data-bs-parent="#ft-links">
                            <?php

$language = Yii::$app->language;


$countries = $language === 'ar'
    ? \common\models\InsuranceCountries::find()
        ->select(['source_country_ar AS source_country', 'slug'])
        ->distinct()
        ->limit(5)
        ->all()
    : \common\models\InsuranceCountries::find()
        ->select(['source_country', 'slug'])
        ->distinct()
        ->limit(5)
        ->all();
?>
 <ul class="list-unstyled mb-0 py-3 py-lg-0 p-0">
    
 
 
 <?php foreach ($countries as $country) : ?>
    <li class="mb-2">
            <?php
         
            $countryName = $language === 'ar' 
                ? $country->source_country  
                : $country->source_country;  
            
                 echo Html::a(
                Yii::t('app', ucwords(strtolower($countryName))),
                ['/site/index', 'slug' => $country->slug],
                ['class' => 'text-decoration-none', 'style' => 'color:#64748B;']
            );
            ?>
        </li>
    <?php endforeach; ?>
</ul>
                            </div>
                        </div>


                        <div class="col-lg-4 col-12">
                            <div class="mb-3 pb-2 d-flex justify-content-between border-bottom border-bottom-lg-0 position-relative">
                                <h5><?= Yii::t('app', 'Company') ?></h5>
                                <a class="d-block d-lg-none  text-inherit" data-bs-toggle="collapse" href="#collapseAccounts" role="button" aria-expanded="false" aria-controls="collapseAccounts" aria-label="Toggle collapse">
                                    <i class="bi bi-chevron-down"></i>
                                </a>
                            </div>
                            <div class="collapse d-lg-block" id="collapseAccounts" data-bs-parent="#ft-links">
                            <ul class="list-unstyled mb-0 py-3 py-lg-0 px-0">
                                    <li class="mb-2">

                                        <?= Html::a(Yii::t('app', 'Check Policy'), ['/asurance/check'], ['class' => 'text-decoration-none ', 'style' => 'color:#64748B;']) ?>

                                    </li>


                                </ul>
                            </div>
                            <div class="collapse d-lg-block" id="collapseAccounts" data-bs-parent="#ft-links">
                                <ul class="list-unstyled mb-0 py-3 py-lg-0 px-0">
                                    <li class="mb-2">

                                        <?= Html::a(Yii::t('app', 'Contact us'), ['/asurance/contact'], ['class' => 'text-decoration-none ', 'style' => 'color:#64748B;']) ?>

                                    </li>


                                </ul>
                            </div>

                            <div class="collapse d-lg-block" id="collapseAccounts" data-bs-parent="#ft-links">
                                <ul class="list-unstyled mb-0 py-3 py-lg-0 px-0">
                                    <li class="mb-2">

                                        <?= Html::a(Yii::t('app', 'Terms &
Conditions'), ['/asurance/terms'], ['class' => 'text-decoration-none ', 'style' => 'color:#64748B;']) ?>

                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-7 mb-3">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <!-- <div class="small mb-3 mb-md-0">
                        Copyright © 2024

                        <span class="text-primary"><a href="#">Block Bootstrap 5 Theme</a></span>
                        | Designed by
                        <span class="text-primary"><a href="#">CodesCandy</a></span>
                    </div> -->
                </div>
                <div class="col-md-3">
                    <!-- <div class="text-md-end d-flex align-items-center justify-content-md-end">
                        <div class="dropdown">
                            <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
                                <i class="bi theme-icon-active"></i>
                                <span class="visually-hidden bs-theme-text">Toggle theme</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bs-theme-text">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                                        <i class="bi theme-icon bi-sun-fill"></i>
                                        <span class="ms-2">Light</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                                        <i class="bi theme-icon bi-moon-stars-fill"></i>
                                        <span class="ms-2">Dark</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                                        <i class="bi theme-icon bi-circle-half"></i>
                                        <span class="ms-2">Auto</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="ms-3 d-flex gap-2">
                            <a href="#!" class="text-reset btn btn-instagram btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                </svg>
                            </a>
                            <a href="#!" class="text-reset btn btn-facebook btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg>
                            </a>
                            <a href="#!" class="text-reset btn btn-twitter btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                </svg>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Scroll top -->
    <div class="btn-scroll-top">
        <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
            <path d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z" />
        </svg>
    </div>
    <?php $this->endBody() ?>

    <!-- <script>

</script> -->
    <!-- <script>


document.addEventListener("DOMContentLoaded", function() {

    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        document.getElementById('preloader').style.display = 'flex';
    });


    window.onload = function() {
        document.getElementById('preloader').style.display = 'none';
    };
});



</script> -->

</body>
<!-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    flatpickr('.js-flatpickr', {
      dateFormat: "d/m/Y",
      minDate: 'today',
      enableTime: false,
      wrap: false,
      disableMobile: "true"
    });

 
    const savedDate = localStorage.getItem('savedDate');
    if (savedDate) {
      document.querySelector('.js-flatpickr')._flatpickr.setDate(savedDate);
    }

   
    document.querySelector('.js-flatpickr')._flatpickr.config.onChange.push(function(selectedDates, dateStr) {
      localStorage.setItem('savedDate', dateStr);
    });

    document.getElementById('next-button').addEventListener('click', function() {
      localStorage.removeItem('savedDate'); 
    });
  });
</script> -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.js-flatpickr', {
            dateFormat: "d/m/Y",
            minDate: 'today',
            enableTime: false,
            wrap: false,
            disableMobile: "true"
        });

        const savedDate = localStorage.getItem('savedDate');
        if (savedDate) {
            document.querySelector('.js-flatpickr')._flatpickr.setDate(savedDate);
        }

        document.querySelector('.js-flatpickr')._flatpickr.config.onChange.push(function(selectedDates, dateStr) {
            localStorage.setItem('savedDate', dateStr);
        });

        // const form = document.getElementById('nextt');
        // form.addEventListener('submit', function(event) {

        //   localStorage.removeItem('savedDate');


        // });

        
    });
</script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var isRtl = '<?= Yii::$app->language ?>' === 'ar';
            var elements = document.querySelectorAll('.text-lg-start, .text-lg-end');
            
            elements.forEach(function(element) {
                if (isRtl) {
                    element.classList.remove('text-lg-start');
                    element.classList.add('text-lg-end');

                    element.classList.remove('border-end-lg');
                    // element.classList.add('border-start-lg');
                } else {
                    element.classList.remove('text-lg-end');
                    element.classList.add('text-lg-start');
                }
            });



            var marginElements = document.querySelectorAll('.ms-2, .me-2');
    marginElements.forEach(function(element) {
        if (isRtl) {
            element.classList.remove('ms-2');
            element.classList.add('me-2');
        } else {
            element.classList.remove('me-2');
            element.classList.add('ms-2');
        }
    });
    


            var isRtl = '<?= Yii::$app->language ?>' === 'ar';
            var elements = document.querySelectorAll('.border-end-lg, .border-start-lg');
            elements.forEach(function(element) {
                if (isRtl) {
                    element.classList.remove('border-end-lg');
                    element.classList.add('border-start-lg');
                } else {
                    element.classList.remove('border-start-lg');
                    element.classList.add('border-end-lg');
                }
            });


        });

        // fa-arrow-right
            document.addEventListener('DOMContentLoaded', function() {
            var isRtl = '<?= Yii::$app->language ?>' === 'ar';
            var arrows = document.querySelectorAll('.bi-arrow-right');
            arrows.forEach(function(arrow) {
                if (isRtl) {
                    arrow.style.transform = 'rotate(180deg)';
                    arrow.style.transformOrigin = 'center';
                } else {
                    arrow.style.transform = 'none';
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            var isRtl = '<?= Yii::$app->language ?>' === 'ar';
            var arrows = document.querySelectorAll('.fa-arrow-right');
            arrows.forEach(function(arrow) {
                if (isRtl) {
                    arrow.style.transform = 'rotate(180deg)';
                    arrow.style.transformOrigin = 'center';
                } else {
                    arrow.style.transform = 'none';
                }
            });
        });


        // document.addEventListener('DOMContentLoaded', function() {
        //     var isRtl = '<?= Yii::$app->language ?>' === 'ar';
        //     var elements = document.querySelectorAll('.text-lg-start, .text-lg-end');
        //     elements.forEach(function(element) {
        //         if (isRtl) {
        //             element.classList.remove('text-lg-start');
        //             element.classList.add('text-lg-end');

        //             element.classList.remove('border-end-lg');
                    
        //         } else {
        //             element.classList.remove('text-lg-end');
        //             element.classList.add('text-lg-start');
        //         }
        //     });
        // });

        
        document.addEventListener('DOMContentLoaded', function() {
    var isRtl = '<?= Yii::$app->language ?>' === 'ar';
    var elements = document.querySelectorAll('.text-start, .text-end'); // Updated selectors to match your HTML

    elements.forEach(function(element) {
        if (isRtl) {
            element.classList.remove('text-start');
            element.classList.add('text-end');

            element.classList.add('border-start-lg'); 
            element.classList.remove('border-end-lg'); 
        } else {
            element.classList.remove('text-end');
            element.classList.add('text-start');

            element.classList.add('border-end-lg'); 
            element.classList.remove('border-start-lg'); 
        }
    });
});


        
    </script>




<!-- Modal HTML -->

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.7/countUp.min.js"></script> -->

</html>
<?php $this->endPage();

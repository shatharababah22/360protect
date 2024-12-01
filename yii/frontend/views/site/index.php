<?php

/** @var yii\web\View $this */
/** @var \frontend\models\InquiryForm $model */

use common\models\Countries;
use common\models\Customers;
use common\models\InsuranceCountries;
use common\models\Insurances;
use common\models\Policy;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


// $insurance_name = ($insurance !== null) ? htmlspecialchars($insurance->name, ENT_QUOTES, 'UTF-8') : $country->insurance->name;
$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js');

$this->title = '360Protect';



$flashMessage = Yii::$app->session->getFlash('errorr');
if ($flashMessage) {
    $this->registerJs("
        $(document).ready(function() {
            $('#flashMessageContent').text('{$flashMessage}');
            $('#flashMessageModal').modal('show');
        });
    ");
}

$language = Yii::$app->language;
?>

<!-- <style>
    .footer-color {
        background: #2DAE87;
        height: 50%;
    }

    .footer-btn {
        background: #415762;
    }




    .angle::after {
        position: absolute;
        content: "";
        height: 10px;
        width: 20px;
        top: -1px;
        left: 48%;
        background: #fff;
        clip-path: polygon(50% 50%, 0 0, 100% 0);
    }






    #hidden-insurances {
        display: none;
    }



    .carousel-control-prev i,
    .carousel-control-next i {
        font-size: 36px;
        position: absolute;
        top: 50%;
        display: inline-block;
        margin: -19px 0 0 0;
        z-index: 5;
        left: 0;
        right: 0;
        color: #fff;
        text-shadow: none;
        font-weight: bold;
    }

    .carousel-control-prev i {
        margin-left: -2px;
    }

    .carousel-control-next i {
        margin-right: -4px;
    }

    .carousel-indicators {
        bottom: -50px;
    }

    .carousel-indicators li,
    .carousel-indicators li.active {
        width: 10px;
        height: 10px;
        margin: 4px;
        border-radius: 50%;
        border: none;
    }

    .carousel-indicators li {
        background: rgba(0, 0, 0, 0.2);
    }

    .carousel-indicators li.active {
        background: rgba(0, 0, 0, 0.6);
    }


    .star-rating li {
        padding: 0;
    }

    .star-rating i {
        font-size: 14px;
        color: #ffc000;
    }

    .carousel-item {
        transition: transform 1.2s ease-in-out;
    }

    
</style> -->


<!-- Include Bootstrap JS (Ensure it's the right version) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('#carouselExampleControls');
    const carouselInstance = bootstrap.Carousel.getOrCreateInstance(carousel, {
        interval: 5000, 
        ride: 'carousel'
    });

    const prevButton = document.querySelector('#prevButton');
    const nextButton = document.querySelector('#nextButton');

    prevButton.addEventListener('click', function() {
        carouselInstance.prev();
    });

    nextButton.addEventListener('click', function() {
        carouselInstance.next();
    });
});

</script> -->


<section class="bg-primary-dark pt-9 <?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-slant-shape" data-cue="fadeIn">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-12 mb-4">
                <div class="text-center text-lg-start mb-lg-4 mb-lg-0 mt-5" data-cues="slideInDown">
                    <div class="mb-4">
                        <h2 class="mb-5 display-6 text-white-stable">
                            <?= Yii::t('app', 'Claim your assurance online') ?>
                            <span class="text-pattern-line text-warning"> <?= Yii::t('app', 'within minutes') ?></span>
                        </h2>
                        <p class="mb-0 text-white-50">
                            <?= Yii::t('app', 'Worldwide coverage including Schengen – All our assurance covers COVID-19 100%.Accepted by all Embassies.') ?>
                        </p>
                    </div>
                    <?php if ($country !== null) : ?>
                        <div class="slideInDown d-md-block">
                            <!-- <a href="#" class="btn btn-primary"><?= Yii::t('app', 'Get Covered Now') ?></a> -->
                            <a href="#insurances_programs" class="btn btn-outline-warning me-2"><?= Yii::t('app', 'Explore Programs') ?></a>
                            <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $country->company_logo ?>" alt="<?= Yii::t('app', 'Company Logo') ?>" class="bg-white rounded" width="120">
                        </div>
                    <?php else : ?>
                        <a href="/asurance/about" class="btn btn-primary"><?= Yii::t('app', 'Show more') ?></a>
                        <a href="#insurances_programs" class="btn btn-outline-warning"><?= Yii::t('app', 'Explore Programs') ?></a>
                    <?php endif; ?>
                </div>
                <!-- <div class="col-12 d-flex justify-content-center d-md-none ">
                    <a href="#" class="btn btn-primary me-2"><?= Yii::t('app', 'Get Covered Now') ?></a>
                    <a href="#insurances_programs" class="btn btn-outline-warning"><?= Yii::t('app', 'Explore Programs') ?></a>
                </div> -->
                <!-- <?php if ($country !== null) : ?>
                    <div class="country-details d-flex justify-content-center justify-content-lg-start mb-4 mb-lg-0">
                        <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $country->company_logo ?>" alt="<?= Yii::t('app', 'logo') ?>" width="120" class="mt-4">
                    </div>
                <?php endif; ?> -->
            </div>
            <!-- <?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr'; ?> -->

            <div class="offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-lg-5   col-12">
                <div class="position-relative z-1 pt-lg-9" data-cue="slideInRight">
                    <div class="position-relative">
                        <?= $this->render('/insurance/from', [
                            'model' => $model,
                            'country' => $country,
                            'sourceCountry' => $sourceCountry,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--hero end-->





<!-- 
<style>
    .image-wrapper {
        position: relative;
        display: inline-block;
    }

    .image-wrapper img {
        display: block;
        width: 100%;
        height: auto;
        filter: opacity(0.87);
    }

    .image-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.01);
        /* Black background with 50% opacity */
        z-index: 1;
    }

    .image-wrapper img {
        position: relative;
        z-index: 0;
    }
</style> -->

<!-- 
alt="Company Logo" -->

<!--Featured in start-->
<div class="my-5">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-lg-10 offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-12" data-cue="fadeIn">
                <ul class="list-inline text-center">
                    <?php foreach (\common\models\InsuranceCountries::find()->all() as $country) : ?>
                        <li class="list-inline-item d-inline-flex align-items-center me-3 mb-2 mb-lg-0" data-cue="slideInLeft">
                            <?php if (!empty($country->country_code)) : ?>

                                <img src="/assets/flags/<?= strtolower($country->country_code) ?>.png" class="rounded-circle" width="24"
                                    height="24" alt="Comapny Logo" />
                            <?php else : ?>
                                <div class="flag-placeholder rounded-circle"></div>
                            <?php endif; ?>
                            <h6 class="my-2 ms-2"><?= ucwords(strtolower($countryName = $language === 'ar' ? $country->source_country_ar : $country->source_country)) ?></h6>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--Featured in end-->




<!-- <div class="my-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-12" data-cue="fadeIn" data-show="true" style="animation-name: fadeIn; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                <div class="text-center mb-4 mb-lg-7">
                    <small class="text-uppercase fw-semibold ls-md">Certified insurance companies</small>
                </div>


                <div class="swiper logoSwiper swiper-initialized swiper-horizontal swiper-backface-hidden" data-cue="slideInDown" data-show="true" style="animation-name: slideInDown; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                    <?php foreach (\common\models\InsuranceCountries::find()->all() as $Countries) : ?>

                        <div class="swiper-wrapper pb-4" id="swiper-wrapper-3ec847c46421dd89" aria-live="off">
                            <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 5" data-swiper-slide-index="0" style="width: 172.2px; margin-right: 50px;">
                                <div data-cue="slideInDown" data-show="true" style="animation-name: slideInDown; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 200ms; animation-direction: normal; animation-fill-mode: both;">
                                    <figure class="text-center">
                                        <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $Countries->company_logo ?>" alt="logo" width="110">
                                    </figure>
                                </div>
                            </div>

                        <?php endforeach; ?>




                        </div>
                        <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic swiper-pagination-lock" style="width: 90px;"><span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" aria-current="true" style="left: 36px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next" style="left: 36px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next-next" style="left: 36px;"></span><span class="swiper-pagination-bullet" style="left: 36px;"></span><span class="swiper-pagination-bullet" style="left: 36px;"></span></div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
        </div>
    </div>
</div> -->




<!--Meet sponsors start-->



<!-- <section class="my-xl-9 my-5" id="insurances_programs">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-2">Insurances</h2>
                    <p class="mb-0">Explore various related insurance options that might suit your needs.</p>
                </div>
            </div>
        </div>

        <?php foreach (\common\models\Insurances::find()->all() as $insurance): ?>
            <div class="col-md-4 mt-5">
         
                <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="card text-bg-light shadow"  data-cue="fadeUp">
                    <img src="<?= $insurance->photo ?>" class="card-img" alt="img">
                    <div class="card-img-overlay text-white d-inline-flex justify-content-start align-items-end overlay-dark">
                        <div class="text-capitalize">
                            <h2 class="card-title"><?= $insurance->name ?></h2>
                            <div class="mb-4 justify-content-center">
                                <div class="price-text">
                                    <span class="small">starts from </span>
                                    <div class="price price-show h1 text-warning">
                                        <span>$</span>
                                        <span><?= $insurance->price ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </a>
            </div>
            <?php endforeach; ?>
   
            <?php
            $allInsurances = \common\models\Insurances::find()->all();
            $displayLimit = 8;
            $visibleInsurances = array_slice($allInsurances, 0, $displayLimit);
            $hiddenInsurances = array_slice($allInsurances, $displayLimit);
            $moreItemsExist = !empty($hiddenInsurances);
            ?>

            <?php foreach ($visibleInsurances as $insurance): ?>



                <div class=" col-md-3 mt-5 insurance-item " data-cue="slideInLeft" data-duration="1000">
                    <article class="card h-100 border-0 shadow-sm zoom-img">
                        <div class="position-relative ">
                            <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link"></a>
                            <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="btn btn-icon btn-light bg-white border-white btn-sm rounded-circle position-absolute top-0 end-0 zindex-2 me-3 mt-3" data-bs-toggle="tooltip" data-bs-placement="left" title="Save to Favorites" aria-label="Save to Favorites">
                      
                            </a>
                            <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="image-wrapper">
                                <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="card-img-top" alt="Insurance Image">
                            </a>

                        </div></a>
                        <div class="mx-3 pb-3 mt-2">
                            <h6 class=" fs-4 mb-2">

                                <?= ucwords(strtolower($insurance->name)) ?>
                            </h6>
                            <div class="d-flex justify-content-between">
                                <p class="fs-6 mb-2">Start from</p>
                                <p class="fs-lg fw-semibold text-warning mb-0">$<?= $insurance->price ?></p>
                            </div>

                        </div>
                
                    </article>
                </div>
            <?php endforeach; ?>

            <div id="hidden-insurances" class="row" style="display:none;">
                <?php foreach ($hiddenInsurances as $insurance): ?>
                    <div class="col-md-3 mt-5 insurance-item " data-cue="slideInLeft">
                  
                        <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="card text-bg-light shadow zoom-img" data-cue="fadeUp">
                            <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="card-img zoom-img" alt="Insurance Image">
                            <div class="card-img-overlay text-white d-inline-flex justify-content-start align-items-end overlay-dark">
                                <div class="text-capitalize">
                                    <h4 class="card-title"><?= $insurance->name ?></h4>
                                    <div class="mb-4 justify-content-center">
                                        <div class="price-text">
                                            <span class="small">starts from </span>
                                            <div class="price price-show h1 text-warning">
                                                <span>$</span>
                                                <span><?= $insurance->price ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>


   

            <?php if ($moreItemsExist): ?>

                <div class="row text-center">
                    <div class="col-lg-12" data-cue="slideInLeft">
                        <div class="mt-lg-6 mt-5">
                            <a id="toggle-more" class="icon-link icon-link-hover" style="color: #00112C;">
                                Show more
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="text-warning" class="bi bi-arrow-right text-warning" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                    <?php endif; ?>

                    </div>


        </div> 
</section> -->





<section class="my-xl-9 my-5" id="insurances_programs">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-2"><?= Yii::t('app', 'Type of Assurances') ?></h2>
                    <p class="mb-0"><?= Yii::t('app', 'Explore various related assurance options that might suit your needs.') ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach (\common\models\Insurances::find()->all() as $insurance): ?>
                <div class="col-md-3 mt-3 ZoomIn" data-cue="fadeIn">
                    <!-- Image overlay -->
                    <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="card text-bg-light shadow zoom-img" data-cue="fadeUp">
                        <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="card-img" alt="img">
                        <div class="card-img-overlay text-white d-inline-flex justify-content-start align-items-end overlay-dark">
                            <div class="text-capitalize">
                                <h4 class="card-title"><?= $language === 'ar' ? $insurance->name_ar : $insurance->name ?></h4>
                                <div class="mb-4 justify-content-center">
                                    <div class="price-text">
                                        <span class="small"><?= Yii::t('app', 'starts from') ?> </span>
                                        <div class="price price-show h3 text-warning">
                                            <span>JOD</span>
                                            <span><?= $insurance->price ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggleLink = document.getElementById('toggle-more');
        var hiddenInsurances = document.getElementById('hidden-insurances');
        var isExpanded = false;

        if (toggleLink) {
            toggleLink.addEventListener('click', function(event) {
                event.preventDefault();

                if (isExpanded) {
                    hiddenInsurances.style.display = 'none';
                    toggleLink.innerHTML = 'Show more <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right text-warning" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>';
                } else {
                    hiddenInsurances.style.display = 'flex';
                    toggleLink.innerHTML = 'Show less <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right text-warning" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>';
                }
                isExpanded = !isExpanded;
            });
        }


        const counters = document.querySelectorAll('.counter');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const countTo = parseInt(counter.getAttribute('data-count'), 10);

                    $(counter).prop('Counter', 0).animate({
                        Counter: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function(now) {
                            $(this).text(Math.ceil(now));
                        }
                    });

                    observer.unobserve(counter);
                }
            });
        }, {
            threshold: 1
        });

        counters.forEach(counter => observer.observe(counter));


    });
</script>








<!--Meet sponsors end-->


<!-- Fact 4 - Bootstrap Brain Component -->
<!-- <section class="py-5 py-xl-8 bg-primary-dark">
    <div class="container mb-2">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <h2 class="mb-2 text-white text-center">
                    Key <span class="text-warning">Assurance</span> Statistics
                </h2>
                <p class="mb-5 text-center">
                    Check out the essential figures and data related to insurance coverage.
                </p>

            </div>
        </div>
    </div>


    <div class="container overflow-hidden">
        <div class="row gy-4 gy-md-6 gy-lg-0">
            <div class="col-6 col-lg-3">
                <div class="text-center">
                    <div class="d-flex align-items-center justify-content-center  mx-auto  ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" fill="currentColor" class="bi bi-people " viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                        </svg>
                    </div>
                    <h3 class="fs-2 fw-bold m-1 text-white mt-2"><?= Customers::find()->count() . ' +'; ?></h3>
                    <p class=" m-0">Happy Customers</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="text-center">
                    <div class="d-flex align-items-center justify-content-center  mx-auto  ">
                        <svg width="55" height="55" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#65758C" stroke="#65758C">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <rect x="296" y="328" style="fill:#65758C;" width="192" height="96"></rect>
                                <g>
                                    <path style="fill:#65758C;" d="M415.264,263.48c-33.528-20.704-78.192-20.48-111.504,0.64 c-1.88-66.784-15.552-133.592-39.824-165.216C344.904,113.144,407.832,180.392,415.264,263.48z"></path>
                                    <path style="fill:#65758C;" d="M48.736,263.48c7.432-83.08,70.36-150.328,151.328-164.576 c-24.272,31.624-37.944,98.432-39.824,165.216C126.928,242.984,82.264,242.768,48.736,263.48z"></path>
                                    <path style="fill:#65758C;" d="M176.272,263.864C179.032,164.176,206.856,96,232,96s52.968,68.176,55.728,167.864 c-14.424-9.032-30.912-14.184-47.728-15.416V248h-16v0.448C207.192,249.68,190.696,254.832,176.272,263.864z"></path>
                                </g>
                                <g>
                                    <path style="fill:#65758C;" d="M424,280c-17.92-16.24-41.52-24.24-65.04-24C351.12,161.28,297.28,88,232,88C338,88,424,174,424,280 z"></path>
                                    <path style="fill:#65758C;" d="M232,88c-35.36,0-64,86-64,192c-17.44-15.76-40.08-23.76-62.96-24C112.88,161.28,166.72,88,232,88z"></path>
                                    <path style="fill:#65758C;" d="M296,280c-17.68-16-40.8-24-64-24V88C267.36,88,296,174,296,280z"></path>
                                </g>
                                <g>
                                    <circle style="fill:#65758C;" cx="136" cy="352" r="40"></circle>
                                    <circle style="fill:#65758C;" cx="48" cy="408" r="32"></circle>
                                    <circle style="fill:#65758C;" cx="120" cy="472" r="24"></circle>
                                </g>
                                <g>
                                    <rect x="440" y="368" style="fill:#65758C;" width="16" height="16"></rect>
                                    <rect x="328" y="368" style="fill:#65758C;" width="16" height="16"></rect>
                                </g>
                                <g>
                                    <rect x="408" y="40" style="fill:#0C3847;" width="16" height="96"></rect>
                                    <rect x="40" y="40" style="fill:#0C3847;" width="16" height="96"></rect>
                                    <rect x="88" style="fill:#0C3847;" width="16" height="80"></rect>
                                    <rect x="360" y="56" style="fill:#0C3847;" width="16" height="40"></rect>
                                    <rect x="184" y="8" style="fill:#0C3847;" width="16" height="32"></rect>
                                    <rect x="136" y="32" style="fill:#0C3847;" width="16" height="40"></rect>
                                    <rect x="312" y="8" style="fill:#0C3847;" width="16" height="56"></rect>
                                    <path style="fill:#0C3847;" d="M288,472c0,13.232-10.768,24-24,24s-24-10.768-24-24V264.328c18.4,1.6,36.32,8.752,50.424,21.424 l5.016,5.544l0.56-0.512l0.56,0.512l5.016-5.544c32.352-29.08,84.784-29.032,117.056,0.176L432,298.032V280 c0-107.6-85.416-195.576-192-199.8V56h-16v24.2C117.416,84.424,32,172.4,32,280v18.032l13.368-12.104 c32.264-29.2,84.704-29.256,117.056-0.176l5.016,5.544l0.56-0.512l0.56,0.512l5.016-5.544C187.68,273.08,205.6,265.928,224,264.328 V472c0,22.056,17.944,40,40,40s40-17.944,40-40v-8h-16V472z M415.264,263.48c-33.528-20.704-78.192-20.48-111.504,0.64 c-1.88-66.784-15.552-133.592-39.824-165.216C344.904,113.144,407.832,180.392,415.264,263.48z M48.736,263.48 c7.432-83.08,70.36-150.328,151.328-164.576c-24.272,31.624-37.944,98.432-39.824,165.216 C126.928,242.984,82.264,242.768,48.736,263.48z M176.272,263.864C179.032,164.176,206.856,96,232,96s52.968,68.176,55.728,167.864 c-14.424-9.032-30.912-14.184-47.728-15.416V248h-16v0.448C207.192,249.68,190.696,254.832,176.272,263.864z"></path>
                                    <path style="fill:#0C3847;" d="M392,344c-17.648,0-32,14.352-32,32s14.352,32,32,32s32-14.352,32-32S409.648,344,392,344z M392,392 c-8.824,0-16-7.176-16-16s7.176-16,16-16s16,7.176,16,16S400.824,392,392,392z"></path>
                                    <path style="fill:#0C3847;" d="M280,312v128h224V312H280z M456.448,421.36l-0.92,2.64H328.52l-1.016-2.76 c-4.712-12.832-16.32-24.408-28.864-28.8l-2.64-0.912v-31l2.76-1.016c12.84-4.72,24.408-16.32,28.792-28.864l0.92-2.648h127 l1.016,2.76c4.712,12.832,16.32,24.408,28.864,28.8l2.648,0.912v31l-2.76,1.016C472.4,397.208,460.832,408.816,456.448,421.36z M488,343.312c-6.208-3.04-12.072-8.92-15.272-15.312H488V343.312z M311.312,328c-3.04,6.208-8.92,12.072-15.312,15.272V328 H311.312z M296,408.688c6.208,3.04,12.072,8.92,15.272,15.312H296V408.688z M472.688,424c3.04-6.208,8.92-12.072,15.312-15.272V424 H472.688z"></path>
                                    <path style="fill:#0C3847;" d="M136,304c-26.472,0-48,21.528-48,48s21.528,48,48,48s48-21.528,48-48S162.472,304,136,304z M136,384 c-17.648,0-32-14.352-32-32s14.352-32,32-32s32,14.352,32,32S153.648,384,136,384z"></path>
                                    <path style="fill:#0C3847;" d="M48,368c-22.056,0-40,17.944-40,40s17.944,40,40,40s40-17.944,40-40S70.056,368,48,368z M48,432 c-13.232,0-24-10.768-24-24s10.768-24,24-24s24,10.768,24,24S61.232,432,48,432z"></path>
                                    <path style="fill:#0C3847;" d="M120,440c-17.648,0-32,14.352-32,32s14.352,32,32,32s32-14.352,32-32S137.648,440,120,440z M120,488 c-8.824,0-16-7.176-16-16s7.176-16,16-16s16,7.176,16,16S128.824,488,120,488z"></path>
                                </g>
                                <circle style="fill:#65758C;" cx="392" cy="376" r="16"></circle>
                            </g>
                        </svg>
                    </div>
                    <h3 class="fw-bold m-1 fs-2  mt-2 text-warning"><?= Insurances::find()->count() . ' +'; ?></h3>
                    <p class=" m-0">Insurances types</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="text-center">
                    <div class="d-flex align-items-center justify-content-center  mx-auto ">
                        <svg fill="#65758C" viewBox="0 0 24 24" width="55" height="55" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M19 9.99611V12L22 9L19 6V7.99376C18.309 7.94885 17.9594 7.6644 17.4402 7.23176L17.4283 7.22188C16.7967 6.6955 15.9622 6 14.4 6C12.8378 6 12.0033 6.69551 11.3717 7.22188L11.3598 7.23178C10.7928 7.70427 10.428 8 9.6 8C8.772 8 8.40717 7.70427 7.84018 7.23178L7.82831 7.22188C7.59036 7.02357 7.32361 6.80126 7 6.60118V9.12312C7.58472 9.56529 8.36495 10 9.6 10C11.1622 10 11.9967 9.30449 12.6283 8.77812L12.6402 8.76822C13.2072 8.29573 13.572 8 14.4 8C15.228 8 15.5928 8.29573 16.1598 8.76821L16.1717 8.77811C16.7758 9.28156 17.5655 9.93973 19 9.99611Z"></path>
                                <path d="M7 17.1231C7.58472 17.5653 8.36495 18 9.6 18C11.1622 18 11.9967 17.3045 12.6283 16.7781L12.6402 16.7682C13.2072 16.2957 13.572 16 14.4 16C15.228 16 15.5928 16.2957 16.1598 16.7682L16.1717 16.7781C16.7758 17.2816 17.5655 17.9397 19 17.9961V20L22 17L19 14V15.9938C18.309 15.9488 17.9594 15.6644 17.4402 15.2318L17.4283 15.2219C16.7967 14.6955 15.9622 14 14.4 14C12.8378 14 12.0033 14.6955 11.3717 15.2219L11.3598 15.2318C10.7928 15.7043 10.428 16 9.6 16C8.772 16 8.40717 15.7043 7.84018 15.2318L7.82831 15.2219C7.59036 15.0236 7.32361 14.8013 7 14.6012V17.1231Z"></path>
                                <path d="M5 4H15V8.03662C15.8985 8.15022 16.5162 8.51098 17 8.87686V4C17 2.89543 16.1046 2 15 2H5C3.89543 2 3 2.89543 3 4V20C3 21.1046 3.89543 22 5 22H15C16.1046 22 17 21.1046 17 20V19.3988C16.6764 19.1987 16.4096 18.9764 16.1717 18.7781L16.1598 18.7682C15.7512 18.4277 15.4476 18.179 15 18.0666V20H5L5 4Z"></path>
                                <path d="M15 16.0366C15.8985 16.1502 16.5162 16.511 17 16.8769V11.3988C16.6764 11.1987 16.4096 10.9764 16.1717 10.7781L16.1598 10.7682C15.7512 10.4277 15.4476 10.179 15 10.0666V16.0366Z"></path>
                            </g>
                        </svg>

                    </div>
                    <h3 class=" fw-bold m-1 fs-2  text-white mt-2"><?= Policy::find()->count() . ' +'; ?></h3>
                    <p class=" m-0">Policies</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="text-center">
                    <div class="d-flex align-items-center justify-content-center  mx-auto ">
                        <svg fill="#65758C" width="55" height="55" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M8 2L8 6L4 6L4 48L46 48L46 14L30 14L30 6L26 6L26 2 Z M 10 4L24 4L24 8L28 8L28 46L19 46L19 39L15 39L15 46L6 46L6 8L10 8 Z M 10 10L10 12L12 12L12 10 Z M 14 10L14 12L16 12L16 10 Z M 18 10L18 12L20 12L20 10 Z M 22 10L22 12L24 12L24 10 Z M 10 15L10 19L12 19L12 15 Z M 14 15L14 19L16 19L16 15 Z M 18 15L18 19L20 19L20 15 Z M 22 15L22 19L24 19L24 15 Z M 30 16L44 16L44 46L30 46 Z M 32 18L32 20L34 20L34 18 Z M 36 18L36 20L38 20L38 18 Z M 40 18L40 20L42 20L42 18 Z M 10 21L10 25L12 25L12 21 Z M 14 21L14 25L16 25L16 21 Z M 18 21L18 25L20 25L20 21 Z M 22 21L22 25L24 25L24 21 Z M 32 22L32 24L34 24L34 22 Z M 36 22L36 24L38 24L38 22 Z M 40 22L40 24L42 24L42 22 Z M 32 26L32 28L34 28L34 26 Z M 36 26L36 28L38 28L38 26 Z M 40 26L40 28L42 28L42 26 Z M 10 27L10 31L12 31L12 27 Z M 14 27L14 31L16 31L16 27 Z M 18 27L18 31L20 31L20 27 Z M 22 27L22 31L24 31L24 27 Z M 32 30L32 32L34 32L34 30 Z M 36 30L36 32L38 32L38 30 Z M 40 30L40 32L42 32L42 30 Z M 10 33L10 37L12 37L12 33 Z M 14 33L14 37L16 37L16 33 Z M 18 33L18 37L20 37L20 33 Z M 22 33L22 37L24 37L24 33 Z M 32 34L32 36L34 36L34 34 Z M 36 34L36 36L38 36L38 34 Z M 40 34L40 36L42 36L42 34 Z M 32 38L32 40L34 40L34 38 Z M 36 38L36 40L38 40L38 38 Z M 40 38L40 40L42 40L42 38 Z M 10 39L10 44L12 44L12 39 Z M 22 39L22 44L24 44L24 39 Z M 32 42L32 44L34 44L34 42 Z M 36 42L36 44L38 44L38 42 Z M 40 42L40 44L42 44L42 42Z"></path>
                            </g>
                        </svg>
                    </div>
                    <h3 class=" fw-bold m-1 fs-2 mt-2 text-warning"><?= InsuranceCountries::find()->count() . ' +'; ?></h3>
                    <p class=" m-0">Insurance Countries Supported</p>
                </div>
            </div>
        </div>
    </div>
</section> -->




<!--5m member start-->

<section class="my-xl-9 py-7 bg-primary-dark" dir="<?= Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>">
    <div class="container" data-cue="fadeIn">
        <!-- <div class="row">
            <div class="col-xl-8 offset-xl-2 col-12" dir="<?= Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>">
                <div class="text-center mb-xl-7 mb-5" >
                    <h2 class="text-white-stable header mb-3" >
                        <?= Yii::t('app', 'Why Our Assurance Platform Leads:') ?>
                        <span class="text-warning"><?= Yii::t('app', 'Statistics that Speak') ?></span>
                    </h2>

                    <p class="mb-0 text-white-50">
                        <?= Yii::t('app', 'Discover seamless insurance solutions with tailored coverage and exceptional service.') ?>
                    </p>
                </div>
            </div>
        </div> -->


        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="text-white-stable text-center header mb-3">
                        <?= Yii::t('app', 'Why Our Assurance Platform Leads:') ?>
                        <span class="text-warning"><?= Yii::t('app', 'Statistics that Speak') ?></span>
                    </h2>

                    <p class="mb-0 text-white-50">
                        <?= Yii::t('app', '
                        
                       Discover travel assurance solution with various coverage and exceptional
service.') ?>
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
        <div class="row mb-5 pb-4 g-5  text-lg-left">
            <div class="col-md-4" data-cue="slideInLeft">
                <h4 class="text-white-stable"><?= Yii::t('app', 'Affordable Plans') ?></h4>
                <p class="text-white-50 mb-0">
                    <?= Yii::t('app', 'Choose from a variety of Silver, Gold and') ?><br><?= Yii::t('app', 'Platinum plans') ?>

                </p>
            </div>
            <div class="col-md-4" data-cue="slideInLeft">
                <h4 class="text-white-stable"><?= Yii::t('app', 'Benefits & Coverage') ?></h4>
                <p class="text-white-50 mb-0">
                    <?= Yii::t('app', 'Excellent coverage Worldwide and Emergency Assistance
24/7') ?>
                </p>
            </div>
            <div class="col-md-4" data-cue="slideInLeft">
                <h4 class="text-white-stable"><?= Yii::t('app', 'Claims') ?></h4>
                <p class="text-white-50 mb-0">
                    <?= Yii::t('app', 'Claims are processed quickly provided all
necessary documents are provided.') ?>
                </p>
            </div>
        </div>

        <div class="row border-primary border-top g-5 g-lg-0 text-center text-lg-start">

            <!-- <div class="row border-primary border-top g-5 g-lg-0 text-center text-lg-end"> -->
            <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary ">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable mb-0 counter" data-count="<?= Insurances::find()->count() ?>">0 </h5>
                    <span class="text-white-50"><?= Yii::t('app', 'Satisfied Customers') ?></span>
                </div>
            </div>
            <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable mb-0 counter" data-count="<?= InsuranceCountries::find()->count() ?>">0 </h5>
                    <span class="text-white-50"><?= Yii::t('app', 'Companies Covered') ?></span>
                </div>
            </div>
            <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable mb-0 counter" data-count="<?= Insurances::find()->count() ?>">0 </h5>
                    <span class="text-white-50"><?= Yii::t('app', 'Types of Assurance') ?></span>
                </div>
            </div>
            <div class="col-lg-3 col-6 border-end-0">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable  mb-0 counter" data-count="<?= Policy::find()->count() ?>">0 </h5>
                    <span class="text-white-50"><?= Yii::t('app', 'Assurance Policies') ?></span>
                </div>
            </div>
        </div>
    </div>
</section>



<!--5m member end-->







<!--Who we are start-->
<section class="my-xl-9 my-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="mb-4">
                    <small class="text-uppercase ls-md fw-semibold">
                        <span class="text-warning"><?= Yii::t('app', 'Who') ?></span> <?= Yii::t('app', 'we are') ?>
                    </small>
                    <h2 class="h2 mt-3 mb-3"><?= Yii::t('app', 'We believe in Worry-Free Journeys With Reliable Coverage.') ?></h2>
                    <p class="mb-2">
                        <?= Yii::t('app', 'At 360Travelcare, we specialize in providing comprehensive assurance solutions to safeguard your travels with our partner assurance companies.') ?>
                    </p>
                    <p class="mb-2">
                        <?= Yii::t('app', 'Whether you\'re embarking on a new Adventure, Shopping, Study, or simply seeking peace of mind, our goal is to offer tailored coverage that meets your unique needs.With 360Travelcare, you can focus on enjoying your journey while we take care of your protection.') ?>
                    </p>


                </div>

                <!-- <a href="/asurance/about" class="icon-link icon-link-hover" style="color: #00112C;">
                    <?= Yii::t('app', 'More about us') ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="bi bi-arrow-right text-warning" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                    </svg>
                </a> -->
            </div>
            <div class="col-xl-6 offset-xl-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-lg-6 col-12">
                <div class="row g-4">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="rounded-3 card-lift" style="
                            background-image: url('<?= Yii::$app->request->baseUrl ?>/images/travel.jpg');
                            background-repeat: no-repeat;
                            height: 386px;
                            background-size: cover;
                        "></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="mb-4 rounded-3 card-lift" style="
                            background-image: url('<?= Yii::$app->request->baseUrl ?>/images/about-img/about-grid-img-1.jpg');
                            background-repeat: no-repeat;
                            height: 180px;
                            background-size: cover;
                        "></div>
                        <div class="mb-2 rounded-3 card-lift" style="
                            background-image: url('<?= Yii::$app->request->baseUrl ?>/images/about-img/about-grid-img-3.jpg');
                            background-repeat: no-repeat;
                            height: 180px;
                            background-size: cover;
                        "></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Who we are end-->




<!-- <section class="my-xl-9 my-5" id="insurances_programs">
    <div class="container" data-cue="fadeIn">
    <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-2">
            Ansurance Types
        </h2>
        <p class="mb-0">
            Explore various related insurance options that might suit your needs.
        </p>
                </div>
            </div>
        </div>
        <div class="row">





        
 

        
<div class="scroll-container">
    <div class="scroll-wrapper">
        <?php foreach ($insurances as $insurance) : ?>
            <div class="scroll-item">
                <a href="<?= Url::to(['/asurance/programs', 'slug' => $insurance->slug]) ?>" class="card text-bg-light shadow" data-cue="fadeUp">
                    <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="card-img" alt="img">
                    <div class="card-img-overlay text-white d-inline-flex justify-content-start align-items-end overlay-dark ">
                        <div class="text-capitalize">
                            <h2 class="card-title" style="font-size:x-large;"><?= $insurance->name ?></h2>
                            <div class="mb-4 justify-content-center">
                                <div class="price-text">
                                    <span class="small">starts from </span>
                                    <div class="price price-show h1 text-warning">
                                        <span>$</span>
                                        <span><?= $insurance->price ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>








        </div>
    </div>
</section>  -->






<!-- <section class="my-xl-9 my-5" id="insurances_programs">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-2">Insurance Types</h2>
                    <p class="mb-0">Explore various related insurance options that might suit your needs.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="carouselExampleControls" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                    $chunkedInsurances = array_chunk($insurances, 3);
                    foreach ($chunkedInsurances as $index => $chunk) : ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row">
                                <?php foreach ($chunk as $insurance) : ?>
                                    <div class="col-sm-4">
                                        <div class="thumb-wrapper mb-2">
                                            <div class="img-box">

                                                <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" data-cue="fadeUp">

                                                    <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="img-fluid" alt=""></a>
                                            </div>
                                            <div class="thumb-content mt-2">
                                                <h4 class="d-flex justify-content-start"><?= $insurance->name ?></h4>
                                                <div class="d-flex justify-content-start">
                                                    <div class="price-text">
                                                        <span class="small">starts from </span>
                                                        <div class="price price-show h1 text-warning">
                                                            <span>$</span>
                                                            <span><?= $insurance->price ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-prev btn btn-primary" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next btn btn-primary" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section> -->










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






<!-- <section class="my-xl-9 my-5">
    <div class="container" data-cue="fadeIn">
        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-2"><?= Yii::t('app', 'Insurances') ?></h2>
                    <p class="mb-0"><?= Yii::t('app', 'Explore various related insurance options that might suit your needs.') ?></p>
                </div>
            </div>
        </div>
        <div class="row"> -->


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
                    <?php foreach (\common\models\InsuranceCountries::find()->all() as $Countries) : ?>
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
                        <p class="mb-0"><?= Yii::t('app', 'Select the type of assurance you need, such as Travel, Student, Adventure, Shop, Cancellation  assurance, and more.') ?></p>
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








<!--Expert team start-->
<!-- <section>
    <div class="container">
        <div class="row border-top border-bottom">
            <div
                class="col-md-4 border-end-md border-bottom border-bottom-md-0">
                <div class="text-center py-lg-5 p-4">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor"
                            class="bi bi-people-fill text-primary"
                            viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                        </svg>
                    </div>
                    <div>
                        <h4>Expert Team</h4>
                        <p class="mb-0">Vivamus eget neque lacus.
                            Pellentesque egauris ex.</p>
                    </div>
                </div>
            </div>
            <div
                class="col-md-4 border-end-md border-bottom border-bottom-md-0">
                <div class="text-center py-lg-5 p-4">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor"
                            class="bi bi-trophy-fill text-primary"
                            viewBox="0 0 16 16">
                            <path
                                d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z" />
                        </svg>
                    </div>
                    <div>
                        <h4>Award winning agency</h4>
                        <p class="mb-0">Lorem ipsum, dolor sit amet
                            consectetur elitorceat .</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center py-lg-5 p-4">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                            height="32" fill="currentColor"
                            class="bi bi-stars text-primary"
                            viewBox="0 0 16 16">
                            <path
                                d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z" />
                        </svg>
                    </div>
                    <div>
                        <h4>10 Year Exp.</h4>
                        <p class="mb-0">Pellen tesque eget, mauris lorem
                            iupsum neque lacus.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!--Expert team end-->





<section>
    <div style="background-image: url(/images/pattern/cta-pattern.png); background-position: center; background-repeat: no-repeat; background-size: cover" class="py-7 bg-primary-dark">
        <div class="container my-lg-7" data-cue="fadeIn">
            <div class="row">
                <div class="col-md-12" data-cue="fadeIn">
                    <div class="mb-xl-7 mb-4 text-center">
                        <h2 class="text-white-stable mb-3"><?= Yii::t('app', 'Get your assurance online now') ?></h2>
                        <p class="mb-0 text-white-50">
                            <?= Yii::t('app', 'Ready to secure your future with peace of mind? Get your assurance online now and enjoy worry-free protection for all your needs!') ?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="/" class="btn btn-primary"><?= Yii::t('app', 'Get Started') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    //   (function() {
    //     // INITIALIZATION OF FLATPICKR
    //     // =======================================================
    //     HSCore.components.HSFlatpickr.init('.js-flatpickr')
    //   })();
    // 
</script>





<div class="modal row fade border rounded shadow-sm" id="flashMessageModal" tabindex="-1" aria-labelledby="flashMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content rounded shadow-sm">

            <div class=" modal-body">
                <div class="modal-header border-0">
                    <!-- <h1 class="modal-title fs-5" id="flashMessageModalLabel">Modal title</h1> -->
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="text-center">
                    <div class="d-flex justify-content-center pb-2">
                        <div class="check-container d-flex justify-content-center align-items-center ">
                            <img class="iconheight" src='<?= Yii::$app->request->baseUrl ?>/images/nodata.png' alt="No Data" width="23%" height="92%">


                        </div>
                    </div>
                    <h3 class="fw-bold" style="color: #0F172A;">
                        <?= Yii::t('app', 'No Data Available') ?>
                    </h3>

                    <small class="fw-bold">
                        <?= Yii::t('app', 'It seems there are no available options for your current selection. Please try changing the departure and arrival countries to see supported options.') ?>
                    </small>


                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center footer-color rounded-0 position-relative">
                <div class="angle "></div>

            </div>
        </div>
    </div>
</div>
</div>

<!-- <script>
    $(document).ready(function() {
        $('#pax-type-dropdown').change(function() {
            var selectedValue = $(this).val();
            $('.field-group').hide();

            if (selectedValue === '76-85') {

                $('#adult1').show();
            } else if (selectedValue === '19-75') {
                $('#adult').show();
                $('#adult .col-md-6').show();
                $('#child').show();
            }
        });
    });
</script> -->









<!-- 


<section class="my-lg-7 py-6">
            <div class="container">
               <div class="row align-items-center g-5">
                  <div class="col-lg-5 col-12">
                     <div class="mb-6">
                        <small class="border rounded-pill border-primary-subtle text-primary text-uppercase px-3 py-2 fw-semibold">Support</small>
                        <h2 class="mt-4">Award winning customer support</h2>
                     </div>
                     <div class="mb-6">
                        <ul class="list-unstyled mb-0">
                           <li class="d-flex mb-3">
                              <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-primary text-opacity-50" viewBox="0 0 16 16">
                                    <path
                                       d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                 </svg>
                              </span>
                              <span class="ms-2">
                                 <span class="text-dark fw-semibold">Help From Start to Finish:</span>
                                 Our Support team is highly knowledgeable and never transfers you to another department.
                              </span>
                           </li>
                           <li class="d-flex mb-3">
                              <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-primary text-opacity-50" viewBox="0 0 16 16">
                                    <path
                                       d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                 </svg>
                              </span>
                              <span class="ms-2">
                                 <span class="text-dark fw-semibold">Global Support:</span>
                                 We’ve got over 100 Support staff working across America and Europe
                              </span>
                           </li>
                           <li class="d-flex mb-3">
                              <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill text-primary text-opacity-50" viewBox="0 0 16 16">
                                    <path
                                       d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                 </svg>
                              </span>
                              <span class="ms-2">
                                 <span class="text-dark fw-semibold">4.8/5.0 Star Reviews:</span>
                                 Yup, that’s our Support team approval rating across 120,000+ reviews.
                              </span>
                           </li>
                        </ul>
                     </div>

                     <a href="#!" class="btn btn-primary me-2">Contact us</a>
                     <a href="#!" class="btn btn-outline-primary">Help center</a>
                  </div>
                  <div class="col-lg-7 col-12">
                     <div class="position-relative mx-3">
                        <figure>
                           <img src="./assets/images/landings/account/account-support.jpg" alt="support" class="rounded-3 img-fluid px-lg-1" />
                        </figure>
                        <div class="position-absolute top-100 start-50 translate-middle">
                           <div class="rounded-3 bg-success-subtle text-success-emphasis px-2 py-2 text-center">
                              <span class="fs-6">
                                 <span>😀</span>
                                 <span class="ms-1">A real human available always for you.</span>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section> -->
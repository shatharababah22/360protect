<?php

/** @var yii\web\View $this */
/** @var \common\models\Policy[] $policies */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use common\models\Customers;
use common\models\InsuranceCountries;
use common\models\Insurances;
use common\models\Policy;
use common\widgets\Alert;


$this->title = 'Insurances Type';


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

<!-- 

<section class="pt-10 pb-10 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable"><span class="text-warning"><?= Yii::t('app', 'Insurances') ?></span> Type</h1>
                <p><?= Yii::t('app', 'Home / Insurances Type') ?></p>
            </div>
        </div>
    </div>
</section>




<section class="my-xl-9 my-5">
    <div class="container position-relative mb-2">

       
        <div class="row">
            <div class="col-12">
        
                <div class="d-flex justify-content-between">


                    <h5 class="mb-0 mt-2">Showing 1-7 of 32 result</h5>

             
                    <input type="checkbox" class="btn-check" id="btn-check-soft">
                    <label class="btn border border-secondary mb-0" for="btn-check-soft" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-controls="collapseFilter">
                        <i class="bi fa-fe bi-sliders me-2"></i>Show Filter
                    </label>

                </div>
     
            </div>
        </div>


        <div class="collapse" id="collapseFilter">
            <div class="card card-body  p-4 mt-4 z-index-9">

                <form class="row g-4">
       
                    <div class="col-md-6 col-lg-4">
                        <div class="form-control-borderless">
                            <label class="form-label">Enter Insurance Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                 
                    <div class="col-md-6 col-lg-4">
                        <div class="form-control-borderless">
                            <label class="form-label">Price Range</label>
                            <div class="position-relative">

                                <input type="range" class="form-range " min="0" max="5" step="0.1" id="customRange3">
                                <div class="d-flex justify-content-between">

                                    <small class="text-muted">$20</small>
                                    <small class="text-muted">$100</small>

                                </div>
                            </div>
                        </div>
                    </div>

                 
                    <div class="col-md-6 col-lg-4">
                        <div class="form-size-lg form-control-borderless">
                            <label class="form-label">Popular Filters</label>
                            <select class="form-select js-choice">
                                <option value="">Select Option</option>
                                <option>Recently search</option>
                                <option>Most popular</option>
                                <option>Top rated</option>
                            </select>
                        </div>
                    </div>




                    <div class="text-start align-items-center">
                        <button class="btn btn-outline-danger">Clear all</button>
                        <button class="btn btn-primary mb-0 ms-2">Apply filter</button>
                    </div>
                </form>
               
            </div>
        </div>
      

    </div>
    <div class="container" data-cue="fadeIn">

        <div class="row">
            <?php foreach (\common\models\Insurances::find()->all() as $insurance): ?>
                <div class="col-md-3 mt-3 ZoomIn" data-cue="fadeIn">
             
                    <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="card text-bg-light shadow zoom-img" data-cue="fadeUp">
                        <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="card-img" alt="img">
                        <div class="card-img-overlay text-white d-inline-flex justify-content-start align-items-end overlay-dark">
                            <div class="text-capitalize">
                                <h4 class="card-title"><?= $language === 'ar' ? $insurance->name_ar : $insurance->name ?></h4>
                                <div class="mb-4 justify-content-center">
                                    <div class="price-text">
                                        <span class="small"><?= Yii::t('app', 'starts from') ?> </span>
                                        <div class="price price-show h3 text-warning">
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
</section>

 -->




<!--Hero start-->
<section class="bg-primary-dark pt-9 " data-cue="fadeIn" style="height: 600px;">
    <div class="container ">
        <div class="row align-items-center">
            <div class="col-lg-3 col-12 mt-3">
                <div class="text-center text-lg-start mb-7 mb-lg-0" data-cues="slideInDown">
                    <div class="mb-4">
                        <h3 class="text-white-50"></h3>
                        <h2 class="mb-3 mb-md-5">
                            <span class="text-warning"><?= Yii::t('app', 'Types') ?></span>
                            <span class="text-white">of Insurances</span>
                        </h2>
                        <p class="mb-0 text-white">
                            Explore a wide range of insurance options covering every aspect of your life, from health and travel to property and business.
                        </p>

                        <p class="mb-0 text-white">Edit your choices <a href="javascript:void(0);" onclick="history.back();" class="btn btn-link text-warning px-0 me-3">
                                <i class="bi bi-pencil-square"></i>
                            </a> </p>
                    </div>



                </div>
            </div>


            <div class="offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-lg-7  col-12">
                <div class="position-relative z-1 row pt-lg-9" data-cue="slideInRight">



                    <div class="card mb-3 mb-lg-4">
                        <!-- Header -->
                        <div class="card-header card-header-content-between pt-4">
                            <h5 class="card-header-title mb-0 ">Select the type of insurance that fits your needs.</h5>

                        </div>
            
                        <div class="card-body row">
                            <?php foreach (\common\models\Insurances::find()->all() as $insurance): ?>
                                <div class="col-md-3 mt-2 ZoomIn " data-cue="fadeIn">
                                    <a href="<?= Url::to(['/asurance/travel', 'id' => $insurance->id] + $data) ?>" class="card text-bg-light card-insurance zoom-img" data-cue="fadeUp">
                                        <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="card-img" alt="img">
                                        <div class="card-img-overlay  text-white d-inline-flex justify-content-start align-items-end overlay-dark">
                                            <div class="text-capitalize">
                                                <!-- <h4 class="card-title"><?= $language === 'ar' ? $insurance->name_ar : $insurance->name ?></h4> -->
                                                <div class="mb-4 justify-content-center">
                                                    <div class="mt-4">
                                                        <span class="small"><?= Yii::t('app', 'starts from') ?> </span>
                                                        <div class="price price-show  text-warning">
                                                            <span>$</span>
                                                            <span><?= $insurance->price ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </a> <small class="mt-3"><?= $language === 'ar' ? $insurance->name_ar : $insurance->name ?></small>

                                </div>
                            <?php endforeach; ?>



                        </div>
                        <!-- Body -->
                    </div>










                </div>
            </div>

        </div>
    </div>
</section>






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
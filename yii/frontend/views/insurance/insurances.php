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

$language=Yii::$app->language;
?>


<!-- <div class="pattern-square"></div> -->
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
    <div class="container" data-cue="fadeIn">
  
        <div class="row">
            <?php foreach (\common\models\Insurances::find()->all() as $insurance): ?>
            <div class="col-md-3 mt-3 ZoomIn" data-cue="fadeIn">
                <!-- Image overlay -->
                <a href="<?= Url::to(['/insurance/programs', 'slug' => $insurance->slug]) ?>" class="card text-bg-light shadow zoom-img" data-cue="fadeUp">
                    <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insurance->photo ?>" class="card-img" alt="img">
                    <div class="card-img-overlay text-white d-inline-flex justify-content-start align-items-end overlay-dark">
                        <div class="text-capitalize">
                            <h4 class="card-title"><?= $language === 'ar' ? $insurance->name_ar: $insurance->name?></h4>
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
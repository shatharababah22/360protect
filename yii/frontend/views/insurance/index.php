<?php

/** @var yii\web\View $this */
/** @var \frontend\models\InquiryForm $model */

use common\models\Plans;
use common\models\PlansCoverage;
use common\models\Pricing;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$language = Yii::$app->language;
$this->title = 'Plan Details';


?>


<!--Hero start-->
<section class="bg-primary-dark pt-10 <?= Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-slant-shape" data-cue="fadeIn">
    <div class="container">
        <div class="row align-items-center">
            <?php if (!empty($options)) : ?>
                <div class="col-lg-5 col-12">
                    <div class="text-center text-lg-start mb-7 mb-lg-0" data-cues="slideInDown">
                        <div class="mb-4">
                            <h3 class="text-white-50"></h3>
                            <h1 class="mb-3 mb-md-5">
                            
                                <span class="text-white "><?= ucwords(strtolower($language === 'ar' ? $insuranceTitleAr : $insuranceTitle)) ?></span>
                                    <span class="text-warning"><?= Yii::t('app', 'Assurance') ?></span>
                            </h1>
                            <p class="mb-0 text-white">
                                <span class="text-white-50"><?= Yii::t('app', 'From') ?></span> <?= $language === 'ar' ?  'الاردن' : 'Jordan' ?>
                                <span class="text-white-50"><?= Yii::t('app', 'To') ?></span> <?= $language === 'ar' ?  $toCountryName['name_ar'] : $toCountryName['name_en'] ?>
                                <a href="javascript:void(0);" onclick="history.back();" class="btn btn-link text-white-50 px-0 me-1 mx-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <br />
                                <span class="text-white-50"><?= Yii::t('app', 'Departure Date:') ?></span> <?= $model->date ?> (<?= $model->duration ?> <?= Yii::t('app', 'Days') ?>)<br />
                                <span class="text-white-50"><?= Yii::t('app', 'Passengers:') ?></span>
                                <!-- <?php if (isset($model->adult)) : ?>
                                    <?= $model->adult ?> <?= Yii::t('app', 'Adult') ?>
                                <?php endif; ?>
                                <span class="text-muted">|</span>
                                <?php if (isset($model->adult_senior)) : ?>
                                    <?= $model->adult_senior ?> <?= Yii::t('app', 'Senior Adult') ?>
                                <?php endif; ?>

                                <?php if (isset($model->children)) : ?>
                                    <span class="text-muted">|</span>
                                    <?php if ($model->children < 1) : ?>
                                        <?= $model->children ?> <?= Yii::t('app', 'Child') ?>
                                    <?php else : ?>
                                        <?= $model->children ?> <?= Yii::t('app', 'Children') ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (isset($model->infants)) : ?>
                                    <span class="text-muted">|</span>
                                    <?= $model->infants ?> <?= Yii::t('app', 'Infant') ?>
                                <?php endif; ?> -->

                                <?php if (!empty($model->adult)) : ?>
    <?= $model->adult ?> <?= Yii::t('app', 'Adult') ?>
<?php endif; ?>

<?php if (!empty($model->adult_senior)) : ?>
    <!-- <span class="text-muted">|</span> -->
    <?= $model->adult_senior ?> <?= Yii::t('app', 'Adult') ?>
<?php endif; ?>

<?php if (!empty($model->children) && $model->children > 0) : ?>
    <!-- <span class="text-muted">|</span> -->
    <?php if ($model->children == 1) : ?>
        <?= $model->children ?> <?= Yii::t('app', 'Child') ?>
    <?php else : ?>
        <?= $model->children ?> <?= Yii::t('app', 'Children') ?>
    <?php endif; ?>
<?php endif; ?>

<?php if (!empty($model->infants)) : ?>
    <span class="text-muted">|</span>
    <?= $model->infants ?> <?= Yii::t('app', 'Infant') ?>
<?php endif; ?>

                                <br />
                                <span class="text-white-50"><?= Yii::t('app', 'Passenger Type') ?>:</span> <?= '(' . $model->pax_type . ') ' . Yii::t('app', 'Years') ?><br />
                            </p>
                        </div>

                        <div data-cues="slideInDown">
                            <?=
                        Html::a(
                            '<i class="bi bi-arrow-down-square me-1"></i> Policy Wording',
                            Yii::$app->request->baseUrl . '/dashboard/images/' . $insuranceLink,
                            [
                                'class' => 'btn btn-outline-warning',
                                'target' => '_blank',
                                'download' => $insuranceLink,
                            ]
                        );
                        ?>
                                                    <img src="<?= Yii::$app->request->baseUrl ?>/dashboard/images/<?= $insuranceCountry->company_logo ?>" class="img-thumbnail" alt="logo" height="140" width="140">

                        </div>
                    </div>
                </div>
                <div class="offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-lg-5 col-12">
                    <div class="position-relative z-1 pt-lg-9" data-cue="slideInRight">
                        <div class="position-relative">
                            <?php $form = ActiveForm::begin(['options' => ['class' => 'row needs-validation g-3', 'id' => 'nextt']]) ?>
                            <div class="offer-box shadow-lg elevate p4 multiple-options">
                                <div class="accordion">
                                    <div class="head">


                                        <h4><?= Yii::t('app', 'Choose your plan') ?></h4>
                                        <p><?= Yii::t('app', 'Select one plan that suits options') ?></p>
                                    </div>
                                    <div class="options">
                                        <?= $form->field($model, 'plan')->radioList($options, [
                                            'item' => function ($index, $label, $name, $checked, $value) {
                                                $return = '<div class="purchasing-option"><div class="border-content">';
                                                $return .= '<label class="radio">';
                                                $return .= '<span class="radio-input me-1 mx-1">';


                                                $nameToUse = Yii::$app->language == 'ar' ? $label['name_ar'] : $label['name'];
                                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>';

                                                $return .= '<span class="radio-control"></span>';
                                                $return .= '</span>';
                                                $return .= '<span class="radio-label"><h5 id="buyNowHeading">' . ucwords($nameToUse) .
                                                    ' <small class="subscript" style="font-size: 11px;"><a href="#benefits"><x2>' . Yii::t('app', 'Check Benefits') . '</x2></a></small>' . '</h5>';

                                                if ($label['discount_price'] && $label['status']) {
                                                    $return .= '<div class="price has_subscript">';
                                                    $return .= '<h5><span style="font-size:15px;">JOD' . $label['discount_price'] . '</span><br><strike style="font-size:13px">JOD' . $label['price'] . '</strike></h5>';
                                                    $return .= '<div class="subscript">' . Yii::t('app', 'per person') . '</div>';
                                                    $return .= '</div>';
                                                } else {
                                                    $return .= '<div class="price has_subscript">';
                                                    $return .= '<h5>JOD' . $label['price'] . '</h5>';
                                                    $return .= '<div class="subscript">' . Yii::t('app', 'per person') . '</div>';
                                                    $return .= '</div>';
                                                }


                                                $return .= '</span></label></div></div>';
                                                return $return;
                                            },
                                        ])->label(false); ?>
                                        <div class="next-button">
                                            <?= Html::submitButton(Yii::t('app', 'Next'), [
                                                'class' => 'btn w-100 btn-warning',
                                                'name' => 'login-button',
                                                'id' => 'next-button'
                                            ]) ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <section class="py-5 mt-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <blockquote class="bg-white p-5 shadow rounded text-center">
                                    <?= Yii::t('app', 'Your trip from') ?>
                                    <p class="mb-0 mt-2 text-center">
                                        <span class="text-warning"><?= $fromCountryName ?> <?= Yii::t('app', 'to') ?> <?= $toCountryName ?></span><br />
                                        <?= Yii::t('app', 'Departure Date:') ?> <span class="text-warning"><?= $model->date ?> (<?= $model->duration ?> <?= Yii::t('app', 'Days') ?>)</span><br />
                                        <?= Yii::t('app', 'Passengers:') ?>
                                        <?php if (isset($model->adult)) : ?>
                                            <span class="text-warning"><?= $model->adult ?> <?= Yii::t('app', 'Adult') ?></span>
                                        <?php endif; ?>

                                        <?php if (isset($model->children)) : ?>
                                            <?php if ($model->children < 1) : ?>
                                                <span class="text-warning">| <?= $model->children ?> <?= Yii::t('app', 'Child') ?></span>
                                            <?php else : ?>
                                                <span class="text-warning">| <?= $model->children ?> <?= Yii::t('app', 'Children') ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if (isset($model->infants)) : ?>
                                            <span class="text-warning">| <?= $model->infants ?> <?= Yii::t('app', 'Infant') ?></span>
                                        <?php endif; ?><br> <?= Yii::t('app', 'is not valid') ?>
                                    </p>
                                    <footer class="blockquote-footer pt-4 mt-4 border-top">
                                        <a href="javascript:void(0);" onclick="history.back();" class="btn btn-link text-warning px-0 me-3">
                                            <i class="bi bi-pencil-square"></i> <?= Yii::t('app', 'Edit') ?>
                                        </a>
                                        <cite title="Source Title"><?= Yii::t('app', 'Try again') ?></cite>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </div>
</section>

<!--Hero start-->
<!--Compare plan start-->
<section class="my-xl-9 py-5" id="benefits">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="text-center mb-7">
                    <h2><?= Yii::t('app', 'Schedule of Benefits & Coverage') ?></h2>
                    <p class="mb-0"><?= Yii::t('app', 'Travel with peace of mind and enjoy comprehensive benefits.') ?></p>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Striped rows -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped text-nowrap table-md table-borderless">
                        <thead > <?php if (!empty($options)) : ?>
                                <tr >
                                    <th scope="col">
                                        <div class="fs-5 text-dark fw-semibold"><?= Yii::t('app', 'Plans') ?></div>
                                    </th>

                                    <?php foreach ($plans as $plan) : ?>

                                        <th scope="col">
                                            <div class="fs-5 text-dark fw-semibold">
                                                <?= $language === 'ar' ? $plan->name_ar : $plan->name ?>
                                            </div>
                                        </th>
                                    <?php endforeach; ?>

                                </tr>
                        </thead>
                        <tbody >
                            <?php foreach (\common\models\PlansItems::find()->where(['insurance_id' => $model->type])->all() as $planitem) : ?>
                                <tr class="clickable-row">
                                    <td class="p-2">



                                        <?php
                                        $title = $language === 'ar' ? $planitem->title_ar : $planitem->title;
                                        $maxLength = 28;

                                        if (strlen($title) > $maxLength) {
                                            $splitPoint = strpos($title, ' ', $maxLength);
                                            if ($splitPoint === false) {
                                                $splitPoint = $maxLength;
                                            }
                                            $firstLine = substr($title, 0, $splitPoint);
                                            $secondLine = substr($title, $splitPoint);
                                        } else {
                                            $firstLine = $title;
                                            $secondLine = '';
                                        }
                                        ?>
                                        <span class="ms-2 text-wrap ">
                                            <?= $title ?>
                                          
                                        </span>



                                    </td>



                                    <?php foreach ($plans as $plan) : ?>

                                        <td>
                                            <?php
                                            $planCoverage = \common\models\PlansCoverage::find()->where(['item_id' => $planitem->id, 'plan_id' => $plan->id])->one();
                                            if ($planCoverage) :
                                            ?>
                                                <?php if ($planCoverage->YorN == 'Active') : ?>
                                                    <div class="d-flex "> <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                            </svg>
                                                        </span>
                                                        <span class="ms-2 text-wrap">


                                                            <?= $planCoverage->description ?>
                                                        </span>
                                                    </div>




                                                <?php else : ?>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                        </svg>
                                                    </span>
                                                    <span class="ms-2">N/A</span>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x-circle-fill text-danger" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                    </svg>
                                                </span>
                                                <span class="ms-2">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?> <?php else : ?>
                            <tr>
                                <td colspan="14" class="dataTables_empty">
                                    <div class="text-center ">
                                        <img class="mb-3" src="https://static.vecteezy.com/system/resources/previews/009/007/126/non_2x/document-file-not-found-search-no-result-concept-illustration-flat-design-eps10-modern-graphic-element-for-landing-page-empty-state-ui-infographic-icon-vector.jpg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">

                                        <!-- <img class="mb-3" src="https://as2.ftcdn.net/v2/jpg/02/34/31/27/1000_F_234312709_1CXqUZHqg62VE5VhsVEyQUmj69zZHwk9.jpg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default"> -->
                                        <p class="mb-0">No data to show</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
<!--Compare plan end-->
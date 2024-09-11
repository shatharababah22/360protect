<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use borales\extensions\phoneInput\PhoneInput;
use common\widgets\Alert;


/** @var \common\models\PolicyDraft $policy */

$this->title = 'Trip Details Submission';
?>
<div class="pattern-square"></div>
<!--Pageheader start-->
<section class="pt-10 pb-10 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable"><span class="text-warning"><?= Yii::t('app', 'Trip') ?></span> <?= Yii::t('app', 'Information - New Insurance') ?></h1>
            </div>
        </div>
    </div>
</section>









<section class="mb-xl-9 my-5">
    <div class="container mt-1">
        <div class="row">
            <div class="col-lg-10 offset-lg-<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-1 col-md-12 col-12">
                <?= Alert::widget() ?>
                <div class="row g-xl-7 gy-5">
                    <div class="col-md-7 col-12">
                        <div class="card shadow-sm">
                            <!-- <div class="card-body">
                                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'row needs-validation g-3']]) ?>
                                <div class="col-md-6">
                                    <label class="form-label" for="from_airport"><?= Yii::t('app', 'From Airport') ?></label>
                                    <?= $form->field($policy, 'from_airport')->dropDownList(
                                        \yii\helpers\ArrayHelper::map(
                                            \common\models\Airports::find()
                                                ->leftJoin('countries', 'countries.code = airports.countryCode')->where(['countries.code' => $policy->DepartCountryCode])
                                                ->all(),
                                            'code',
                                            'name'
                                        )
                                    )->label(false);  ?>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="going_to"><?= Yii::t('app', 'Going to') ?></label>
                                    <?= $form->field($policy, 'going_to')->dropDownList(
                                        \yii\helpers\ArrayHelper::map(
                                            \common\models\Airports::find()
                                                ->leftJoin('countries', 'countries.code = airports.countryCode')
                                                ->where(['countries.code' => $policy->ArrivalCountryCode])
                                                ->all(),
                                            'code',
                                            'name'
                                        )
                                    )->label(false);  ?>
                                </div>

                                <?php if (!empty($savedFiles)) : ?>
                                    <p class="m-0"><?= Yii::t('app', 'Upload Files') ?></p>
                                    <div class="col-12 table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><?= Yii::t('app', 'NO') ?></th>
                                                    <th><?= Yii::t('app', 'Name') ?></th>
                                                    <th><?= Yii::t('app', 'Gender') ?></th>
                                                    <th><?= Yii::t('app', 'DOB') ?></th>
                                                    <th><?= Yii::t('app', 'Nationality') ?></th>
                                                    <th><?= Yii::t('app', 'Action') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($savedFiles as $file) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $file->id_number ?></td>
                                                        <td class="text-center"><?= $file->first_name . '  ' . $file->last_name ?></td>
                                                        <td class="text-center"><?= $file->gender ?></td>
                                                        <td class="text-center"><?= $file->dob ?></td>
                                                        <td class="text-center"><?= $file->nationality ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger btn-sm delete-file" data-id="<?= $file->id ?>">
                                                                <i class="bi bi-trash" style="font-size: 15px;"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>

                                <?php if ($model->attributes()): ?>
                                    <p class="mb-2"><?= Yii::t('app', 'Upload all passengers passports separated') ?></p>
                                    <?php foreach ($model->attributes() as $input) : ?>
                                        <div class="col-md-12" dir='ltr'>
                                            <?= $form->field($model, $input)->fileInput() ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>


                                <div class="col-md-12">
                                    <label class="form-label" for="name"><?= Yii::t('app', 'Your name') ?></label>

                                    <?= $form->field($policy, 'name')->textInput(['placeholder' => Yii::t('app', 'John Doe')])->label(false) ?>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label" for="email"><?= Yii::t('app', 'Email') ?></label>

                                    <?= $form->field($policy, 'email')->textInput(['placeholder' => Yii::t('app', 'example@gmail.com')])->label(false) ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="policydraft-mobile"><?= Yii::t('app', 'Mobile') ?></label>
                                    <div dir='ltr'> <?= $form->field($policy, 'mobile')->widget(PhoneInput::class, [
                                                        'jsOptions' => [
                                                            'preferredCountries' => ['jo'],
                                                            'class' => '',
                                                            'style' => 'padding-right:90px;'
                                                        ]
                                                    ])->label(false); ?></div>

                                </div>

                                <div class="d-grid">
                                    <?= Html::submitButton(Yii::t('app', 'Review'), ['class' => 'btn w-100 btn-primary text-white', 'name' => 'login-button']) ?>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div> -->


                            <div class="card-body">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'row needs-validation g-3']]) ?>

    <!-- First Section -->
    <div class="col-md-12">
        <h5><?= Yii::t('app', 'Flight Details') ?></h5>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="from_airport"><?= Yii::t('app', 'From Airport') ?></label>
                <?= $form->field($policy, 'from_airport')->dropDownList(
                    \yii\helpers\ArrayHelper::map(
                        \common\models\Airports::find()
                            ->leftJoin('countries', 'countries.code = airports.countryCode')
                            ->where(['countries.code' => $policy->DepartCountryCode])
                            ->all(),
                        'code',
                        'name'
                    )
                )->label(false); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="going_to"><?= Yii::t('app', 'Going to') ?></label>
                <?= $form->field($policy, 'going_to')->dropDownList(
                    \yii\helpers\ArrayHelper::map(
                        \common\models\Airports::find()
                            ->leftJoin('countries', 'countries.code = airports.countryCode')
                            ->where(['countries.code' => $policy->ArrivalCountryCode])
                            ->all(),
                        'code',
                        'name'
                    )
                )->label(false); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-2">
    <h5 ><?= Yii::t('app', 'Passports') ?></h5>
    <hr>
    <?php if ($model->attributes()): ?>
                                    <p class="mb-3"><?= Yii::t('app', 'Upload all passengers passports separated') ?></p>
                                    <?php foreach ($model->attributes() as $input) : ?>
                                        <div class="col-md-12" dir='ltr'>
                                            <?= $form->field($model, $input)->fileInput() ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

    </div>
    <!-- Second Section -->
    <?php if (!empty($savedFiles)) : ?>
        <div class="col-md-12 mt-4">
            <h5><?= Yii::t('app', 'Uploaded Files') ?></h5>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th><?= Yii::t('app', 'NO') ?></th>
                            <th><?= Yii::t('app', 'Name') ?></th>
                            <th><?= Yii::t('app', 'Gender') ?></th>
                            <th><?= Yii::t('app', 'DOB') ?></th>
                            <th><?= Yii::t('app', 'Nationality') ?></th>
                            <th><?= Yii::t('app', 'Action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($savedFiles as $file) : ?>
                            <tr>
                                <td class="text-center"><?= $file->id_number ?></td>
                                <td class="text-center"><?= $file->first_name . ' ' . $file->last_name ?></td>
                                <td class="text-center"><?= $file->gender ?></td>
                                <td class="text-center"><?= $file->dob ?></td>
                                <td class="text-center"><?= $file->nationality ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm delete-file" data-id="<?= $file->id ?>">
                                        <i class="bi bi-trash" style="font-size: 15px;"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <!-- Third Section -->
    <div class="col-md-12 mt-2">
        <h5><?= Yii::t('app', 'Personal Information') ?></h5>
        <hr>
        <div class="row">
            <div class="col-md-12" >
                <?= $form->field($policy, 'name')->textInput(['placeholder' => Yii::t('app', 'John Doe')])->label(Yii::t('app', 'Your Name')) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($policy, 'email')->textInput(['placeholder' => Yii::t('app', 'example@gmail.com')])->label(Yii::t('app', 'Email')) ?>
            </div>

            <div class="col-md-6">
                                    <label class="form-label" for="policydraft-mobile"><?= Yii::t('app', 'Mobile') ?></label>
                                    <div dir='ltr'> <?= $form->field($policy, 'mobile')->widget(PhoneInput::class, [
                                                        'jsOptions' => [
                                                            'preferredCountries' => ['jo'],
                                                            'class' => '',
                                                            'style' => 'padding-right:90px;'
                                                        ]
                                                    ])->label(false); ?></div>

                                </div>
        </div>
    </div>

    <div class="d-grid mt-4">
        <?= Html::submitButton(Yii::t('app', 'Review'), ['class' => 'btn w-100 btn-primary text-white', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>

                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="card shadow-sm">


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><?= Yii::t('app', 'Departure:') ?> </span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <span class="fw-bold"><?=  Yii::$app->language == 'ar'? $fromCountryName['name_ar']: $fromCountryName['name_en'] ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><?= Yii::t('app', 'Arrival:') ?> </span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <span class="fw-bold"><?= Yii::$app->language == 'ar'?  $toCountryName['name_ar'] :  $toCountryName['name_en'] ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><?= Yii::t('app', 'Date:') ?> </span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <span class="fw-bold"><?= $policy->departure_date  ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><?= Yii::t('app', 'Return Date:') ?> </span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <span class="fw-bold"><?= $policy->return_date  ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><?= Yii::t('app', 'Passengers:') ?> </span>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <span class="fw-bold"><?= ($policy->AdultCount + $policy->ChildrenCount + $policy->InfantCount)  ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><?= Yii::t('app', 'Confirm Deletion') ?></h5>
                <div dir="ltr"> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Yii::t('app', 'Close') ?>"></button>
                </div>
            </div>
            <div class="modal-body">
                <?= Yii::t('app', 'Are you sure you want to delete this file?') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= Yii::t('app', 'Cancel') ?></button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn"><?= Yii::t('app', 'Delete') ?></button>
            </div>
        </div>
    </div>
</div>



<div id="preloader">
    <div id="loader" class="<?= $languageDirection = Yii::$app->language == 'ar' ? 'rtl' : 'ltr' ?>-loader"></div>
</div>




<script>
    var fileIdToDelete = null;
    var $trToDelete = null;

    $(document).on('click', '.delete-file', function() {
        fileIdToDelete = $(this).data('id');
        $trToDelete = $(this).closest('tr');
        $('#deleteModal').modal('show');
    });

    $('#confirmDeleteBtn').on('click', function() {
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['delete-file']) ?>',
            type: 'POST',
            data: {
                id: fileIdToDelete
            },
            success: function(response) {
                if (response.success) {
                    $trToDelete.remove();
                    location.reload();
                    $('#deleteModal').modal('hide');
                } else {
                    alert('Failed to delete the file.');
                }
            }
        });
    });



    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            document.getElementById('preloader').style.display = 'flex';
        });
    });

    window.onload = function() {
        document.getElementById('preloader').style.display = 'none';
    };


    // $(window).on('load', function() {
    //     $('#preloader').fadeOut('slow', function() {
    //         $(this).remove();
    //     });
    // });
</script> 
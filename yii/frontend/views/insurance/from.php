<?php

/** @var \frontend\models\InquiryForm $model */

/** @var yii\web\View $this */

use common\models\Countries;
use common\models\Insurances;


use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;


// $insuranceId = Insurances::find()
//     ->select('id')
//     ->where(['name' => 'travel'])
//     ->scalar();

// if ($insuranceId !== false) {
//     var_dump($insuranceId); // This will return the insurance ID if found.
// } else {
//     echo 'No insurance found with the name "travel".';
// }


$insuranceId = Insurances::find()
    ->select('id')
    ->where(['like', 'LOWER(name)', 'travel'])
    ->one()??null; 



// var_dump($insurance->id)
?>








<!-- <div class="card shadow-sm">
    <div class="card-body">
        <form action="/asurance/travel" method="get" class="row needs-validation g-3" novalidate>
            <div class="col-lg-12">
                <div class="mb-3">
                    <h3 class="mb-0 text-center">Get Covered</h3>
                    <input type="hidden" name="type" value="<?= $country->insurance_id ?? $insurance->id ?? 1 ?>">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label for="fromCountry" class="form-label">
                    From
                    <span class="text-danger">*</span>
                </label>
                <?php
                $countries = Countries::find()->orderBy('name_en')->all();
                $allCountries = [];

                foreach ($countries as $country) {
                    $code = strtoupper($country->code);
                    $allCountries[$code] = $country->name_en;
                }

                if (isset($sourceCountry)) {
                    $sourceCountryCode = strtoupper($sourceCountry);

                    if (isset($allCountries[$sourceCountryCode])) {
                        $sourceCountryName = $allCountries[$sourceCountryCode];
                        unset($allCountries[$sourceCountryCode]);
                        $allCountries = [$sourceCountryCode => $sourceCountryName] + $allCountries;
                    }


                ?>
                    <select name="from_country" id="fromCountry" class="form-control" required>
                        <option value="" disabled <?= $sourceCountryCode === null ? 'selected' : '' ?>>Departure</option>
                        <?php foreach ($allCountries as $code => $name): ?>
                            <option value="<?= htmlspecialchars($code) ?>" <?= $code === $sourceCountryCode ? 'selected' : '' ?>>
                                <?= htmlspecialchars($name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php
                } else {

                ?>
                    <select name="from_country" id="fromCountry" class="form-control" required>
                        <option value="" disabled selected>Departure</option>
                        <?php foreach ($allCountries as $code => $name): ?>
                            <option value="<?= htmlspecialchars($code) ?>"><?= htmlspecialchars($name) ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php
                }
                ?>
                <div class="invalid-feedback">
                    The departure country can't be blank.
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label for="toCountry" class="form-label">
                    To
                    <span class="text-danger">*</span>
                </label>
                <select id="toCountry" name="to_country" class="form-control" required>
                    <option value="" disabled selected>Arrival</option>
                    <?php foreach ($allCountries as $code => $name): ?>
                        <option value="<?= $code ?>"><?= $name ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="invalid-feedback">
                    The arrival country can't be blank.
                </div>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">
                    Departure Date
                    <span class="text-danger">*</span>
                </label>
                <input type="text" id="date" name="date" class="form-control js-flatpickr" placeholder="Select date" required>
                <div class="invalid-feedback">
                    The departure date can't be blank.
                </div>
            </div>
            <div class="col-md-6">
                <label for="duration" class="form-label">
                    Days (Duration)
                    <span class="text-danger">*</span>
                </label>
                <select id="duration" name="duration" class="form-control" required>
                    <option value="" disabled selected>Duration</option>
                    <option value="7">7 days</option>
                    <option value="10">10 days</option>
                    <option value="15">15 days</option>
                    <option value="21">21 days</option>
                    <option value="30">1 month</option>
                    <option value="60">2 months</option>
                    <option value="90">3 months</option>
                    <option value="180">6 months</option>
                    <option value="365">1 year</option>
                    <option value="730">2 years</option>
                    <option value="1095">3 years</option>
                </select>
                <div class="invalid-feedback">
                    The duration can't be blank.
                </div>
            </div>
            <div class="col-md-12">
                <label for="pax-type-dropdown" class="form-label">Passenger Type<span class="text-danger">*</span></label>
                <select id="pax-type-dropdown" name="pax_type" class="form-control" required>
                    <option value="" disabled selected>Pax Type</option>
                    <option value="76-85">Adult 76-85 Years</option>
                    <option value="19-75">Adult 19-75 Years</option>
                    <option value="2-18">Child 2-18 Years</option>
                </select>

                <div class="invalid-feedback">
                    The Passenger Type can't be blank.
                </div>
            </div>
            <div id="fields-container">
                <div id="adult1" class="field-group col-12" style="display:none;">
                    <label for="adult1" class="form-label">Adult<span class="text-danger">*</span></label>
                    <select id="adult1" name="adult1" class="form-control">
                        <?php for ($i = 0; $i <= 50; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="row" id="adult3">


                    <div id="adult" class="field-group col-md-6 col-12" style="display:none;">
                        <label for="adult" class="form-label">Adult<span class="text-danger">*</span></label>
                        <select id="adult" name="adult" class="form-control">
                            <?php for ($i = 0; $i <= 50; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div id="infant" class="field-group col-md-6 col-12" style="display:none;">
                        <label for="infants" class="form-label">Infant<span class="text-danger">*</span></label>
                        <select id="infants" name="infants" class="form-control">
                            <?php for ($i = 0; $i <= 2; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div id="child" class="field-group col-12" style="display:none;">
                    <label for="children" class="form-label">Child<span class="text-danger">*</span></label>
                    <select id="children" name="children" class="form-control">
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <p id="adult1-note" class="text-muted small mb-0">Adult age must be between 19-75 years old</p>
                <p id="infant-note" class="text-muted small">Infant age must be between 30 days-2 years old</p>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-warning">Next</button>
            </div>
        </form>


    </div>
</div> -->

<div class="card shadow-sm">
    <div class="card-body">

    <?php if (isset($insurance->id)): ?>
    <form action="/asurance/travel" method="get" class="row needs-validation g-3" novalidate>
<?php else: ?>
    <form action="/asurance/kinds" method="get" class="row needs-validation g-3" novalidate>
<?php endif; ?>

            <div class="col-lg-12">
                <div class="mb-3">
                    <h3 class="mb-0 text-center"><?= Yii::t('app', 'Get Covered') ?></h3>
                    <input type="hidden" name="type" value="<?= $insurance->id??1?>">

                </div>
            </div>
            <div class="col-md-6 col-12">
                <label for="fromCountry" class="form-label">
                    <?= Yii::t('app', 'From') ?>
                    <span class="text-danger">*</span>
                </label>
                <?php
   
    $countries = Countries::find()->orderBy('name_en')->all();

   
    $allCountries = [];
    

    foreach ($countries as $country) {
        $code = strtoupper($country->code);
       
        $allCountries[$code] = (Yii::$app->language === 'ar') ? $country->name_ar : $country->name_en;
    }

    if (isset($sourceCountry)) {
        $sourceCountryCode = strtoupper($sourceCountry);
   
        if (isset($allCountries[$sourceCountryCode])) {
            $sourceCountryName = $allCountries[$sourceCountryCode];
            unset($allCountries[$sourceCountryCode]);
            $allCountries = [$sourceCountryCode => $sourceCountryName] + $allCountries;
        }
    }

  
    ?>
    <select name="from_country" id="fromCountry" class="form-control" required>
        <option value="" disabled <?= !isset($sourceCountryCode) ? 'selected' : '' ?>>
            <?= Yii::t('app', 'Departure') ?>
        </option>
        <?php foreach ($allCountries as $code => $name): ?>
            <option value="<?= htmlspecialchars($code) ?>" <?= isset($sourceCountryCode) && $code === $sourceCountryCode ? 'selected' : '' ?>>
                <?= htmlspecialchars($name) ?>
            </option>
        <?php endforeach; ?>
    </select>


                <div class="invalid-feedback">
                    <?= Yii::t('app', "The departure country can't be blank.") ?>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <label for="toCountry" class="form-label">
                    <?= Yii::t('app', 'To') ?>
                    <span class="text-danger">*</span>
                </label>
                <select id="toCountry" name="to_country" class="form-control" required>
                    <option value="" disabled selected><?= Yii::t('app', 'Arrival') ?></option>
                    <?php foreach ($allCountries as $code => $name): ?>
                        <option value="<?= $code ?>"><?= $name ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="invalid-feedback">
                    <?= Yii::t('app', "The arrival country can't be blank.") ?>
                </div>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">
                    <?= Yii::t('app', 'Departure Date') ?>
                    <span class="text-danger">*</span>
                </label>
                <input type="text" id="date" name="date" class="form-control js-flatpickr" placeholder="<?= Yii::t('app', 'Select date') ?>" required>
                <div class="invalid-feedback">
                    <?= Yii::t('app', "The departure date can't be blank.") ?>
                </div>
            </div>
            <div class="col-md-6">
                <label for="duration" class="form-label">
                    <?= Yii::t('app', 'Days (Duration)') ?>
                    <span class="text-danger">*</span>
                </label>
                <select id="duration" name="duration" class="form-control" required>
                    <option value="" disabled selected><?= Yii::t('app', 'Duration') ?></option>
                    <option value="7"> <?= Yii::t('app', '7 days') ?></option>
                    <option value="10"><?= Yii::t('app', '10 days') ?></option>
                    <option value="15"> <?= Yii::t('app', '15 days') ?></option>
                    <option value="21"><?= Yii::t('app', '21 days') ?></option>
                    <option value="30"><?= Yii::t('app', '1 month') ?></option>
                    <option value="60"><?= Yii::t('app', '2 months') ?></option>
                    <option value="90"><?= Yii::t('app', '3 months') ?></option>
                    <option value="180"><?= Yii::t('app', '6 months') ?></option>
                    <option value="365"><?= Yii::t('app', '1 year') ?></option>
                    <option value="730"><?= Yii::t('app', '2 years') ?></option>
                    <option value="1095"><?= Yii::t('app', '3 years') ?></option>
                </select>
                <div class="invalid-feedback">
                    <?= Yii::t('app', "The duration can't be blank.") ?>
                </div>
            </div>
            <div class="col-md-12">
                <label for="pax-type-dropdown" class="form-label"><?= Yii::t('app', 'Passenger Type') ?><span class="text-danger">*</span></label>
                <select id="pax-type-dropdown" name="pax_type" class="form-control" required>
                    <option value="" disabled selected><?= Yii::t('app', 'Pax Type') ?></option>
                    <option value="76-85"><?= Yii::t('app', 'Adult 76-85 Years') ?></option>
                    <option value="19-75"><?= Yii::t('app', 'Adult 19-75 Years') ?></option>
                    <option value="2-18"><?= Yii::t('app', 'Child 2-18 Years') ?></option>
                </select>

                <div class="invalid-feedback">
                    <?= Yii::t('app', "The Passenger Type can't be blank.") ?>
                </div>
            </div>
            <div id="fields-container">
                <div id="adult1" class="field-group col-12" style="display:none;">
                    <label for="adult10" class="form-label"><?= Yii::t('app', 'Adult') ?><span class="text-danger">*</span></label>
                    <select id="adult10" name="adult_senior" class="form-control">
                        <?php for ($i = 0; $i <= 50; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="row" id="adult3">
                    <div id="adult" class="field-group col-md-6 col-12" style="display:none;">
                        <label for="adult11" class="form-label"><?= Yii::t('app', 'Adult') ?><span class="text-danger">*</span></label>
                        <select id="adult11" name="adult" class="form-control">
                            <?php for ($i = 0; $i <= 50; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div id="infant" class="field-group col-md-6 col-12" style="display:none;">
                        <label for="infants" class="form-label"><?= Yii::t('app', 'Infant') ?><span class="text-danger">*</span></label>
                        <select id="infants" name="infants" class="form-control">
                            <?php for ($i = 0; $i <= 2; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div id="child" class="field-group col-12" style="display:none;">
                    <label for="children" class="form-label"><?= Yii::t('app', 'Child') ?><span class="text-danger">*</span></label>
                    <select id="children" name="children" class="form-control">
                        <?php for ($i = 0; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
   
            <p id="adult1-note" class="text-muted small mb-0"><?= Yii::t('app', 'Senior Adult 76 to 85 years - Adult 19 to 75 years') ?></p>
<p id="infant-note" class="text-muted small"><?= Yii::t('app', 'Child 2 to 18 years - Infant 30 days to 2 years') ?></p>

            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-warning"><?= Yii::t('app', 'Next') ?></button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var paxTypeDropdown = document.getElementById('pax-type-dropdown');
        var adultFields = document.getElementById('adult');
        var adult2Fields = document.getElementById('adult2');
        var adult1Fields = document.getElementById('adult1');
        var childFields = document.getElementById('child');
        var infantFields = document.getElementById('infant');

console.log( document.getElementById('childern'));
        function updateFields(selectedPaxType) {
            console.log('Updating fields for pax type:', selectedPaxType);


            adultFields.style.display = 'none';
            adult1Fields.style.display = 'none';
            childFields.style.display = 'none';
            infantFields.style.display = 'none';


            if (selectedPaxType === '19-75') {
                console.log('Showing fields for 19-75');
                adultFields.style.display = 'block';
                infantFields.style.display = 'block';
                adult2Fields.style.display = 'block';
                document.getElementById('adult11').value = 0;
                document.getElementById('children').value = 0;
            //  console.log(document.getElementById('adult11'));

            } else if (selectedPaxType === '2-18') {
                console.log('Showing fields for 2-18');
                childFields.style.display = 'block';


                document.getElementById('infants').value = 0;
            document.getElementById('adult10').value = 0;
            document.getElementById('adult11').value = 0;
       
            // console.log(infantFields ,adult1Fields)


            } else if (selectedPaxType === '76-85') {
                console.log('Showing fields for 76-85');
                document.getElementById('infants').value = 0;
                document.getElementById('adult10').value = 0;
                
                adult1Fields.style.display = 'block';
            } else {
                console.log('No pax type selected or invalid');
            }
        }


        paxTypeDropdown.addEventListener('change', function() {
            var selectedPaxType = this.value;
            console.log('Selected pax type:', selectedPaxType);


            localStorage.setItem('paxType', selectedPaxType);


            updateFields(selectedPaxType);
        });


        function loadSavedPaxType() {
            var savedPaxType = localStorage.getItem('paxType');
            if (savedPaxType) {
                console.log('Loaded saved pax type:', savedPaxType);
                paxTypeDropdown.value = savedPaxType;
                updateFields(savedPaxType);
            } else {
                console.log('No saved pax type found.');
            }
        }

        loadSavedPaxType();
    });
</script>

<!-- 
<script>
    $(document).ready(function() {
        $('#pax-type-dropdown').change(function() {
            var selectedValue = $(this).val();
            $('.field-group').hide();

            if (selectedValue === '76-85') {
                $('#adult1').show();
                
            } else if (selectedValue === '19-75') {
                $('#adult').show();
                $('#adult .col-md-6').show();

            
            }else if(selectedValue === '2-18') {
    $('#child').show();

            }
        });
    });

    
</script> -->
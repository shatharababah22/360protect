<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\PlansItems $model */
/** @var yii\widgets\ActiveForm $form */
?>








<div class="Benefit-form">

                <?php $form = ActiveForm::begin(); ?>


      

    

                <div class="mb-2">
<label class="form-label">Insurance Name</label>
<?= $form->field($model, 'insurance_id', ['options' => ['class' => 'col-sm-12']])->dropDownList(
    \yii\helpers\ArrayHelper::map(
        \common\models\Insurances::find()->all(),
        'id',
        'name'
    ),
    ['class' => 'form-select']
)->label(false) ?></div>

<div class="mb-2">

<label class="form-label">Title</label>
<?= $form->field($model, 'title', ['options' => ['class' => 'col-sm-12']])->label(false) ?>
</div>











<hr class="mb-3 border-0" style="margin: 1px 2px ;">
<label class="form-label mb-2">  <h4 class="card-header-title">Translation Fields</h4></label><hr class="mb-4" style="margin: 1px 2px ;">
<div class="mb-4">
<label class="form-label">Title (Arabic)</label>
<?= $form->field($model, 'title_ar', ['options' => ['class' => 'col-sm-12']])->label(false) ?>
</div>






    <div class="form-group d-flex justify-content-end ">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary save-button']) ?>
   
    </div>

    <?php ActiveForm::end(); ?>
            </div>
            <!-- End Card Body -->
        </div>
        <!-- End Card -->
    </div>
    <!-- End Col -->
</div>
<!-- End Row -->
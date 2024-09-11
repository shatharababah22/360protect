<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\Airports $model */
/** @var yii\widgets\ActiveForm $form */
?>








<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // Important for file uploads
]); ?>



<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>




<div class="row mb-2">

    <?= $form->field($model, 'cityName', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'countryCode', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'countryName', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>

</div>

<div class="row mb-2">

    <?= $form->field($model, 'code', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cityCode', ['options' => ['class' => 'col-sm-6']])->textInput(['maxlength' => true]) ?>

</div>



<div class="form-group d-flex justify-content-end ">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary save-button']) ?>
   
    </div>

<?php ActiveForm::end(); ?>
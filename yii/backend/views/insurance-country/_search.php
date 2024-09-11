<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\InsuranceCountriesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="insurance-countries-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id',['options' => ['class' => 'mt-2']])  ?> -->


    <?= $form->field($model, 'insurance_name', ['options' => ['class' => 'mt-2']])  ?>

   

    <?= $form->field($model, 'country_code',['options' => ['class' => 'mt-2']])  ?>

    <?= $form->field($model, 'company_name',['options' => ['class' => 'mt-2']])  ?>

    <!-- <?= $form->field($model, 'company_logo',['options' => ['class' => 'mt-2']])  ?> -->

    <?php  echo $form->field($model, 'source_country',['options' => ['class' => 'mt-2']])  ?>

    <?php  echo $form->field($model, 'source_country_code',['options' => ['class' => 'mt-2']])  ?>

 
    <div class="offcanvas-footer ">
      <div class="row ">
        <div class="col">
          <div class="d-grid">
          <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
          </div>
        </div>
   
        <div class="col">
          <div class="d-grid">
        <?=Html::a('Reset', ['index'], ['class' => 'btn btn-white'])?>
        </div>
        </div>
    
      </div>
      
    </div>
    <?php ActiveForm::end(); ?>

</div>

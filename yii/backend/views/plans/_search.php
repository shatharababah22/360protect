<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PlansSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id', ['options' => ['class' => 'mt-2']])  ?> -->

    <?= $form->field($model, 'insurance_name', ['options' => ['class' => 'mt-2']])  ?>

    <?= $form->field($model, 'name', ['options' => ['class' => 'mt-2']])  ?>
<!-- 
    <?= $form->field($model, 'description', ['options' => ['class' => 'mt-2']])  ?>

    <?= $form->field($model, 'overview', ['options' => ['class' => 'mt-2']])  ?> -->
<!-- 
    <?php  echo $form->field($model, 'max_age', ['options' => ['class' => 'mt-2']])  ?>

    <?php  echo $form->field($model, 'min_age', ['options' => ['class' => 'mt-2']])  ?> -->

    <?php  echo $form->field($model, 'plan_code', ['options' => ['class' => 'mt-2']])  ?>

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

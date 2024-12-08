<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CustomerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<?php  echo $form->field($model, 'name', ['options' => ['class' => 'mt-2']])  ?> 
<?php  echo $form->field($model, 'email', ['options' => ['class' => 'mt-2']])  ?>
<?php  echo $form->field($model, 'mobile', ['options' => ['class' => 'mt-2']])  ?>

<!-- 
    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'country') ?> -->

    <?php // echo $form->field($model, 'credit') ?>

    
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

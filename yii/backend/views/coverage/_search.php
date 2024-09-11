<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PlansCoverageSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plans-coverage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id',['options' => ['class' => 'mt-2']])  ?> -->

    <?= $form->field($model, 'item_id', ['options' => ['class' => 'mt-2']])->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\PlansItems::find()->all(),
            
            'id',
            'title'
        ),
        ['class' => 'form-select']
    ) ?>


<?= $form->field($model, 'plan_id', ['options' => ['class' => 'mt-2']])->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\Plans::find()->all(),
            
            'id',
            'plan_code'
        ),
        ['class' => 'form-select']
    ) ?>


    <?= $form->field($model, 'description',['options' => ['class' => 'mt-2']])  ?>
    <?= $form->field($model, 'YorN' ,['options' => ['class' => 'mt-2']])->dropDownList(
                [
                  '' => 'Select Status', 
                  'Yes' => 'yes',
                    'No' => 'No',
                   
                ],
                ['class' => 'form-select']
            ) ?>
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

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PlansItemsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plans-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    

    <?= $form->field($model, 'title',['options' => ['class' => 'mt-2']])  ?>

    <?= $form->field($model, 'insurance_id', ['options' => ['class' => 'mt-2']])->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\Insurances::find()->all(),
    
            'id',
            'name'
        ),
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

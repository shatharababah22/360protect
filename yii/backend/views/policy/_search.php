<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PolicySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="policy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'customer_id', ['options' => ['class' => 'mt-2']])->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\Customers::find()->all(),
            'id',
            'email'
        ),
        ['class' => 'form-select','prompt' => 'Select email']
    ) ?>
   
    <?= $form->field($model, 'from_airport', ['options' => ['class' => 'mt-2']]) ?>
    <?= $form->field($model, 'departure_date', ['options' => ['class' => 'mt-2']])  ?>
    <?php  echo $form->field($model, 'going_to', ['options' => ['class' => 'mt-2']])  ?>
    <?php  echo $form->field($model, 'return_date', ['options' => ['class' => 'mt-2']])  ?>



    <?= $form->field($model, 'status', ['options' => ['class' => 'mt-2']])
    ->dropDownList(
        [
            '' => 'Select Status', 
            '1' => 'Active',
            '0' => 'Inactive',
        ],
        ['class' => 'form-select']
    )
    ; 
?>



 


    <?php  echo $form->field($model, 'price', ['options' => ['class' => 'mt-2']])  ?>
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

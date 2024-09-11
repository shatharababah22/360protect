<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PricingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pricing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id',['options' => ['class' => 'mt-2']])  ?> -->

    <?= $form->field($model, 'plan_id', ['options' => ['class' => 'mt-2']])->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\Plans::find()->all(),
            'id',
            'plan_code'
        ),
        
        ['class' => 'form-select','prompt' => 'Select passenger',]
    ) ?>
    <?= $form->field($model, 'passenger',['options' => ['class' => 'mt-2']])->dropDownList(
                                    [  '' => 'Select passenger',
                                        'adult' => 'Adult',
                                        'child' => 'Child',
                                        'Infant' => 'INF',
                                    ],
                                    [

                                        'class' => 'form-select',
                                    ]
                                ) ?>

    <?= $form->field($model, 'duration',['options' => ['class' => 'mt-2']])->dropDownList(
                                    [
                                        '' => 'Select',
                                        '7' => '7 days',
                                        '10' => '10 days',
                                        '15' => '15 days',
                                        '21' => '21 days',
                                        '30' => '1 month',
                                        '60' => '2 months',
                                        '90' => '3 months',
                                        '180' => '6 months',
                                        '365' => '1 year',
                                        '730' => '2 years',
                                        '1095' => '3 years',
                                    ],
                                    [
                              
                                        'class' => 'form-select',
                                 
                          
                                    ]

                                ) ?>
                                    <?= $form->field($model, 'price',['options' => ['class' => 'mt-2']])  ?>

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

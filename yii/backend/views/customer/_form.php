<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;




/** @var yii\web\View $this */
/** @var common\models\Customers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customers-form">


<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] 
]);
?>
<!-- 
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'credit')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

            

                            </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Policy $model */

$this->title = 'Create Policy';
$this->params['breadcrumbs'][] = ['label' => 'Policies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

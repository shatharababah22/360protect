<?php

use yii\helpers\Html;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\Pricing $model */

$this->title = 'Update Pricing: ' . $model->plan->name;
$this->params['breadcrumbs'][] = ['label' => 'Pricings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


   

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-sm mb-2 mb-sm-0">
        <h1><?= Html::encode($this->title) ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= Url::to(['index']) ?>">Pricing</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                </ol>
            </nav>




        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<!-- End Page Header -->

<div class="row">
    <div class="col-lg-11 mb-3 mb-lg-0">
        <!-- Card -->
        <div class="card mb-3 mb-lg-5">
            <!-- Header -->
            <div class="card-header">
                <h4 class="card-header-title">Pricing information</h4>
            </div>
            <!-- End Header -->
            <div class="card-body">

            
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


<?php

use yii\helpers\Html;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\Plans $model */

$this->title = 'Update Plans: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

   
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-sm mb-2 mb-sm-0">
        <h1><?= Html::encode($this->title) ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= Url::to(['index']) ?>">Plans</a></li>
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
                <h4 class="card-header-title">Plans information</h4>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>
            <!-- End Card Body -->
        </div>
        <!-- End Card -->
    </div>
    <!-- End Col -->
</div>
<!-- End Row -->
<?php

use yii\helpers\Html;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var common\models\Countries $model */

$this->title = 'Create Countries';
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


   
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title"><?= Html::encode($this->title) ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= Url::to(['index']) ?>">Companies</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-11 mb-3 mb-lg-0">
        <!-- Card -->
        <div class="card mb-3 mb-lg-5">
            <div class="card-header">
                <h4 class="card-header-title">Insurance information</h4>
            </div>
            <div class="card-body">



                <div class="country-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


</div>
</div>
</div>    </div>
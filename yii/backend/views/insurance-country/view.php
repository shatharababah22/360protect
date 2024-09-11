<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\InsuranceCountries $model */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="insurance-countries-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= Url::to(['index']) ?>">Companies</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                </ol>
            </nav>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
        
            [
                'attribute' => 'insurance_id',
                'value' => $model->insurance->name
            ],
            'country_code',
            'company_name',
           
            [
                'attribute' => 'company_logo',
                'format' => 'html', 
                'value' => function ($model) {
                    $imageUrl = $model->company_logo ? Yii::getAlias('@web') . '/images/' . $model->company_logo : "https://i.pinimg.com/564x/85/75/6f/85756f80922443841cb0072e1b1a7408.jpg";
                    return Html::img($imageUrl, [
                        'style' => 'max-width:120px; border-radius:60%;',
                    ]);
                },
            ],
            'source_country',
            'source_country_code',
        ],
    ]) ?>

</div>

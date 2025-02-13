<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\PlansCoverage $model */

$this->title = $model->item->title;
$this->params['breadcrumbs'][] = ['label' => 'Plans Coverages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>



    <div class="col-sm mb-2 mb-sm-0">
        <h1><?= Html::encode($this->title) ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= Url::to(['index']) ?>">Coverage</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                </ol>
            </nav>



        </div>
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
                'attribute' => 'item_id',
                'value' => $model->item->title,
            ],
            [
                'attribute' => 'plan_id',
                'value' => $model->plan->name,
            ],
            'YorN',
            [
            'attribute' => 'description',
            'format' => 'raw', 
            'value' => function ($model) {
                return html_entity_decode($model->description);
            },
        ],
        ],
    ]) ?>



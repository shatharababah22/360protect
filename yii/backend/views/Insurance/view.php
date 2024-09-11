<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Insurances $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Insurances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<h1><?= Html::encode($this->title) ?></h1>
<nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= Url::to(['index']) ?>">Insurances</a></li>
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
        'name',
        'overview:ntext',
        'description:ntext',
        'name_ar',
        'overview_ar:ntext',
        'description_ar:ntext',
        [
            'attribute' => 'photo',
            'format' => 'html',
            'value' => function ($model) {
                $imageUrl = $model->photo ? Yii::getAlias('@web') . '/images/' . $model->photo : "https://i.pinimg.com/564x/85/75/6f/85756f80922443841cb0072e1b1a7408.jpg";
                return Html::img($imageUrl, [
                    'style' => 'max-width:120px; border-radius:60%;',
                ]);
            },
        ],
        'price',
        [
            'attribute' => 'benefits_link',
           
                  'format' => 'raw',
            'value' => function ($model) {
                if (!empty($model->benefits_link)) {
                    // $fileName = basename($model->benefits_link); 
                    return Html::a('<i class="bi bi-journal-arrow-down "></i> Download', Yii::getAlias('@web') . '/images/' . $model->benefits_link, [
                        'class' => 'btn border border-secondary',
                        'target' => '_blank',
                        'download' => true, 
                    ]);
                } else {
                    return '<span class="not-set">(not set)</span>';
                }
            },
        ],
    ],
]) ?>

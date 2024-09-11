<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
/** @var yii\web\View $this */
/** @var common\models\Pricing $model */

$this->title = $model->plan->name;
$this->params['breadcrumbs'][] = ['label' => 'Pricings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>




    <h1><?= Html::encode($this->title) ?></h1>
    <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link" href="<?= Url::to(['index']) ?>">Pricing</a></li>
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
                'attribute' => 'plan_id',
                'value' => $model->plan->plan_code,
            ],
          
            'duration',
            'passenger',
            'price',
            'discount_price',
   
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 1 ? 'Active' : 'Inactive';
                },
            ],
        ],
    ]) ?>

</div>
            <!-- End Card Body -->
        </div>
    </div>
    <!-- End Card -->
</div>
<!-- End Col -->
</div>
<!-- End Row -->
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Policy $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Policies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="policy-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'customer_id',
            'from_airport',
            'DepartCountryCode',
            'departure_date',
            'going_to',
            'ArrivalCountryCode',
            'return_date',
            'ProposalState',
            'ItineraryID',
            'PNR',
            'PolicyNo',
            'PolicyPurchasedDateTime',
            'PolicyURLLink:ntext',
            'status',
            'status_description:ntext',
            'created_at',
            'updated_at',
            'source',
            'price',
        ],
    ]) ?>

</div>

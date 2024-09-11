<?php

use common\models\Insurances;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Insurancessearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Insurances';
$this->params['breadcrumbs'][] = $this->title;





$this->registerJs("
    $(document).on('click', '.read-more-overview', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#overview-' + id + ' .full-overview').slideDown(); // Slide down to show full overview
        $(this).hide(); // Hide 'Read more' link
        $('#overview-' + id + ' .read-less-overview').show(); // Show 'Read less' link
    });

    $(document).on('click', '.read-less-overview', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#overview-' + id + ' .full-overview').slideUp(); // Slide up to hide full overview
        $(this).hide(); // Hide 'Read less' link
        $('#overview-' + id + ' .read-more-overview').show(); // Show 'Read more' link
    });
");
?>






<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center mb-3">
    <div class="col-sm mb-2 mb-sm-0">
      <h1 class="page-header-title"><?= Html::encode($this->title) ?> <span class="badge bg-soft-dark text-dark ms-2"><?= Yii::$app->formatter->asInteger($dataProvider->totalCount) ?></span></h1>
 
    </div>

    <div class="col-sm-auto">
      <?= Html::a('New insurance', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
  </div>
</div>


<div class="row justify-content-end mb-3">

</div>


<!-- Card -->
<div class="card">


  <!-- Header -->
  <div class="card-header card-header-content-md-between">
    <div class="mb-2 mb-md-0">
    </div>

    <?php $form = ActiveForm::begin([
    'action' => Url::to(['/insurance/multiple']),
    'method' => 'post',
]); ?>
    <div class="d-grid d-sm-flex gap-2">
    <?= Html::submitButton('<i class="bi bi-trash"></i> Delete Selected', ['class' => 'btn btn-outline-danger', 'id' => 'deleteSelectedButton', 'disabled' => true]) ?>

      <button class="btn btn-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEcommerceProductFilter" aria-controls="offcanvasEcommerceProductFilter">
        <i class="bi-filter me-1"></i> Filters
      </button>
    </div>
  </div>
  <!-- End Header -->


  <!-- Table -->
  <div class="table-responsive datatable-custom">
    <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 4, 9],
                      "width": "5%",
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 12,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
      <thead class="thead-light">
        <tr>
          <th scope="col" class="table-column-pe-0">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
              <label class="form-check-label">
              </label>
            </div>
          </th>
          <th class="table-column-ps-0">Name</th>
          <th>Overview</th>
          <th>Description</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
              <?php if ($dataProvider->models) : ?>

        <?php foreach ($dataProvider->models as $model) : ?>
          <tr>
          <td class="table-column-pe-0">
                            <div class="form-check">
                                <input class="form-check-input record-checkbox" type="checkbox" name="selected_ids[]" value="<?= $model->id ?>">
                                <label class="form-check-label"></label>
                            </div>
                        </td>
            <td class="table-column-ps-0">
              <a class="d-flex align-items-center" href="<?= Url::to(['view', 'id' => $model->id]) ?>">
                <div class="flex-shrink-0">
                  <img class="avatar avatar-lg" src="<?= Yii::$app->request->baseUrl ?>/images/<?= $model->photo ?>" alt="Image Description">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h5 class="text-inherit mb-0"><?= Html::encode($model->name) ?></h5>
                </div>
              </a>
            </td>
            <!-- <td><?= Html::encode($model->overview) ?></td> -->


            <td id="overview-<?= $model->id ?>">
    <?php
    $fullOverview = Html::encode($model->overview);
    $words = explode(' ', $fullOverview);
    $chunkedWords = array_chunk($words, 4); 

    echo '<div class="overview-container" data-id="' . $model->id . '">';
    echo '<span class="short-overview">';
    foreach ($chunkedWords[0] as $word) {
        echo $word . ' ';
    }
    echo '</span><br>';

    if (count($chunkedWords) > 1) {
        echo '<span class="full-overview" style="display: none;">';
        for ($i = 1; $i < count($chunkedWords); $i++) {
            echo '<span class="chunk-' . $i . '">';
            foreach ($chunkedWords[$i] as $word) {
                echo $word . ' ';
            }
            echo '</span><br>';
        }
        echo '</span>';
        
   
        echo Html::a('Read more', '#', [
            'class' => 'read-more-overview',
            'data-id' => $model->id,
            'style' => 'display: inline;'
        ]);
        echo Html::a('Read less', '#', [
            'class' => 'read-less-overview',
            'data-id' => $model->id,
            'style' => 'display: none;'
        ]);
    }
    echo '</div>'; 
    ?>
</td>



            <td id="description-<?= $model->id ?>">
    <?php
    $fullDescription = Html::encode($model->description);
    $words = explode(' ', $fullDescription);
    $line1 = implode(' ', array_slice($words, 0, 4));
    $line2 = implode(' ', array_slice($words, 4, 4));
    
    echo '<span class="short-description">' . $line1 . '</span><br>';
    echo '<span class="short-description">' . $line2 . '</span>';
    
    if (count($words) > 8) {
        echo '<span class="full-description" style="display: none;">' . $fullDescription . '</span>';
        echo Html::a('Read more', '#', [
            'class' => 'read-more',
            'data-id' => $model->id,
            'style' => 'display: inline;'
        ]);
        echo Html::a('Read less', '#', [
            'class' => 'read-less',
            'data-id' => $model->id,
            'style' => 'display: none;'
        ]);
    }
    ?>
</td>

            <td><?= Html::encode($model->price) ?></td>
            <td>
              <a class="btn btn-white btn-sm" href="<?= Url::to(['update', 'id' => $model->id]) ?>">
                <i class="bi-pencil-fill " style="font-size: 15px;"></i>
              </a>
              <a class="btn btn-white btn-sm" href="<?= Url::to(['delete', 'id' => $model->id]) ?>" data-method="post" data-confirm="Are you sure you want to delete this item?">
                <i class="bi bi-trash " style="font-size: 15px; color:red"></i>
              </a>
              <a class="btn btn-white btn-sm" href="<?= Url::to(['view', 'id' => $model->id]) ?>">
                <i class="bi bi-eye-fill" style="font-size: 15px; color: #377DFF;"></i>
              </a>
            </td>
          </tr>
             <?php endforeach; ?>
             <?php else: ?>
            <tr class="odd"><td valign="top" colspan="8" class="dataTables_empty"><div class="text-center p-4">
              
            <img class="mb-3" src="<?= Url::to('@web/svg/illustrations/oc-error.svg') ?>" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
            <p class="mb-0">No data to show</p>
            </div></td></tr>
    <?php endif; ?>
      </tbody>
    </table>



  </div>
  <?php ActiveForm::end(); ?>
  <?php if ($dataProvider->pagination->pageCount > 1) : ?>
    <div class="card-footer">
      <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
        <div class="col-sm mb-2 mb-sm-0">
          <div class="d-flex justify-content-center justify-content-sm-start align-items-center ">
            <span class="me-2">Showing:</span>


            <div class="tom-select-custom">
              <span class="text-secondary me-2"> <?= count($dataProvider->getModels()) ?></span>
            </div>


            <span class="text-secondary me-2">of</span>

            <span id="datatableWithPaginationInfoTotalQty"><?= Yii::$app->formatter->asInteger($dataProvider->totalCount) ?></span>
          </div>
        </div>


        <div class="col-sm-auto">
          <div class="d-flex justify-content-center justify-content-sm-end">
          <?= LinkPager::widget([
        'pagination' => $dataProvider->pagination,
      
    ]) ?>
            
            
            
            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
  <?php endif; ?>
  <!-- End Footer -->

</div>
<!-- End Row -->
</div>
<!-- End Footer -->
</div>
<!-- End Card -->




<!--Filter Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceProductFilter" aria-labelledby="offcanvasEcommerceProductFilterLabel">
  <div class="offcanvas-header">
    <h4 id="offcanvasEcommerceProductFilterLabel" class="mb-0">Filters</h4>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <span class="text-cap small">filter by:</span>
    <div class="mb-2">
      <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
  </div>




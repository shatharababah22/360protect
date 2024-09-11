<?php

use common\models\PlansCoverage;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\LinkPager;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PlansCoverageSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Plans Coverages';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    $(document).on('click', '.read-more', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var fullText = $('#description-' + id + ' .full-description').text();
        var words = fullText.split(' ');
        var formattedText = '';
        for (var i = 0; i < words.length; i++) {
            formattedText += words[i] + ' ';
            if ((i + 1) % 10 == 0) {
                formattedText += '<br>';
            }
        }
        $('#description-' + id + ' .full-description').html(formattedText);
        $('#description-' + id + ' .short-description').hide();
        $('#description-' + id + ' .full-description').show();
        $(this).hide();
        $(this).siblings('.read-less').show();
    });

    $(document).on('click', '.read-less', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#description-' + id + ' .short-description').show();
        $('#description-' + id + ' .full-description').hide();
        $(this).hide();
        $(this).siblings('.read-more').show();
    });
");
?>










<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center mb-3">
    <div class="col-sm mb-2 mb-sm-0">
      <h1 class="page-header-title">Plans coverage<span class="badge bg-soft-dark text-dark ms-2"><?= Yii::$app->formatter->asInteger($dataProvider->totalCount) ?></span></h1>


    </div>
    <!-- End Col -->

    <div class="col-sm-auto">
      <!-- <a class="btn btn-primary" href="./ecommerce-add-product.html">Add product</a> -->
      <?= Html::a('New Plan coverage', Url::to(['create']), ['class' => 'btn btn-primary']) ?>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->


</div>
<!-- End Page Header -->

<div class="row justify-content-end mb-3">

</div>
<!-- End Row -->

<!-- Card -->


<!-- Card -->
<div class="card">
  <!-- Header -->
  <div class="card-header card-header-content-md-between">
    <div class="mb-2 mb-md-0">

    </div>
    <?php $form = ActiveForm::begin([
    'action' => Url::to(['/coverage/multiple']),
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
          <th class="table-column-ps-0">Title</th>
          <th>Coverage</th>
          <th>Plan Name</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php if ($dataProvider->models) : ?>

          <?php foreach ($dataProvider->models as $benefit) : ?>
            <tr>
            <td class="table-column-pe-0">
                            <div class="form-check">
                                <input class="form-check-input record-checkbox" type="checkbox" name="selected_ids[]" value="<?=$benefit->id ?>">
                                <label class="form-check-label"></label>
                            </div>
                        </td>
              <td class="table-column-ps-0">
                <a class="d-flex align-items-center" href="<?= Url::to(['view', 'id' => $benefit->id]) ?>">

                  <div class="flex-grow-1 ms-3">
                    <h5 class="text-inherit mb-0"><?= Html::encode($benefit->item->title) ?></h5>
                  </div>
                </a>
              </td>
              <td id="description-<?= $benefit->id ?>">
                <!-- <?php
                $fullDescription = Html::encode($benefit->description);
                if (strlen($fullDescription) > 100) {
                  $shortDescription = Html::encode(substr($fullDescription, 0, 80)) . '... ';
                  echo '<span class="short-description">' . $shortDescription . '</span>';
                  echo '<span class="full-description" style="display: none;">' . $fullDescription . '</span>';
                  echo Html::a('Read more', '#', [
                    'class' => 'read-more',
                    'data-id' => $benefit->id,
                    'style' => 'display: inline;'
                  ]);
                  echo Html::a('Read less', '#', [
                    'class' => 'read-less',
                    'data-id' => $benefit->id,
                    'style' => 'display: none;'
                  ]);
                } else {
                  echo '<span class="short-description">' . $fullDescription . '</span>';
                }
                ?> -->


<?= $benefit->description ?>
              </td>
              <td><?= Html::encode($benefit->plan->name) ?></td>
              <td><?= Html::encode($benefit->YorN) ?></td>


              <td>
                <!-- Actions -->
                <a class="btn btn-white btn-sm" href="<?= Url::to(['update', 'id' => $benefit->id]) ?>">
                  <i class="bi-pencil-fill" style="font-size: 15px;"></i>
                </a>
                <a class="btn btn-white btn-sm" href="<?= Url::to(['delete', 'id' => $benefit->id]) ?>" data-method="post" data-confirm="Are you sure you want to delete this item?">
                  <i class="bi bi-trash" style="font-size: 15px; color:red"></i>
                </a>
                <a class="btn btn-white btn-sm" href="<?= Url::to(['view', 'id' => $benefit->id]) ?>">
                  <i class="bi bi-eye-fill" style="font-size: 15px; color: #377DFF;"></i>
                </a>
                <!-- End Actions -->
              </td>
            </tr> <?php endforeach; ?>
        <?php else : ?>
          <tr class="odd">
            <td valign="top" colspan="8" class="dataTables_empty">
              <div class="text-center p-4">

                <img class="mb-3" src="<?= Url::to('@web/svg/illustrations/oc-error.svg') ?>" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
                <p class="mb-0">No data to show</p>
              </div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php ActiveForm::end(); ?>
  <!-- End Table -->
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
</div>
<!-- End Footer -->
</div>
<!-- End Card -->
</div>
<!-- End Content -->





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
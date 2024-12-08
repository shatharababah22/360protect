<?php

use common\models\Customers;
use yii\bootstrap4\Modal;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>




<div class="page-header">
  <div class="row align-items-center mb-3">
    <div class="col-sm mb-2 mb-sm-0">
      <h1 class="page-header-title"><?= Html::encode($this->title) ?> <span class="badge bg-soft-dark text-dark ms-2"><?= Yii::$app->formatter->asInteger($dataProvider->totalCount) ?></span></h1>
      <div class="mt-2">
        <a class="text-body me-3" href="<?= Url::to(['customer/export']) ?>">
          <i class="bi-download me-1"></i> Export
        </a>

        <!-- <a class="text-body" href="javascript:;" data-bs-toggle="modal" data-bs-target="#importProductsModal">
          <i class="bi-upload me-1"></i> Import
        </a> -->
      </div>

    </div>
    <!-- End Col -->
    <!-- 
    <div class="col-sm-auto">
      <?= Html::a('New Plan', Url::to(['create']), ['class' => 'btn btn-primary']) ?>
    </div> -->
    <!-- End Col -->
  </div>
  <!-- End Row -->

  <!-- Nav Scroller -->

  <!-- End Nav Scroller -->
</div>



<?php if (Yii::$app->session->hasFlash('error')) : ?>
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
    <?= Yii::$app->session->getFlash('error') ?>
  </div>
<?php endif; ?>











<div class="row justify-content-end mb-3">

</div>
<!-- End Row -->

<!-- Card -->
<div class="card">
  <!-- Header -->
  <div class="card-header card-header-content-md-between">
    <div class="mb-2 mb-md-0">
      <!-- Search Form -->

    </div>

    <div class="d-grid d-sm-flex gap-2">

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

          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Credit</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php if ($dataProvider->models) : ?>

          <?php foreach ($dataProvider->models as $customer) : ?>
            <tr>

              <td class="table-column-ps-0">


                <div class="flex-grow-1 ms-3">
                  <h5 class="text-inherit mb-0"><?= $customer?->name ? Html::encode($customer->name) : 'Not Available' ?></h5>
                </div>
                </a>
              </td>


              <td class="table-column-ps-0">


                <div class="flex-grow-1 ms-3">
                  <h5 class="text-inherit mb-0"><?= Html::encode($customer->email) ?></h5>
                </div>
                </a>
              </td>
              <td class="table-column-ps-0">


                <div class="flex-grow-1 ms-3">
                  <h5 class="text-inherit mb-0"><?= Html::encode($customer->mobile) ?></h5>
                </div>
                </a>
              </td>
              <td class="table-column-ps-0">
                <div class="flex-grow-1 ms-3">
                  <h5
                    class="text-inherit mb-0 <?= $customer->credit == 0 ? 'text-danger' : 'text-success' ?>">
                    <?= Html::encode($customer->credit) ?> JOD
                  </h5>
                </div>

                </a>
              </td>
              <td>



                <!-- Actions -->

                <a class="btn btn-white btn-sm" href="<?= Url::to(['update', 'id' => $customer->id]) ?>">
                  <i class="bi-pencil-fill me-2" style="font-size: 15px;"></i> Edit
                </a>
                <!-- End Actions -->
              </td>
            </tr>
          <?php endforeach; ?>
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

  <!-- End Table -->

  <!-- Footer -->
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

<!-- Footer -->

<div class="footer">
  <div class="row justify-content-between align-items-center">
    <!-- <div class="col">
          <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
        </div> -->
    <!-- End Col -->


  </div>
  <!-- End Row -->



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
  </div>
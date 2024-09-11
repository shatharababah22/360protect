<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\planssearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Plans';
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









<!-- Content -->

<!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center mb-3">
    <div class="col-sm mb-2 mb-sm-0">
      <h1 class="page-header-title"><?= Html::encode($this->title) ?> <span class="badge bg-soft-dark text-dark ms-2"><?= Yii::$app->formatter->asInteger($dataProvider->totalCount) ?></span></h1>
      <div class="mt-2">
        <a class="text-body me-3" href="<?= Url::to(['plans/export']) ?>">
          <i class="bi-download me-1"></i> Export
        </a>

        <a class="text-body" href="javascript:;" data-bs-toggle="modal" data-bs-target="#importProductsModal">
          <i class="bi-upload me-1"></i> Import
        </a>
      </div>

    </div>
    <!-- End Col -->

    <div class="col-sm-auto">
      <!-- <a class="btn btn-primary" href="./ecommerce-add-product.html">Add product</a> -->
      <?= Html::a('New Plan', Url::to(['create']), ['class' => 'btn btn-primary']) ?>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Row -->

  <!-- Nav Scroller -->

  <!-- End Nav Scroller -->
</div>
<!-- End Page Header -->

<div class="js-nav-scroller hs-nav-scroller-horizontal">




</div>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.75rem;"></button>
    <?= Yii::$app->session->getFlash('error') ?>
  </div>
<?php endif; ?>
<!-- Card -->
<div class="card">
  <!-- Header -->
  <div class="card-header card-header-content-md-between">
    <div class="mb-2 mb-md-0">


    </div>

    <?php $form = ActiveForm::begin([
    'action' => Url::to(['plans/multiple']),
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
    <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
      <thead class="thead-light">
        <tr>
        <th scope="col" class="table-column-pe-0">
                <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
              <label class="form-check-label">
              </label>
            </div>
                </th>
          <th class="table-column-ps-0">Plan name</th>



          <th>Plan code</th>
          <th>Insurance name</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php if ($dataProvider->models) : ?>

          <?php foreach ($dataProvider->models as $plan) : ?>
            <tr>
            <td class="table-column-pe-0">
                            <div class="form-check">
                                <input class="form-check-input record-checkbox" type="checkbox" name="selected_ids[]" value="<?= $plan->id ?>">
                                <label class="form-check-label"></label>
                            </div>
                        </td>
              <td class="table-column-ps-0">
                <a class="d-flex align-items-center" href="<?= Url::to(['view', 'id' => $plan->id]) ?>">

                  <div class="flex-grow-1 ms-3">
                    <h5 class="text-inherit mb-0"><?= Html::encode($plan->name) ?></h5>
                  </div>
                </a>
              </td>
              <!-- <td><?= Html::encode($plan->overview) ?></td> -->
              <!-- <td id="description-<?= $plan->id ?>">
            <?php
            $fullDescription = Html::encode($plan->description);
            if (strlen($fullDescription) > 100) {
              $shortDescription = Html::encode(substr($fullDescription, 0, 80)) . '... ';
              echo '<span class="short-description">' . $shortDescription . '</span>';
              echo '<span class="full-description" style="display: none;">' . $fullDescription . '</span>';
              echo Html::a('Read more', '#', [
                'class' => 'read-more',
                'data-id' => $plan->id,
                'style' => 'display: inline;'
              ]);
              echo Html::a('Read less', '#', [
                'class' => 'read-less',
                'data-id' => $plan->id,
                'style' => 'display: none;'
              ]);
            } else {
              echo '<span class="short-description">' . $fullDescription . '</span>';
            }
            ?>
        </td>
      -->
              <!-- Additional columns for Plans model fields -->

              <td><?= Html::encode($plan->plan_code) ?></td>
              <td><?= Html::encode($plan->insurance->name) ?></td>
              <td>
                <!-- Actions -->
                <a class="btn btn-white btn-sm" href="<?= Url::to(['update', 'id' => $plan->id]) ?>">
                  <i class="bi-pencil-fill" style="font-size: 15px;"></i>
                </a>
                <a class="btn btn-white btn-sm" href="<?= Url::to(['delete', 'id' => $plan->id]) ?>" data-method="post" data-confirm="Are you sure you want to delete this item?">
                  <i class="bi bi-trash" style="font-size: 15px; color:red"></i>
                </a>
                <a class="btn btn-white btn-sm" href="<?= Url::to(['view', 'id' => $plan->id]) ?>">
                  <i class="bi bi-eye-fill" style="font-size: 15px; color: #377DFF;"></i>
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
  <!-- End Footer -->
  <div class="col-sm-auto">
    <div class="d-flex justify-content-center justify-content-sm-end">
      <!-- Pagination -->
      <nav id="datatablePagination" aria-label="Activity pagination"></nav>
    </div>
  </div>
  <!-- End Col -->
</div>
<!-- End Row -->
</div>
<!-- End Footer -->
</div>
<!-- End Card -->
</div>
<!-- End Content -->

<!-- Footer -->






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




<!-- Import Products Modal -->
<div class="modal fade" id="importProductsModal" tabindex="-1" aria-labelledby="importProductsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="importProductsModalLabel">Import plan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- End Header -->

      <!-- Body -->
      <div class="modal-body">
        <p><a class="link" href="#">Download plan as Excel</a> to see an example of the format required.</p>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->errorSummary($model); ?>

        <!-- <?= $form->field($model, 'imageFile')->fileInput(); ?> -->

        <?= $form->field($model, 'imageFile')->fileInput(['class' => 'form-control', 'id' => 'basicFormFile',])->label(false) ?>


        <!-- Form Check -->
        <!-- <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="overwriteCurrentProductsCheckbox">
            <label class="form-check-label" for="overwriteCurrentProductsCheckbox">
              Overwrite any current products that have the same handle. Existing values will be used for any missing columns. <a href="#">Learn more</a>
            </label>
          </div> -->
        <!-- End Form Check -->
      </div>
      <!-- End Body -->

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        <button type="submit" class="btn btn-primary">Upload and continue</button>
      </div>
      <?php ActiveForm::end(); ?>
      <!-- End Footer -->
    </div>
  </div>
</div>

<!-- End Import Products Modal -->
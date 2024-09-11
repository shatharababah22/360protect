<?php

use common\models\Policy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var common\models\PolicySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Policies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policy-index">



  <!-- Page Header -->
  <div class="page-header">
    <div class="row align-items-center mb-3">
      <div class="col-sm mb-2 mb-sm-0">
        <h1 class="page-header-title">Policies <span class="badge bg-soft-dark text-dark ms-2"><?= Yii::$app->formatter->asInteger($dataProvider->totalCount) ?></span></h1>


   
      </div>
      <!-- End Col -->


    </div>
    <!-- End Row -->


  </div>
  <!-- End Page Header -->

  <div class="row justify-content-end mb-3">

  </div>



  <!-- Card -->
  <div class="card">
    <!-- Header -->
    <div class="card-header card-header-content-md-between">
      <div class="mb-2 mb-md-0">

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

      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col" class="table-column-pe-0">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                <label class="form-check-label"></label>
              </div>
            </th>

            <th><?= Yii::t('app', 'Customer Name') ?></th>
            <th><?= Yii::t('app', 'Customer Phone') ?></th>
            <th><?= Yii::t('app', 'From Airport') ?></th>
            <th><?= Yii::t('app', 'Going To') ?></th>
            <th><?= Yii::t('app', 'Departure Date') ?></th>
            <th><?= Yii::t('app', 'Return Date') ?></th>
   
            <th><?= Yii::t('app', 'Price') ?></th>
            <th><?= Yii::t('app', 'Status') ?></th>

          </tr>
        </thead>
        <tbody>
          <?php if ($dataProvider->models) : ?>
            <?php foreach ($dataProvider->models as $policy) : ?>
             
              <tr>
                <td class="table-column-pe-0">
                  <div class="form-check">
                  
                  </div>
                </td>

                <td><?= Html::encode(ucwords(strtolower($policy->customer->name))) ?></td>
                <td><?= $policy->customer->mobile ?></td>
                <!-- <td><?= Html::encode($policy->customer->mobile) ?></td> -->
                <td><img src="/assets/flags/<?= strtolower($policy->DepartCountryCode) ?>.png" class="rounded-circle" width="24" height="24" alt="<?= $policy->DepartCountryCode ?>" />
                <?= Html::encode($policy->from_airport) ?></td>
                <td><img src="/assets/flags/<?= strtolower($policy->ArrivalCountryCode) ?>.png" class="rounded-circle" width="24" height="24" alt="<?= $policy->ArrivalCountryCode ?>" />

                  
                
                <?= Html::encode($policy->going_to) ?></td>
                <td><?= Html::encode($policy->departure_date) ?></td>
                <td><?= Html::encode($policy->return_date) ?></td>
                <td><?= $policy->price ?> $</td>
                <td>
    <?php
    if ($policy->status == 0) {
        echo '<svg class="me-1" height="20px" width="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none" class="hds-flight-icon--animation-loading">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <g fill="#00112C" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2"></path>
                    <path d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"></path>
                </g>
            </g>
        </svg>' . Html::encode($policy->status_description);
    } elseif ($policy->status == 2) {
      echo '<svg height="18px" class="me-1" width="18px" viewBox="0 0 14 14"
       xmlns="http://www.w3.org/2000/svg" fill="#c81919">
       <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
       <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
        <g fill-rule="evenodd"> <path d="M0 7a7 7 0 1 1 14 0A7 7 0 0 1 0 7z">
        </path> <path d="M13 7A6 6 0 1 0 1 7a6 6 0 0 0 12 0z" fill="#FFF" style="fill: var(--svg-status-bg, #fff);"></path>
         <path d="M7 5.969L5.599 4.568a.29.29 0 0 0-.413.004l-.614.614a.294.294 0 0 0-.004.413L5.968 7l-1.4 1.401a.29.29 0 0 0 .004.413l.614.614c.113.114.3.117.413.004L7 8.032l1.401 1.4a.29.29 0 0 0 .413-.004l.614-.614a.294.294 0 0 0 .004-.413L8.032 7l1.4-1.401a.29.29 0 0 0-.004-.413l-.614-.614a.294.294 0 0 0-.413-.004L7 5.968z"></path>
          </g> </g></svg>' .'Failed';

    } else {
        echo '<svg class="me-1" height="20px" width="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#29B18A" stroke="#29B18A">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path fill="#29B18A" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"></path>
            </g>
        </svg>' . Html::encode($policy->status_description);
    }
    ?>
</td>

              <!-- <td>


              <?php
if ($policy->status == 0) {
    echo Html::a(
        ' <span >--</span>'
  
    );
} elseif ($policy->status == 2) {
    echo '<span >--</span>';
} else {

echo  Html::a(
  '<svg height="25px" width="25px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 303.188 303.188" xml:space="preserve" fill="#00112C"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <polygon style="fill:#E8E8E8;" points="219.821,0 32.842,0 32.842,303.188 270.346,303.188 270.346,50.525 "></polygon> <path style="fill:#FFC107;" d="M230.013,149.935c-3.643-6.493-16.231-8.533-22.006-9.451c-4.552-0.724-9.199-0.94-13.803-0.936 c-3.615-0.024-7.177,0.154-10.693,0.354c-1.296,0.087-2.579,0.199-3.861,0.31c-1.314-1.36-2.584-2.765-3.813-4.202 c-7.82-9.257-14.134-19.755-19.279-30.664c1.366-5.271,2.459-10.772,3.119-16.485c1.205-10.427,1.619-22.31-2.288-32.251 c-1.349-3.431-4.946-7.608-9.096-5.528c-4.771,2.392-6.113,9.169-6.502,13.973c-0.313,3.883-0.094,7.776,0.558,11.594 c0.664,3.844,1.733,7.494,2.897,11.139c1.086,3.342,2.283,6.658,3.588,9.943c-0.828,2.586-1.707,5.127-2.63,7.603 c-2.152,5.643-4.479,11.004-6.717,16.161c-1.18,2.557-2.335,5.06-3.465,7.507c-3.576,7.855-7.458,15.566-11.815,23.02 c-10.163,3.585-19.283,7.741-26.857,12.625c-4.063,2.625-7.652,5.476-10.641,8.603c-2.822,2.952-5.69,6.783-5.941,11.024 c-0.141,2.394,0.807,4.717,2.768,6.137c2.697,2.015,6.271,1.881,9.4,1.225c10.25-2.15,18.121-10.961,24.824-18.387 c4.617-5.115,9.872-11.61,15.369-19.465c0.012-0.018,0.024-0.036,0.037-0.054c9.428-2.923,19.689-5.391,30.579-7.205 c4.975-0.825,10.082-1.5,15.291-1.974c3.663,3.431,7.621,6.555,11.939,9.164c3.363,2.069,6.94,3.816,10.684,5.119 c3.786,1.237,7.595,2.247,11.528,2.886c1.986,0.284,4.017,0.413,6.092,0.335c4.631-0.175,11.278-1.951,11.714-7.57 C231.127,152.765,230.756,151.257,230.013,149.935z M119.144,160.245c-2.169,3.36-4.261,6.382-6.232,9.041 c-4.827,6.568-10.34,14.369-18.322,17.286c-1.516,0.554-3.512,1.126-5.616,1.002c-1.874-0.11-3.722-0.937-3.637-3.065 c0.042-1.114,0.587-2.535,1.423-3.931c0.915-1.531,2.048-2.935,3.275-4.226c2.629-2.762,5.953-5.439,9.777-7.918 c5.865-3.805,12.867-7.23,20.672-10.286C120.035,158.858,119.587,159.564,119.144,160.245z M146.366,75.985 c-0.602-3.514-0.693-7.077-0.323-10.503c0.184-1.713,0.533-3.385,1.038-4.952c0.428-1.33,1.352-4.576,2.826-4.993 c2.43-0.688,3.177,4.529,3.452,6.005c1.566,8.396,0.186,17.733-1.693,25.969c-0.299,1.31-0.632,2.599-0.973,3.883 c-0.582-1.601-1.137-3.207-1.648-4.821C147.945,83.048,146.939,79.482,146.366,75.985z M163.049,142.265 c-9.13,1.48-17.815,3.419-25.979,5.708c0.983-0.275,5.475-8.788,6.477-10.555c4.721-8.315,8.583-17.042,11.358-26.197 c4.9,9.691,10.847,18.962,18.153,27.214c0.673,0.749,1.357,1.489,2.053,2.22C171.017,141.096,166.988,141.633,163.049,142.265z M224.793,153.959c-0.334,1.805-4.189,2.837-5.988,3.121c-5.316,0.836-10.94,0.167-16.028-1.542 c-3.491-1.172-6.858-2.768-10.057-4.688c-3.18-1.921-6.155-4.181-8.936-6.673c3.429-0.206,6.9-0.341,10.388-0.275 c3.488,0.035,7.003,0.211,10.475,0.664c6.511,0.726,13.807,2.961,18.932,7.186C224.588,152.585,224.91,153.321,224.793,153.959z"></path> <polygon style="fill:#FFC107;" points="227.64,25.263 32.842,25.263 32.842,0 219.821,0 "></polygon> <g> <path style="fill:#A4A9AD;" d="M126.841,241.152c0,5.361-1.58,9.501-4.742,12.421c-3.162,2.921-7.652,4.381-13.472,4.381h-3.643 v15.917H92.022v-47.979h16.606c6.06,0,10.611,1.324,13.652,3.971C125.321,232.51,126.841,236.273,126.841,241.152z M104.985,247.387h2.363c1.947,0,3.495-0.546,4.644-1.641c1.149-1.094,1.723-2.604,1.723-4.529c0-3.238-1.794-4.857-5.382-4.857 h-3.348C104.985,236.36,104.985,247.387,104.985,247.387z"></path> <path style="fill:#A4A9AD;" d="M175.215,248.864c0,8.007-2.205,14.177-6.613,18.509s-10.606,6.498-18.591,6.498h-15.523v-47.979 h16.606c7.701,0,13.646,1.969,17.836,5.907C173.119,235.737,175.215,241.426,175.215,248.864z M161.76,249.324 c0-4.398-0.87-7.657-2.609-9.78c-1.739-2.122-4.381-3.183-7.926-3.183h-3.773v26.877h2.888c3.939,0,6.826-1.143,8.664-3.43 C160.841,257.523,161.76,254.028,161.76,249.324z"></path> <path style="fill:#A4A9AD;" d="M196.579,273.871h-12.766v-47.979h28.355v10.403h-15.589v9.156h14.374v10.403h-14.374 L196.579,273.871L196.579,273.871z"></path> </g> <polygon style="fill:#D1D3D3;" points="219.821,50.525 270.346,50.525 219.821,0 "></polygon> </g> </g></svg>
Download',
  $policy->PolicyURLLink,
  [
   
      'download' => true,
      'data-pjax' => '0',
  ]
); 

}
  ?>
            </td> -->

    <!-- <i class="bi bi-file-pdf-fill me-2"></i> -->


              </tr>
            <?php endforeach; ?>
      
          <?php else : ?>
            <tr class="odd">
              <td valign="top" colspan="17" class="dataTables_empty">
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

    <div class="card-footer">
      <?php if ($dataProvider->pagination->pageCount > 1) : ?>
        <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
          <div class="col-sm mb-2 mb-sm-0">
            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
              <span class="me-2">Showing:</span>
              <div class="tom-select-custom">
                <span class="text-secondary me-2"><?= count($dataProvider->getModels()) ?></span>
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
        </div>

      <?php endif; ?>
    </div>



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
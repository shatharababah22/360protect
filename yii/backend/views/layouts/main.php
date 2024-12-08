<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>

  <link rel="shortcut icon" href="<?= Url::to('@web/logo-dark.png') ?>">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <!-- Add SweetAlert2 CSS from CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  <script>
    window.hs_config = {
      "autopath": "@@autopath",
      "deleteLine": "hs-builder:delete",
      "deleteLine:build": "hs-builder:build-delete",
      "deleteLine:dist": "hs-builder:dist-delete",
      "previewMode": false,
      "startPath": "/index.html",
      "vars": {
        "themeFont": "https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap",
        "version": "?v=1.0"
      },
      "layoutBuilder": {
        "extend": {
          "switcherSupport": true
        },
        "header": {
          "layoutMode": "default",
          "containerMode": "container-fluid"
        },
        "sidebarLayout": "default"
      },
      "themeAppearance": {
        "layoutSkin": "default",
        "sidebarSkin": "default",
        "styles": {
          "colors": {
            "primary": "#377dff",
            "transparent": "transparent",
            "white": "#fff",
            "dark": "132144",
            "gray": {
              "100": "#f9fafc",
              "900": "#1e2022"
            }
          },
          "font": "Inter"
        }
      },
      "languageDirection": {
        "lang": "en"
      },
      "skipFilesFromBundle": {
        "dist": [
          "assets/js/hs.theme-appearance.js",
          "assets/js/hs.theme-appearance-charts.js",
          "assets/js/demo.js"
        ],
        "build": [
          "assets/css/theme.css",
          "assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js",
          "assets/js/demo.js",
          "assets/css/theme-dark.css",
          "assets/css/docs.css",
          "assets/vendor/icon-set/style.css",
          "assets/js/hs.theme-appearance.js",
          "assets/js/hs.theme-appearance-charts.js",
          "node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js",
          "assets/js/demo.js"
        ]
      },
      "minifyCSSFiles": [
        "assets/css/theme.css",
        "assets/css/theme-dark.css"
      ],
      "copyDependencies": {
        "dist": {
          "*assets/js/theme-custom.js": ""
        },
        "build": {
          "*assets/js/theme-custom.js": "",
          "node_modules/bootstrap-icons/font/*fonts/**": "assets/css"
        }
      },
      "buildFolder": "",
      "replacePathsToCDN": {},
      "directoryNames": {
        "src": "./src",
        "dist": "./dist",
        "build": "./build"
      },
      "fileNames": {
        "dist": {
          "js": "theme.min.js",
          "css": "theme.min.css"
        },
        "build": {
          "css": "theme.min.css",
          "js": "theme.min.js",
          "vendorCSS": "vendor.min.css",
          "vendorJS": "vendor.min.js"
        }
      },
      "fileTypes": "jpg|png|svg|mp4|webm|ogv|json"
    };
    window.hs_config.gulpRGBA = (p1) => {
      const options = p1.split(',');
      const hex = options[0].toString();
      const transparent = options[1].toString();
      var c;
      if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
        c = hex.substring(1).split('');
        if (c.length == 3) {
          c = [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c = '0x' + c.join('');
        return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',' + transparent + ')';
      }
      throw new Error('Bad Hex');
    };
    window.hs_config.gulpDarken = (p1) => {
      const options = p1.split(',');
      let col = options[0].toString();
      let amt = -parseInt(options[1]);
      var usePound = false;
      if (col[0] == "#") {
        col = col.slice(1);
        usePound = true;
      }
      var num = parseInt(col, 16);
      var r = (num >> 16) + amt;
      if (r > 255) {
        r = 255;
      } else if (r < 0) {
        r = 0;
      }
      var b = ((num >> 8) & 0x00FF) + amt;
      if (b > 255) {
        b = 255;
      } else if (b < 0) {
        b = 0;
      }
      var g = (num & 0x0000FF) + amt;
      if (g > 255) {
        g = 255;
      } else if (g < 0) {
        g = 0;
      }
      return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16);
    };
    window.hs_config.gulpLighten = (p1) => {
      const options = p1.split(',');
      let col = options[0].toString();
      let amt = parseInt(options[1]);
      var usePound = false;
      if (col[0] == "#") {
        col = col.slice(1);
        usePound = true;
      }
      var num = parseInt(col, 16);
      var r = (num >> 16) + amt;
      if (r > 255) {
        r = 255;
      } else if (r < 0) {
        r = 0;
      }
      var b = ((num >> 8) & 0x00FF) + amt;
      if (b > 255) {
        b = 255;
      } else if (b < 0) {
        b = 0;
      }
      var g = (num & 0x0000FF) + amt;
      if (g > 255) {
        g = 255;
      } else if (g < 0) {
        g = 0;
      }
      return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16);
    };
  </script>


  <?php $this->head() ?>
</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">
  <?php $this->beginBody() ?>

  <header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
      <!-- Logo -->
      <a class="navbar-brand" href="<?= Url::to(['/site/index']) ?>" aria-label="Front">
        <img class="navbar-brand-logo" src="<?= Url::to('@web/svg/logos/logo-dark.png') ?>" alt="Logo" data-hs-theme-appearance="default">
        <!-- <span style="background: linear-gradient(to right, blue, yellow); -webkit-background-clip: text; color: transparent;">360</span> -->

        <img class="navbar-brand-logo" src="<?= Url::to('@web/svg/logos/logo-dark.png') ?>" alt="Logo" data-hs-theme-appearance="dark">
        <img class="navbar-brand-logo-mini" src="<?= Url::to('@web/svg/logos/logo-dark.png') ?>" alt="Logo" data-hs-theme-appearance="default">
        <img class="navbar-brand-logo-mini" src="<?= Url::to('@web/svg/logos/logo-dark.png') ?>" alt="Logo" data-hs-theme-appearance="dark">
      </a>



      <div class="navbar-nav-wrap-content-start">
        <!-- Navbar Vertical Toggle -->
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
        </button>

        <!-- End Navbar Vertical Toggle -->

        <!-- Search Form -->
        <div class="dropdown ms-2">
          <!-- Input Group -->
          <div class="d-none d-lg-block">
            <div class="input-group input-group-merge input-group-borderless input-group-hover-light navbar-input-group">
              <div class="input-group-prepend input-group-text">
                <i class="bi-search"></i>
              </div>

              <!-- <input type="search" class="js-form-search form-control" placeholder="Search in front" aria-label="Search in front" data-hs-form-search-options='{
                       "clearIcon": "#clearSearchResultsIcon",
                       "dropMenuElement": "#searchDropdownMenu",
                       "dropMenuOffset": 20,
                       "toggleIconOnFocus": true,
                       "activeClass": "focus"
                     }'> -->
              <a class="input-group-append input-group-text" href="javaScript:;">
                <i id="clearSearchResultsIcon" class="bi-x-lg" style="display: none;"></i>
              </a>
            </div>
          </div>



        </div>

        <!-- End Search Form -->
      </div>

      <div class="navbar-nav-wrap-content-end">
        <!-- Navbar -->
        <ul class="navbar-nav">




          <li class="nav-item">
            <!-- Account -->

            <?php if (!Yii::$app->user->isGuest) : ?>
              <span class="me-2 text-dark">
                Hey, <?= Yii::$app->user->identity->username ?>
              </span>



            <?php endif; ?>

            <!-- End Account -->
          </li>




        </ul>

      </div>


      </ul>
      <!-- End Navbar -->
    </div>
    </div>
  </header>



  <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white">
    <div class="navbar-vertical-container">
      <div class="navbar-vertical-footer-offset">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center justify-content-center" href="<?= Url::to(['/site/index']) ?>" aria-label="Front">
    <img class="navbar-brand-logo mt-4 ml-4" src="<?= Url::to('@web/svg/logos/logo-dark.png') ?>" alt="Logo" data-hs-theme-appearance="default">
          <!-- <span class="logo-span mt-4 ml-2 d-block">Insurances</span> -->
          <img class="navbar-brand-logo-mini" src="<?= Url::to('@web/svg/logos/logo-dark.png') ?>" alt="Logo" data-hs-theme-appearance="default">

        </a>
        <!-- End Logo -->


        <!-- Navbar Vertical Toggle -->
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
        </button>

        <!-- End Navbar Vertical Toggle -->

        <!-- Content -->
        <div class="navbar-vertical-content">
          <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
            <!-- Collapse -->
            <div class="nav-item">
              <a class="nav-link " href="<?= Url::to(['/site/index']) ?>" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuDashboards" aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
                <i class="bi-house-door nav-icon"></i>
                <span class="nav-link-title">Dashboard</span>
              </a>


            </div>
            <!-- End Collapse -->

            <span class="dropdown-header mt-4">Pages</span>
            <small class="bi-three-dots nav-subtitle-replacer"></small>

            <!-- Collapse -->
            <div class="navbar-nav nav-compact">

            </div>
            <div id="navbarVerticalMenuPagesMenu">


            <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/customer/index']) ?>">
                  <i class="bi bi-person nav-icon"></i>
                  <span class="nav-link-title">Customers</span>
                </a>
              </div>
              <!-- Collapse -->
              <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/insurance/index']) ?>">
                  <i class="bi bi-umbrella nav-icon"></i>
                  <span class="nav-link-title">Insurance</span>
                </a>
              </div>
              <!-- End Collapse -->

               <!-- Collapse -->
               <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/plans/index']) ?>">
                <i class="bi-stickies nav-icon"></i>
                <span class="nav-link-title">Plans</span>
                </a>
              </div>
              <!-- End Collapse -->


                <!-- Collapse -->
                <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/country/index']) ?>">
                <i class="bi bi-globe nav-icon"></i>
                  <span class="nav-link-title">Countries</span>
                </a>
              </div>
              <!-- End Collapse -->


          
                <!-- Collapse -->
                <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/insurance-country/index']) ?>">
                <i class="bi bi-building nav-icon"></i>
                <span class="nav-link-title">Companies</span>
                </a>
              </div>
              <!-- End Collapse -->

    <!-- Collapse -->
    <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/airport/index']) ?>">
                <i class="bi bi-airplane-engines nav-icon"></i>

                  <span class="nav-link-title">Airport</span>
                </a>
              </div>
              <!-- End Collapse -->
   
  <!-- Collapse -->
  <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/pricing/index']) ?>">
                <i class="bi bi-coin  nav-icon"></i>
                <span class="nav-link-title">Pricing</span>
                </a>
              </div>
              <!-- End Collapse -->

           
              <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/benefit/index']) ?>">
                <i class="bi bi-info-circle nav-icon"></i>
                <span class="nav-link-title"> Main benefits</span>
                </a>
              </div>


              <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/coverage/index']) ?>">
                <i class="bi bi-shield-exclamation nav-icon"></i>
                <span class="nav-link-title">Coverage</span>
                </a>
              </div>

              
              <!-- <div class="nav-item">
                      <a class="nav-link dropdown-toggle " href="<?= Url::to(['/benefit/index']) ?>" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthenticationLoginMenu" aria-expanded="false" aria-controls="navbarVerticalMenuAuthenticationLoginMenu">
                      <i class="bi bi-info-circle nav-icon"></i>

                        Main benefit
                      </a>

                      <div id="navbarVerticalMenuAuthenticationLoginMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuAuthenticationMenu">
                        <a class="nav-link " href="<?= Url::to(['/benefit/index']) ?>">  Main benefit</a>
                        <a class="nav-link " href="<?= Url::to(['/coverage/index']) ?>">Coverage</a>
                      </div>
                    </div> -->

              <!-- Collapse -->
              <!-- <div class="nav-item">
                <a class="nav-link dropdown-toggle  collapsed" href="<?= Url::to(['/benefit/index']) ?>" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthentication" aria-expanded="false" aria-controls="navbarVerticalMenuAuthentication">
                  <i class="bi bi-info-circle nav-icon"></i>
                  <span class="nav-link-title">Benefit</span>
                </a>

                <div id="navbarVerticalMenuAuthentication" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenu">
                  <div id="navbarVerticalMenuAuthenticationMenu">
                
                    <div class="nav-item">
                      <a class="nav-link dropdown-toggle " href="<?= Url::to(['/benefit/index']) ?>" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthenticationLoginMenu" aria-expanded="false" aria-controls="navbarVerticalMenuAuthenticationLoginMenu">
                        Main benefit
                      </a>

                      <div id="navbarVerticalMenuAuthenticationLoginMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuAuthenticationMenu">
                        <a class="nav-link " href="<?= Url::to(['/benefit/index']) ?>">  Main benefit</a>
                        <a class="nav-link " href="<?= Url::to(['/coverage/index']) ?>">Coverage</a>
                      </div>
                    </div>




                  </div>
                </div>
              </div> -->
              <!-- End Collapse -->

              <!-- Collapse -->
              <div class="nav-item">
                <a class="nav-link " href="<?= Url::to(['/policy/index']) ?>">
                  <i class="bi bi-card-checklist nav-icon"></i>
                  <span class="nav-link-title">Policies</span>
                </a>
              </div>
              <!-- End Collapse -->


              <div class="nav-item">



                <a class="nav-link  " href="javascript:;" onclick="document.getElementById('logoutForm').submit();" title="Logout">
                  <i class="bi bi-box-arrow-right nav-icon"></i>
                  <span class="nav-link-title">Logout</span>
                </a>

              </div>

              <form id="logoutForm" action="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>" method="post" style="display: none;">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
              </form>





              <!-- End Content -->

            </div>
          </div>
  </aside>
  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid mt-4">

      <?= $content ?>
    </div>
  </main>


  <!-- 
<Script src="../../web/vendor/jquery/dist/jquery.min.js"></Script>
  <Script src="../../web/vendor/jquery-migrate/dist/jquery-migrate.min.js"></Script>
  <Script src="../../web/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></Script>

  <Script src="../../web/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js"></Script>
  <Script src="../../web/vendor/hs-form-search/dist/hs-form-search.min.js"></Script> -->




  <script>
 document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('datatableCheckAll');
    const checkboxes = document.querySelectorAll('.record-checkbox');
    const deleteButton = document.getElementById('deleteSelectedButton');

    checkAll.addEventListener('change', function() {
        checkboxes.forEach(checkbox => checkbox.checked = checkAll.checked);
        toggleDeleteButton();
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            checkAll.checked = checkboxes.length === document.querySelectorAll('.record-checkbox:checked').length;
            toggleDeleteButton();
        });
    });

    function toggleDeleteButton() {
        deleteButton.disabled = document.querySelectorAll('.record-checkbox:checked').length === 0;
    }

    
});

</script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@latest"></script>

  <Script>
    (function() {
      localStorage.removeItem('hs_theme')

      window.onload = function() {


        // INITIALIZATION OF NAVBAR VERTICAL ASIDE
        // =======================================================
        new HSSideNav('.js-navbar-vertical-aside').init()

        new HSQuantityCounter('.js-quantity-counter')
        // INITIALIZATION OF FORM SEARCH
        // =======================================================
        const HSFormSearchInstance = new HSFormSearch('.js-form-search')

        if (HSFormSearchInstance.collection.length) {
          HSFormSearchInstance.getItem(1).on('close', function(el) {
            el.classList.remove('top-0')
          })

          document.querySelector('.js-form-search-mobile-toggle').addEventListener('click', e => {
            let dataOptions = JSON.parse(e.currentTarget.getAttribute('data-hs-form-search-options')),
              $menu = document.querySelector(dataOptions.dropMenuElement)

            $menu.classList.add('top-0')
            $menu.style.left = 0
          })
        }

        HSCore.components.HSDatatables.init('.js-datatable-checkboxes', {
      select: {
        style: 'multi',
        selector: 'td:first-child input[type="checkbox"]',
        classMap: {
          checkAll: '#datatableWithCheckboxSelectAll',
          counter: '#datatableWithCheckboxSelectCounter',
          counterInfo: '#datatableWithCheckboxSelectCounterInfo'
        }
      }
    })
        // INITIALIZATION OF BOOTSTRAP DROPDOWN
        // =======================================================
        HSBsDropdown.init()


        // INITIALIZATION OF CHARTJS
        // =======================================================
        HSCore.components.HSChartJS.init('.js-chart')

        HSCore.components.HSDropzone.init('.js-dropzone')

        HSCore.components.HSQuill.init('.js-quill')
        HSCore.components.HSDaterangepicker.init('.js-daterangepicker')

        // INITIALIZATION OF CHARTJS
        // =======================================================
        HSCore.components.HSChartJS.init('#updatingBarChart')
        const updatingBarChart = HSCore.components.HSChartJS.getItem('updatingBarChart')

        // Call when tab is clicked
        document.querySelectorAll('[data-bs-toggle="chart-bar"]').forEach(item => {
          item.addEventListener('click', e => {
            let keyDataset = e.currentTarget.getAttribute('data-datasets')

            const styles = HSCore.components.HSChartJS.getTheme('updatingBarChart', HSThemeAppearance.getAppearance())

            if (keyDataset === 'lastWeek') {
              updatingBarChart.data.labels = ["Apr 22", "Apr 23", "Apr 24", "Apr 25", "Apr 26", "Apr 27", "Apr 28", "Apr 29", "Apr 30", "Apr 31"];
              updatingBarChart.data.datasets = [{
                  "data": [120, 250, 300, 200, 300, 290, 350, 100, 125, 320],
                  "backgroundColor": styles.data.datasets[0].backgroundColor,
                  "hoverBackgroundColor": styles.data.datasets[0].hoverBackgroundColor,
                  "borderColor": styles.data.datasets[0].borderColor,
                  "maxBarThickness": 10
                },
                {
                  "data": [250, 130, 322, 144, 129, 300, 260, 120, 260, 245, 110],
                  "backgroundColor": styles.data.datasets[1].backgroundColor,
                  "borderColor": styles.data.datasets[1].borderColor,
                  "maxBarThickness": 10
                }
              ];
              updatingBarChart.update();
            } else {
              updatingBarChart.data.labels = ["May 1", "May 2", "May 3", "May 4", "May 5", "May 6", "May 7", "May 8", "May 9", "May 10"];
              updatingBarChart.data.datasets = [{
                  "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
                  "backgroundColor": styles.data.datasets[0].backgroundColor,
                  "hoverBackgroundColor": styles.data.datasets[0].hoverBackgroundColor,
                  "borderColor": styles.data.datasets[0].borderColor,
                  "maxBarThickness": 10
                },
                {
                  "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225, 120],
                  "backgroundColor": styles.data.datasets[1].backgroundColor,
                  "borderColor": styles.data.datasets[1].borderColor,
                  "maxBarThickness": 10
                }
              ]
              updatingBarChart.update();
            }
          })
        })


        // INITIALIZATION OF CHARTJS
        // =======================================================
        HSCore.components.HSChartJS.init('.js-chart-datalabels', {
          plugins: [ChartDataLabels],
          options: {
            plugins: {
              datalabels: {
                anchor: function(context) {
                  var value = context.dataset.data[context.dataIndex];
                  return value.r < 20 ? 'end' : 'center';
                },
                align: function(context) {
                  var value = context.dataset.data[context.dataIndex];
                  return value.r < 20 ? 'end' : 'center';
                },
                color: function(context) {
                  var value = context.dataset.data[context.dataIndex];
                  return value.r < 20 ? context.dataset.backgroundColor : context.dataset.color;
                },
                font: function(context) {
                  var value = context.dataset.data[context.dataIndex],
                    fontSize = 25;

                  if (value.r > 50) {
                    fontSize = 35;
                  }

                  if (value.r > 70) {
                    fontSize = 55;
                  }

                  return {
                    weight: 'lighter',
                    size: fontSize
                  };
                },
                formatter: function(value) {
                  return value.r
                },
                offset: 2,
                padding: 0
              }
            },
          }
        })

        // INITIALIZATION OF SELECT
        // =======================================================
        HSCore.components.HSTomSelect.init('.js-select')


        // INITIALIZATION OF CLIPBOARD
        // =======================================================
        HSCore.components.HSClipboard.init('.js-clipboard')


        new HSFileAttach('.js-file-attach')

      }


    })()
  </Script>



  <!-- Add SweetAlert2 JS from CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
  <script>
    // Initialize Dropzone.js or your custom drop functionality
    Dropzone.autoDiscover = false; // Disable auto discovery of dropzone elements

    // Initialize Dropzone on your designated area
    var dropzone = new Dropzone("#attachFilesNewProjectLabel", {
      url: "/your-upload-url", // Specify the URL where the files will be uploaded
      autoProcessQueue: false, // Disable automatic file upload
      clickable: false // Disable the default clickable area to prevent duplicate behavior
    });

    // Listen for files added to Dropzone
    dropzone.on("addedfile", function(file) {
      // When a file is added, trigger the file input selection programmatically
      var input = document.getElementById('photoInput');
      var fileReader = new FileReader();

      fileReader.onload = function(e) {
        // Set the file to the file input field
        input.files = [file];
      };

      fileReader.readAsDataURL(file);
    });

    // Handle form submission (if necessary)
    dropzone.on("sending", function(file, xhr, formData) {
      // Add any additional form data or headers if needed
      // Example:
      // formData.append('csrf-token', 'your-csrf-token');
    });

    // Optionally, handle upload success or error events
    dropzone.on("success", function(file, response) {
      console.log("File uploaded successfully", response);
      // Handle success response if needed
    });

    dropzone.on("error", function(file, errorMessage) {
      console.error("Error uploading file", errorMessage);
      // Handle error response if needed
    });

    // You may also need to handle form submission programmatically
    // Example:
    /*
    document.getElementById('your-form-id').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Process any additional data or validations here
        dropzone.processQueue(); // Trigger file upload
    });
    */
  </script>


  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();

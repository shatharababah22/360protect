<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';


?>



  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main pt-0">
    <!-- Content -->
    <div class="container-fluid px-3">
      <div class="row">
<div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-light px-0"
 style="background-image:url(https://i.pinimg.com/564x/30/6f/84/306f8442db2af8a70c99a54d72c5215d.jpg); background-size:cover; background-repeat:no-repeat;">

      <!-- Logo & Language -->
      <!-- <div class="position-absolute top-0 end-0 mt-3 mx-3">
            <div class="d-none d-lg-flex justify-content-between"> -->
              <!-- <a href="./index.html">
                <img class="w-100" src="<?= Url::to('@web/img/160x160/img3.jpg') ?>" alt="Image Description" data-hs-theme-appearance="default" style="min-width: 7rem; max-width: 7rem;">
                <img class="w-100" src="./assets/svg/logos-light/logo.svg" alt="Image Description" data-hs-theme-appearance="dark" style="min-width: 7rem; max-width: 7rem;">
              </a> -->

              <!-- Select -->
          <!-- <div class="tom-select-custom tom-select-custom-end tom-select-custom-bg-transparent zi-2 ">
                <select class="js-select form-select form-select-sm form-select-borderless" data-hs-tom-select-options='{
                          "searchInDropdown": false,
                          "hideSearch": true,
                          "dropdownWidth": "12rem",
                          "placeholder": "Select language"
                        }'>
                  <option label="empty"></option>
                  <option value="language1" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Image description" width="16"/><span>English (US)</span></span>'>English (US)</option>
                  <option value="language2" selected data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Image description" width="16"/><span>English (UK)</span></span>'>English (UK)</option>
                  <option value="language3" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Image description" width="16"/><span>Deutsch</span></span>'>Deutsch</option>
                  <option value="language4" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Image description" width="16"/><span>Dansk</span></span>'>Dansk</option>
                  <option value="language5" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/es.svg" alt="Image description" width="16"/><span>Español</span></span>'>Español</option>
                  <option value="language6" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/nl.svg" alt="Image description" width="16"/><span>Nederlands</span></span>'>Nederlands</option>
                  <option value="language7" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Image description" width="16"/><span>Italiano</span></span>'>Italiano</option>
                  <option value="language8" data-option-template='<span class="d-flex align-items-center"><img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Image description" width="16"/><span>中文 (繁體)</span></span>'>中文 (繁體)</option>
                </select>
              </div> -->
              <!-- End Select -->
            <!-- </div>
          </div> -->
          <!-- End Logo & Language -->

       
        </div>
        <!-- End Col -->

        <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
          <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
            <!-- Form -->


            
     
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => [
        'class' => 'js-validate needs-validation',
        'novalidate' => 'novalidate',
    ],
]); ?>

<div class="text-center">
    <div class="mb-7">
        <h1 class="display-5 ">Sign in</h1>
        <!-- <p>Don't have an account yet? <a class="link" href="./authentication-signup-cover.html">Sign up here</a></p> -->
    </div>

    <!-- <div class="d-grid mb-4">
        <a class="btn btn-white btn-lg" href="#">
            <span class="d-flex justify-content-center align-items-center">
                <img class="avatar avatar-xss me-2" src="<?= Url::to('@web/svg/brands/google-icon.svg') ?>" alt="Image Description">
                Sign in with Google
            </span>
        </a>
    </div> -->

    <!-- <span class="divider-center text-muted mb-4">OR</span> -->
</div>

<!-- Form -->
<div class="mb-4">
    <?= $form->field($model, 'username', [
        'options' => ['class' => ''],
        'inputOptions' => [
            'class' => 'form-control form-control-lg',
            'id' => 'signinSrEmail',
            'tabindex' => '1',
            'placeholder' => 'email@address.com',
            'aria-label' => 'email@address.com',
            'required' => true,
        ],
    ])->input('username')->label('Your username', ['class' => 'form-label']) ?>
    <span class="invalid-feedback">Please enter a valid username address.</span>
</div>
<!-- End Form -->

<!-- Form -->
<div class="mb-4">
    <?= $form->field($model, 'password', [
        'options' => ['class' => ''],
        'inputOptions' => [
            'class' => 'js-toggle-password form-control form-control-lg',
            'id' => 'signupSrPassword',
            'placeholder' => '8+ characters required',
            'aria-label' => '8+ characters required',
            'required' => true,
            'minlength' => 8,
            'data-hs-toggle-password-options' => '{
                "target": "#changePassTarget",
                "defaultClass": "bi-eye-slash",
                "showClass": "bi-eye",
                "classChangeTarget": "#changePassIcon"
            }',
        ],
    ])->passwordInput()->label(
        'Password',
        [
            'class' => 'form-label w-100',
            'tabindex' => '0',
            'template' => '<span class="d-flex justify-content-between align-items-center">{label}</span>'
        ]
    ) ?>
    <!-- <div class="input-group input-group-merge" data-hs-validation-validate-class>
        <?= Html::activePasswordInput($model, 'password', [
            'class' => 'js-toggle-password form-control form-control-lg',
            'id' => 'signupSrPassword',
            'placeholder' => '8+ characters required',
            'aria-label' => '8+ characters required',
            'required' => true,
            'minlength' => 8,
        ]) ?>
        <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
            <i id="changePassIcon" class="bi-eye"></i>
        </a>
    </div> -->
    <span class="invalid-feedback">Please enter a valid password.</span>
</div>
<!-- End Form -->

<!-- Form Check -->
<div class="form-check mb-4">
    <?= $form->field($model, 'rememberMe')->checkbox([
        'class' => 'form-check-input',
        'id' => 'termsCheckbox',
        'template' => '{input}<label class="form-check-label d-flex justify-content-between align-items-center" for="termsCheckbox">Remember me<a class="form-label-link mb-0" href="./authentication-reset-password-cover.html">Forgot Password?</a></label>',
    ]) ?>
</div>
<!-- End Form Check -->

<div class="d-grid">
    <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-lg']) ?>
</div>

<?php ActiveForm::end(); ?>
            <!-- End Form -->
          </div>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Row -->
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->



<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>
<div class="pattern-square"></div>
<!--Pageheader start-->
<section class="pt-10 pb-5 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">
                <h1 class="mb-3 text-white-stable"><span class="text-warning">Passport</span>  Information - New Insurance</h1>
            </div>
        </div>
    </div>
</section>
<!--Pageheader end-->
<!--Contact us start-->
<section class="mb-xl-9 my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                <div class="row g-xl-7 gy-5">
                    <div class="col-md-12 col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                    <tr>
                                        <td>Departing from</td>
                                        <td><strong>Jordan (AMM)</strong></td>
                                        <td>Going To</td>
                                        <td><strong>Lebanon (BEY)</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td><strong>2024-03-06</strong></td>
                                        <td>Duration</td>
                                        <td><strong>6 days</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Passengers</td>
                                        <td colspan="3">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Passport Number</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Nationality</th>
                                                    <th>DOB</th>
                                                    <th>Country</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>US12344</td>
                                                    <td>AHMED</td>
                                                    <td>M</td>
                                                    <td>Jordanian</td>
                                                    <td>1994/12/10</td>
                                                    <td>Jordan</td>
                                                    <td>
                                                        <a href="#">Edit</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-start">Due Amount: <strong class="text-success">USD $20</strong></td>
                                    </tr>
                                </table>
                                </div>
                                <div class="mt-2">
                                    <?= Html::a('Pay Now', ['#'], ['class'=>'btn btn-success']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Contact us end-->

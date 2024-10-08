<?php

/** @var yii\web\View $this */
/** @var \common\models\Policy[] $policies */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use common\models\Customers;
use common\models\InsuranceCountries;
use common\models\Insurances;
use common\models\Policy;
use common\widgets\Alert;


$this->title = 'Terms and Conditions
';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- <div class="pattern-square"></div> -->
<section class="pt-10 pb-10 bg-dark text-center">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-12">



                <h1 class="mb-3 text-white-stable">
                    <span class="text-warning"><?= Yii::t('app', 'Terms') ?></span> <?= Yii::t('app', 'and Conditions') ?>
                </h1>
                <p><?= Yii::t('app', 'Please read these terms and conditions carefully before using Our Service.
') ?></p>
            </div>
        </div>
    </div>
</section>



<!-- 
<section class="my-xl-9 my-5 py-7">
    <div class="container">
        <div class="row g-4">
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="mb-4">
                    <small class="text-uppercase ls-md fw-semibold "><span class="text-warning">Who</span> we
                        are</small>
                    <h2 class="h1 mt-4 mb-3">Believes in the power of
                        creative strategy.</h2>
                    <p class="mb-3">At 360Protect, we specialize in providing comprehensive insurance solutions
                        to safeguard your travels, belongings, and more.
                        Our goal is to offer tailored coverage that meets your unique needs.
                    </p>
                    <p class="mb-0">Whether you're embarking on a new adventure or simply seeking peace of mind, our goal is to offer tailored coverage that meets your unique needs.
                    </p>


                </div>


            </div>
           <div class="col-xl-6 offset-xl-1 col-lg-6 col-12">
    <div class="row g-4">
        <div class="col-lg-6 col-md-6 col-12">
            <a href="#!">
                <div class="rounded-3 card-lift" style="
                    background-image: url('<?= Yii::$app->request->baseUrl ?>/images/travel.jpg');
                    background-repeat: no-repeat;
                    height: 386px;
                    background-size: cover;
                "></div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <a href="#!">
                <div class="mb-4 rounded-3 card-lift" style="
                    background-image: url('<?= Yii::$app->request->baseUrl ?>/images/about-img/about-grid-img-1.jpg');
                    background-repeat: no-repeat;
                    height: 180px;
                    background-size: cover;
                "></div>
            </a>
            <a href="#!">
                <div class="mb-2 rounded-3 card-lift" style="
                    background-image: url('<?= Yii::$app->request->baseUrl ?>/images/about-img/about-grid-img-3.jpg');
                    background-repeat: no-repeat;
                    height: 180px;
                    background-size: cover;
                "></div>
            </a>
        </div>
    </div>
</div>

        </div>
    </div>
</section> -->

<!-- <style>.intl-tel-input.rtl .intl-tel-input .iti__flag {
    left: initial;
    right: 0;
}</style> -->


<section class="my-xl-7 my-5 py-7">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- <h2 class="text-center">Terms and Conditions</h2>
                <p>Please read these terms and conditions carefully before using Our Service.</p> -->

                <h4>Interpretation and Definitions</h4>
                <h5>Interpretation</h5>
                <p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in the plural.</p>

                <h5>Definitions</h5>
                <p>For the purposes of these Terms and Conditions:</p>
                <ul>
                    <li><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a party, where "control" means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</li>
                    <li><strong>Company</strong> (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Pan North Insurance Agency, Amman, Jordan.</li>
                    <li><strong>Country</strong> refers to: Jordan</li>
                    <li><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</li>
                    <li><strong>Service</strong> refers to the Website.</li>
                    <li><strong>Terms and Conditions</strong> (also referred as "Terms") mean these Terms and Conditions that form the entire agreement between You and the Company regarding the use of the Service.</li>
                    <li><strong>Third-party Social Media Service</strong> means any services or content (including data, information, products or services) provided by a third-party that may be displayed, included or made available by the Service.</li>
                    <li><strong>Website</strong> refers to Pan North Travel Insurance Agency, accessible from <a href="https://360travelcare.com">https://360travelcare.com</a></li>
                    <li><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li>
                </ul>

                <h4>Privacy Statement</h4>
                <p>We are committed to protecting your privacy. Authorized employees within the company on a need to know basis only use any information collected from individual customers. We constantly review our systems and data to ensure the best possible service to our customers.
All credit/debit cards details and personally identifiable information will NOT be stored, sold, shared, rented or leased to any third parties.
</p>
                <!-- Continue adding the rest of the content similarly -->
<ul>
<li>The Website Policies and Terms & Conditions may be changed or updated occasionally to meet the requirements and standards. Therefore the Customers’ are encouraged to frequently visit these sections in order to be updated about the changes on the website. Modifications will be effective on the day they are posted.</li>

<li>Some of the advertisements you see on the Site are selected and delivered by third parties, such as ad networks, advertising agencies, advertisers, and audience segment providers. These third parties may collect information about you and your online activities, either on the Site or on other websites, through cookies, web beacons, and other technologies in an effort to understand your interests and deliver to you advertisements that are tailored to your interests. Please remember that we do not have access to, or control over, the information these third parties may collect. The information practices of these third parties are not covered by this privacy policy.
</li>


</ul>




                <h4>Confidentiality</h4>
                <p>Client records are regarded as confidential and therefore will not be divulged to any third party, other than [our manufacturer/supplier(s) and] if legally required to do so to the appropriate authorities. Clients have the right to request sight of, and copies of any and all Client Records we keep, on the proviso that we are given reasonable notice of such a request. Clients are requested to retain copies of any literature issued in relation to the provision of our services. Where appropriate, we shall issue Client’s with appropriate written information, handouts or copies of records as part of an agreed contract, for the benefit of both parties. We will not sell, share, or rent your personal information to any third party or use your e-mail address for unsolicited mail. Any emails sent by this Company will only be in connection with the provision of agreed services and products.</p>
                <h4>Disclaimer Exclusions and Limitations</h4>
                <p>The information on this web site is provided on an "as is" basis. To the fullest extent permitted by law, this Company:
Excludes all representations and warranties relating to this website and its contents or which is or may be provided by any affiliates or any other third party, including in relation to any inaccuracies or commissions in this website and/or the Company’s literature; and excludes all liability for damages arising out of or in connection with your use of this website. This includes, without limitation, direct loss, loss of business or profits (whether or not the loss of such profits was foreseeable, arose in the normal course of things or you have advised this Company of the possibility of such potential loss), damage caused to your computer, computer software, systems and programs and the data thereon or any other direct or indirect, consequential and incidental damages. This Company does not however exclude liability for death or personal injury caused by its negligence. The above exclusions and limitations apply only to the extent permitted by law. None of your statutory rights as a consumer are affected. 
</p>
<h4>Cancellation Policy</h4>
<p>Notification for instance, in person, via email, mobile phone „text message‟ and/or fax, or any other means will be accepted and non-refundable.  
</p>

<h4>Termination of Agreements and Refunds Policy</h4>
<p>Both the Client and we have the right to terminate any Services Agreement for any reason, including the ending of services that are already underway. No refunds shall be offered, where a Service is deemed to have begun and is, for all intents and purposes, underway. Any monies that have been paid to us which constitute payment in respect of the provision of unused Services shall NOT be refunded.
</p>

<h4>Availability</h4>
<p>Unless otherwise stated, the services featured on this website are only available within Jordan. All advertising is intended solely for the Jordanian market. You are solely responsible for evaluating the fitness for a particular purpose of any downloads, programs and text available through this site. Redistribution or republication of any part of this site or its content is prohibited, including such by framing or other similar or any other means, without the express written consent of the Company. The Company does not warrant that the service from this site will be uninterrupted, timely or error free, although it is provided to the best ability. By using this service, you thereby indemnify this Company, its employees, agents and affiliates against any loss or damage, in whatever manner, howsoever caused.</p>
             


<h4>Log Files</h4>
<p>We use IP addresses to analyze trends, administer the site, track user’s movement, and gather broad demographic
Information for aggregate use. IP addresses are not linked to personally identifiable information. Additionally, for systems administration, detecting usage patterns and troubleshooting purposes, our web servers automatically log standard access information including browser type, access times/open mail, URL requested, and referral URL. This information is not shared with third parties and is used only within this Company on a need-to-know basis. Any individually identifiable information related to this data will never be used in any way different to that stated above without your explicit permission.
</p>







<h4>Cookies</h4>
<p>Like most interactive web sites this Company’s website [or ISP] uses cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site to enable the functionality of this area and ease of use for those people visiting. Some of our affiliate partners may also use cookies.</p>


<h4>Links to this website
</h4>
<p>You may not create a link to any page of this website without our prior written consent. If you do create a link to a page of this website you do so at your own risk and the exclusions and
limitations set out above will apply to your use of this website by linking to it.  
</p>








<h4>Links from this website</h4>
<p>We do not monitor or review the content of other party’s websites which are linked to from this website. Opinions expressed or material appearing on such websites is not necessarily shared or endorsed by us and should not be regarded as the publisher of such opinions or material. Please be aware that we are not responsible for the privacy practices, or content, of these sites. We encourage our users to be aware when they leave our site & to read the privacy statements of these sites. You should evaluate the security and trustworthiness of any other site connected to this site or accessed through this site yourself, before disclosing any personal information to them. This Company will not accept any responsibility for any loss or damage in whatever manner, howsoever caused, resulting from your disclosure to third parties of personal information.</p>




<h4>Communication</h4>
<p>We have several different e-mail addresses for different queries. These, & other contact information, can be found on our sales@tuneprotectjo.com </p>




<h4>Waiver</h4>
<p>Except as provided herein, the failure to exercise a right or to require performance of an obligation under this Terms shall not effect a party's ability to exercise such right or require such performance at any time thereafter nor shall be the waiver of a breach constitute a waiver of any subsequent breach.</p>




<h4>Translation Interpretation</h4>
<p>These Terms and Conditions may have been translated if We have made them available to You on our Service. You agree that the original English text shall prevail in the case of a dispute</p>





<h4>Changes to These Terms and Conditions</h4>
<p>We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material We will make reasonable efforts to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.
By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the Service.
</p>



<h4>Force Majeure
</h4>





                <p>Neither party shall be liable to the other for any failure to perform any obligation under any Agreement which is due to an event beyond the control of such party including but not limited to any Act of God, terrorism, war, Political insurgence, insurrection, riot, civil unrest, act of civil or military authority, uprising, earthquake, flood or any other natural or manmade eventuality outside of our control, which causes the termination of an agreement or contract</p>
              <p>Jordan is our country of domicile.</p>
              
              
                <ul>
                    <li>Minors under the age of 18 shall are prohibited to register as a User of this website and are not allowed to transact or use the website.</li>
                    <li>If you make a payment for our products or services on our website, the details you are asked to submit will be provided directly to our payment provider via a secured connection.</li>
                    <li>The cardholder must retain a copy of transaction records and Merchant policies and rules.
We accept payments online using Visa and MasterCard credit/debit card in Jordanian Dinars.
If Any refunds will be done only through the Original Mode of Payment
In the event that transaction error has occurred while making the payment , a refund in most cases will be issued to the same credit card you used for the original purchase
</li>

<li>https://www.360travelcare.com will NOT deal or provide any services or products to any of OFAC (Office of Foreign Assets Control) sanctions Any dispute or claim arising out of or in connection with this website shall be governed and construed in accordance with the laws of Jordan. 
</li>
                </ul>



<h4>Contact Us</h4>





                <p>If you have any questions about these Terms and Conditions, You can contact us:</p>
                <ul>
                    <li>By email: <a href="mailto:sales@tuneprotectjo.cm">sales@tuneprotectjo.cm</a></li>
                    <li>By visiting this page on our website: <a href="https://www.360travelcare.com/contacts">Contact Page</a></li>
                    <li>By phone number: +962 70 5093626</li>
                </ul>
            </div>
        </div>
    </div>
</section>




<!-- Team 1 - Bootstrap Brain Component -->
<!-- 
<section class="my-xl-9 my-5">
  <div class="container ">
  <div class="row justify-content-center ">
      <div class="col-md-7 text-center">
        <h3 class="mb-3">Experienced & Professional Team</h3>
        <h6 class="subtitle font-weight-normal">You can relay on our amazing features list and also our customer services will be great experience for you without doubt and in no-time</h6>
      </div>
    </div>
  </div>
  
<div class="container   " style="margin-top: 2.5%;">
    <div class="row  justify-content-center">
        <div class="col-md-3 col-sm-6">
            <div class="our-team">
                <div class="pic">
                    <img src="https://media-doh1-1.cdn.whatsapp.net/v/t61.24694-24/434052731_1684943418708219_8368274833351239141_n.jpg?ccb=11-4&oh=01_Q5AaIK79gXwwz1N-yx5UnOdwmSmoxO9mmpKSCIv1SOcdFvyS&oe=66B4D22E&_nc_sid=e6ed6c&_nc_cat=102">
                    <ul class="social">
                        <li><a href="#" class="fab fa-facebook"></a></li>
                        <li><a href="#" class="fab fa-twitter"></a></li>
                        <li><a href="#" class="fab fa-google-plus"></a></li>
                        <li><a href="#" class="fab fa-linkedin"></a></li>
                    </ul>
                </div>
                <div class="team-content">
                    <div class="team-info">
                        <h3 class="title">Ahamd Abu Taha</h3>
                        <span class="post">Web Developer</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3 col-sm-6">
            <div class="our-team">
                <div class="pic">
                    <img src="https://media-doh1-1.cdn.whatsapp.net/v/t61.24694-24/434052731_1684943418708219_8368274833351239141_n.jpg?ccb=11-4&oh=01_Q5AaIK79gXwwz1N-yx5UnOdwmSmoxO9mmpKSCIv1SOcdFvyS&oe=66B4D22E&_nc_sid=e6ed6c&_nc_cat=102">
                    <ul class="social">
                        <li><a href="#" class="fab fa-facebook"></a></li>
                        <li><a href="#" class="fab fa-twitter"></a></li>
                        <li><a href="#" class="fab fa-google-plus"></a></li>
                        <li><a href="#" class="fab fa-linkedin"></a></li>
                    </ul>
                </div>
                <div class="team-content">
                    <div class="team-info">
                        <h3 class="title">Ahamd Abu Taha</h3>
                        <span class="post">Web Developer</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="our-team">
                <div class="pic">
                    <img src="https://media-doh1-1.cdn.whatsapp.net/v/t61.24694-24/434052731_1684943418708219_8368274833351239141_n.jpg?ccb=11-4&oh=01_Q5AaIK79gXwwz1N-yx5UnOdwmSmoxO9mmpKSCIv1SOcdFvyS&oe=66B4D22E&_nc_sid=e6ed6c&_nc_cat=102">
                    <ul class="social">
                        <li><a href="#" class="fab fa-facebook"></a></li>
                        <li><a href="#" class="fab fa-twitter"></a></li>
                        <li><a href="#" class="fab fa-google-plus"></a></li>
                        <li><a href="#" class="fab fa-linkedin"></a></li>
                    </ul>
                </div>
                <div class="team-content">
                    <div class="team-info">
                        <h3 class="title">Ahamd Abu Taha</h3>
                        <span class="post">Web Developer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></section>

     -->






<!--5m member start-->
<!-- <section class="my-xl-9  py-7 bg-primary-dark">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-12">
                <div class="text-center mb-xl-7 mb-5">
                    <h2 class="text-white-stable mb-3">Why Our Insurance Platform Leads:<span class="text-warning"> Statistics that Speak<span></h2>


                    <p class="mb-0 text-white-50">
                        Discover seamless insurance solutions with tailored coverage and exceptional service. </p>
                    </p>
                </div>
            </div>
        </div>
        <div class="row mb-5 pb-4 g-5 text-center text-lg-start">
            <div class="col-md-4">
                <h4 class="text-white-stable">Flexible Payment Options</h4>
                <p class="text-white-50 mb-0">Manage your insurance payments easily<br> with flexible plans.</p>
            </div>
            <div class="col-md-4">
                <h4 class="text-white-stable">Smart Coverage Solutions</h4>
                <p class="text-white-50 mb-0">Intelligent insurance plans adapting<br> to your needs efficiently.</p>
            </div>
            <div class="col-md-4">
                <h4 class="text-white-stable">Effortless Administration</h4>
                <p class="text-white-50 mb-0">Simplify policy management and claims<br> processing effortlessly.</p>
            </div>
        </div>

        <div class="row border-primary border-top g-5 g-lg-0 text-center text-lg-start">
            <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable mb-0 counter" data-count="<?= Insurances::find()->count()  ?>">0 </h5>
                    <span class="text-white-50">Satisfied Customers</span>

                </div>
            </div>
            <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable mb-0 counter" data-count="<?= InsuranceCountries::find()->count()  ?>">0 </h5>
                    <span class="text-white-50">Countries Covered</span>
                </div>
            </div>
            <div class="col-lg-3 col-6 border-end-lg border-md-0 border-lg-primary">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable mb-0 counter" data-count="<?= Insurances::find()->count()  ?>">0 </h5>
                    <span class="text-white-50">Types of Insurance</span>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="p-lg-5">
                    <h5 class="h1 text-white-stable mb-0 counter" data-count="<?= Policy::find()->count() ?>">0 </h5>
                    <span class="text-white-50">Insurance Policies</span>
                </div>
            </div>
        </div>
    </div>
</section> -->


<!--5m member end-->




<!-- <section class="py-7 mb-2">
    <div class="container">




        <div class="row">
            <div class="col-md-12" data-cue="fadeIn">
                <div class="mb-xl-7 mb-4 text-center">
                    <h2 class="mb-3"><?= Yii::t('app', 'Why Choose Us?') ?></h2>
                    <p class="mb-0">
                        <?= Yii::t('app', 'Explore various related insurance options that might suit your needs.') ?>


                    </p>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-lift mb-5 mb-lg-0">
                    <div class="card-body p-lg-5">
                        <div class="mb-5">
                            <div class="icon-lg icon-shape rounded-circle bg-warning bg-opacity-25 border border-warning border-opacity-10 border-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-laptop-fill text-warning" viewBox="0 0 16 16">
                                    <path d="M2.5 2A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h4><?= Yii::t('app', 'Extensive') ?></h4>
                            <p class="mb-0">


                                <?= Yii::t('app', 'Extensive coverage options tailored for travel, luggage, and more.') ?>

                            </p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-lift mt-lg-6 mb-5 mb-lg-0">
                    <div class="card-body p-lg-5">
                        <div class="mb-5">
                            <div class="icon-lg icon-shape rounded-circle bg-info bg-opacity-25 border border-info border-opacity-10 border-4">





                                <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M11 8.5C11 9.88071 9.88071 11 8.5 11C7.11929 11 6 9.88071 6 8.5C6 7.11929 7.11929 6 8.5 6C9.88071 6 11 7.11929 11 8.5Z" stroke="#0DCAF0" stroke-width="2"></path>
                                        <path d="M18 5.5C18 6.88071 16.8807 8 15.5 8C14.1193 8 13 6.88071 13 5.5C13 4.11929 14.1193 3 15.5 3C16.8807 3 18 4.11929 18 5.5Z" stroke="#0DCAF0" stroke-width="2"></path>
                                        <path d="M15.5 20C14.5 21 3.00002 20.5 2.00001 20C1 19.5 5.41016 15 9.00001 15C12.5899 15 16.076 19.424 15.5 20Z" stroke="#0DCAF0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.3522 16.2905C16.0024 16.991 16.5501 17.7108 16.9695 18.3146C17.4791 18.3176 18.1122 18.3174 18.7714 18.3075C19.5445 18.296 20.365 18.2711 21.0682 18.2214C21.4193 18.1965 21.7527 18.1647 22.0422 18.1231C22.3138 18.0841 22.6125 18.028 22.8585 17.9335C23.0969 17.8419 23.3323 17.6857 23.5095 17.4429C23.6862 17.2007 23.7604 16.9334 23.7757 16.6907C23.8039 16.2435 23.6381 15.8272 23.4749 15.5192C23.1328 14.8736 22.5127 14.1722 21.7887 13.5408C20.3574 12.2925 18.1471 11 16 11C14.8369 11 13.97 11.1477 13.192 11.5887C12.4902 11.9866 11.9357 12.5909 11.3341 13.2466L11.2634 13.3236L11.1127 13.4877C11.8057 13.6622 12.4547 13.9653 13.0499 14.337C13.5471 13.8034 13.845 13.5176 14.1784 13.3285C14.5278 13.1305 14.998 13 16 13C17.4427 13 19.196 13.9334 20.4741 15.048C20.9492 15.4624 21.3053 15.8565 21.5299 16.1724C21.3524 16.1926 21.15 16.2106 20.927 16.2263C20.2775 16.2723 19.4991 16.2964 18.7416 16.3077C17.9864 16.319 17.2635 16.3174 16.7285 16.3129C16.4612 16.3106 16.2416 16.3077 16.089 16.3053C16.0127 16.3041 15.9533 16.303 15.9131 16.3023L15.8676 16.3014L15.8562 16.3012L15.8535 16.3011L15.8529 16.3011L15.8528 16.3011L15.8528 16.3011L15.3522 16.2905Z" fill="#0DCAF0"></path>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h4><?= Yii::t('app', 'Trusted Partnerships') ?></h4>
                            <p class="mb-0">

                                <?= Yii::t('app', 'Collaborating with top providers to ensure reliable, trusted coverage.') ?>

                            </p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-lift mb-5 mb-lg-0">
                    <div class="card-body p-lg-5">
                        <div class="mb-5">
                            <div class="icon-lg icon-shape rounded-circle bg-danger bg-opacity-25 border border-danger border-opacity-10 border-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-palette-fill text-danger" viewBox="0 0 16 16">
                                    <path
                                        d="M12.433 10.07C14.133 10.585 16 11.15 16 8a8 8 0 1 0-8 8c1.996 0 1.826-1.504 1.649-3.08-.124-1.101-.252-2.237.351-2.92.465-.527 1.42-.237 2.433.07zM8 5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm4.5 3a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM5 6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h4><?= Yii::t('app', 'Excellence') ?></h4>



                            <p class="mb-0">
                                <?= Yii::t('app', 'Dedicated support for personalized assistance and exceptional service') ?>
                            </p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-lift mt-lg-6 mb-5 mb-lg-0">
                    <div class="card-body p-lg-5">
                        <div class="mb-5">
                            <div class="icon-lg icon-shape rounded-circle bg-primary bg-opacity-25 border border-primary border-opacity-10 border-4">





                                <svg version="1.1" width="20" height="20" id="SECURITY" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1800 1800" enable-background="new 0 0 1800 1800" xml:space="preserve" fill="#8B3DFF">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path fill="#8B3DFF" d="M1096.233,698.227c0-108.2-88.028-196.229-196.229-196.229c-108.205,0-196.234,88.029-196.234,196.229 v74.779H571.518v226.107c1.825,179.273,149.183,325.127,328.487,325.127s326.658-145.854,328.478-325.445V773.006h-132.249V698.227 z M1165.753,835.734v162.74c-1.47,145.039-120.684,263.037-265.749,263.037s-264.283-117.998-265.758-262.717V835.734H1165.753z M766.5,773.006v-74.779c0-73.611,59.889-133.5,133.504-133.5c73.611,0,133.5,59.889,133.5,133.5v74.779H766.5z"></path>
                                            <path fill="#8B3DFF" d="M1668.854,759.284c-58.126-318.375-309.768-570.017-628.138-628.141 C1031.553,61.639,971.966,7.808,900,7.808S768.442,61.642,759.28,131.146C440.91,189.271,189.268,440.914,131.146,759.284 c-69.507,9.162-123.34,68.754-123.34,140.72c0,71.968,53.833,131.551,123.34,140.713 c58.121,318.371,309.763,570.008,628.134,628.135c9.162,69.502,68.754,123.34,140.72,123.34s131.553-53.834,140.716-123.34 c318.37-58.122,570.017-309.764,628.138-628.13c69.507-9.163,123.34-68.75,123.34-140.718 C1792.193,828.038,1738.36,768.446,1668.854,759.284z M900,70.537c33.898,0,62.808,21.432,74.109,51.424 c3.27,8.672,5.142,18.025,5.142,27.827c0,12.525-3.001,24.335-8.195,34.876c-12.93,26.241-39.88,44.382-71.056,44.382 c-31.181,0-58.13-18.141-71.06-44.382c-5.198-10.541-8.196-22.351-8.196-34.876c0-9.801,1.873-19.154,5.142-27.827 C837.188,91.969,866.098,70.537,900,70.537z M121.962,974.115c-29.995-11.306-51.427-40.211-51.427-74.111 c0-33.902,21.432-62.812,51.427-74.114c8.672-3.269,18.027-5.142,27.829-5.142c12.523,0,24.333,2.998,34.874,8.196 c26.236,12.93,44.377,39.879,44.377,71.06c0,31.179-18.141,58.123-44.377,71.058c-10.541,5.19-22.351,8.191-34.874,8.191 C139.989,979.253,130.634,977.381,121.962,974.115z M900,1729.462c-33.902,0-62.812-21.432-74.114-51.427 c-3.269-8.672-5.142-18.027-5.142-27.828c0-12.523,2.998-24.334,8.196-34.875c12.93-26.24,39.879-44.377,71.06-44.377 c31.176,0,58.126,18.137,71.056,44.377c5.194,10.541,8.195,22.352,8.195,34.875c0,9.801-1.872,19.156-5.142,27.828 C962.808,1708.03,933.898,1729.462,900,1729.462z M1034.927,1606.087c-18.605-56.747-72.04-97.86-134.927-97.86 s-116.326,41.113-134.931,97.86c-288.367-54.993-516.166-282.788-571.159-571.159c56.748-18.604,97.861-72.039,97.861-134.924 c0-62.887-41.113-116.326-97.861-134.931c54.993-288.371,282.792-516.17,571.159-571.163 c18.605,56.752,72.044,97.865,134.931,97.865s116.321-41.113,134.927-97.865c288.371,54.993,516.17,282.792,571.163,571.163 c-56.752,18.605-97.865,72.044-97.865,134.931c0,62.885,41.113,116.319,97.865,134.924 C1551.097,1323.299,1323.298,1551.094,1034.927,1606.087z M1678.038,974.115c-8.673,3.266-18.023,5.138-27.824,5.138 c-12.528,0-24.338-3.001-34.879-8.191c-26.24-12.935-44.382-39.879-44.382-71.058c0-31.176,18.142-58.126,44.382-71.06 c10.541-5.198,22.351-8.196,34.879-8.196c9.801,0,19.151,1.873,27.824,5.142c29.995,11.298,51.427,40.212,51.427,74.114 C1729.465,933.904,1708.033,962.818,1678.038,974.115z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h4><?= Yii::t('app', 'Secure') ?></h4>

                            <p class="mb-0">

                                <?= Yii::t('app', 'Dedicated support for personalized assistance and exceptional service.') ?>


                            </p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->


<!-- 
<script>$(window).on('load', function() {
    $('#preloader').fadeOut('slow', function() {
        $(this).remove();
    });
});</script> -->
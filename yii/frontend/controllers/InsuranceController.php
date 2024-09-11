<?php

namespace frontend\controllers;

use common\models\Countries;
use common\models\Customers;
use common\models\InsuranceCountries;
use common\models\Insurances;
use common\models\Plans;
// use common\models\JobResult;
// use console\jobs\PolicyStatusCheckJob as JobsPolicyStatusCheckJob;
// use common\models\PlansCoverage;
// use common\models\PlansItems;
// use frontend\jobs\PolicyStatusCheckJob;
use common\models\Policy;
use common\models\PolicyDraft;
use common\models\PolicyDraftPassengers;
use common\models\Pricing;
use DateTime;
use frontend\models\InquiryForm;
// use GuzzleHttp\Psr7\Request;
// use PhpOffice\PhpSpreadsheet\Chart\Title;
use Yii;
// use yii\queue\file\Queue;

use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


class InsuranceController extends BaseController
{







    // public function actionTravel()
    // {
    //     $model = new InquiryForm();
    //     $model->setAttributes(\Yii::$app->request->get('InquiryForm'));

    //     $fromCountryName = $this->getCountryName($model->from_country);
    //     $toCountryName = $this->getCountryName($model->to_country);

    //     if ($model->from_country === $model->to_country) {
    //         // dd( $model->to_country );
    //         Yii::$app->session->setFlash('error', 'Departure and arrival countries cannot be the same.');
    //         return $this->redirect(Yii::$app->getRequest()->getReferrer());
    //     }
    //     // dd($model);
    //     if ($model->load(Yii::$app->request->post())) {

    //         $passengers = $model->adult + $model->children;
    //         $pricing = Pricing::find()
    //             ->where(['plan_id' => $model->plan])
    //             ->andWhere(['duration' => $model->duration])
    //             ->one();

    //         $price = $pricing->discount_price  && $pricing->status == 1  ? $pricing->discount_price : $pricing->price;

    //         // dd($price);
    //         // if (!$price) {

    //         //     Yii::$app->session->setFlash('error', 'No pricing found for selected plan and duration.');
    //         //     return $this->refresh(); 
    //         // }
    //         // dd($model->from_country);

    //         $draft = new PolicyDraft();
    //         $draft->insurance_id = $model->type;
    //         $draft->plan_id = $model->plan;
    //         $draft->DepartCountryCode = $model->from_country;
    //         $draft->ArrivalCountryCode = $model->to_country;

    //         $departureDateFormat = 'd/m/Y';
    //         $departureDate = DateTime::createFromFormat($departureDateFormat, $model->date);


    //         if ($departureDate === false) {

    //             $errors = DateTime::getLastErrors();
    //             var_dump($errors);
    //             die('Failed to parse departure date.');
    //         }


    //         $timestamp = $departureDate->getTimestamp();
    //         $duration = '+' . ($model->duration - 1) . ' day';
    //         $draft->return_date = date('Y-m-d', strtotime($duration, $timestamp));


    //         $draft->departure_date = $departureDate->format('Y-m-d'); // Store in Y-m-d format
    //         $draft->adult = $model->adult;
    //         $draft->children = $model->children;
    //         $draft->infant = $model->infants;
    //         $draft->price = $price * $passengers;


    //         if ($draft->save()) {
    //             return $this->redirect(['insurance/passengers', 'draft' => $draft->id]);
    //         } else {
    //             var_dump($draft->errors);
    //             die();
    //         }
    //     }
    //     $adultPassenger = null;
    //     $childrenPassenger = null;

    //     // $plans = Plans::find()
    //     //     ->where(['insurance_id' => $model->type])

    //     //     ->all();
    //     if ($model->adult) {
    //         $adultPassenger = "adult";
    //     }
    //     if ($model->children) {
    //         $childrenPassenger = "child";
    //     }

    //     // dd( $childrenPassenger );
    //     $plans = Plans::find()
    //         ->joinWith('pricings')
    //         ->where(['plans.insurance_id' => $model->type])
    //         ->andWhere(['pricing.duration' => $model->duration])
    //         ->andWhere([
    //             'or',
    //             ['pricing.passenger' => $adultPassenger],
    //             ['pricing.passenger' => $childrenPassenger],
    //             [
    //                 'and',
    //                 ['pricing.passenger' => $adultPassenger],
    //                 ['pricing.passenger' => $childrenPassenger]
    //             ]
    //         ])
    //         ->all();



    //     // $selectedPlan = null;
    //     // $selectedPrice = null;

    //     // foreach ($plans as $plan) {
    //     //     foreach ($plan->pricings as $pricing) {
    //     //         $passengerMatches = 
    //     //             ($pricing->passenger == $model->adult && $pricing->children == $model->children) ||
    //     //             ($pricing->passenger == 0 && $pricing->children == $model->children) ||
    //     //             ($pricing->passenger== 0 && $pricing->passenger == $model->adult);
    //     //         dd($passengerMatches );
    //     //         if ($passengerMatches) {
    //     //             $selectedPlan = $plan;
    //     //             $selectedPrice = $pricing;
    //     //             break 2; 
    //     //         }
    //     //     }
    //     // }
    //     // $model->from_country='JO';
    //     // dd($model->from_country);
    //     $CountryCode = strtoupper($model->from_country);
    //     // dd($CountryCode);
    //     $insuranceCountry = InsuranceCountries::find()
    //         ->where(['insurance_id' => $model->type])
    //         ->andWhere(['UPPER(country_code)' => $CountryCode])
    //         ->one();


    //     // dd( $insuranceCountry);
    //     $options = [];
    //     foreach ($plans as $plan) {
    //         $insuranceTitle = $plan->insurance->name;
    //         // dd($insuranceTitle);
    //         $price = Pricing::find()
    //             ->where(['plan_id' => $plan->id])
    //             ->andWhere(['duration' => $model->duration])
    //             ->one();

    //         $options[$plan->id] = [
    //             'name' => $plan->name,
    //             'price' => $price ? $price->price : 0,
    //             'discount_price' => $price ? $price->discount_price : null,
    //             'status' => $price ? $price->status : 'Pricing::STATUS_INACTIVE',
    //         ];
    //     }
    //     if (empty($options)) {
    //         Yii::$app->session->setFlash('error', 'No plans are available for the selected options.');
    //         return $this->redirect(Yii::$app->getRequest()->getReferrer());
    //     }
    //     return $this->render('index', [
    //         'model' => $model,
    //         'options' => $options,
    //         'insuranceTitle' => $insuranceTitle ?? '',
    //         'insuranceCountry' => $insuranceCountry,
    //         'fromCountryName' => $fromCountryName,
    //         'adultPassenger' => $adultPassenger,
    //         'childrenPassenger' => $childrenPassenger,
    //         'toCountryName' => $toCountryName,
    //     ]);
    // }


    // protected function getCountryName($countryCode)
    // {
    //     $country = Countries::findOne(['code' => $countryCode]);
    //     return $country ? $country->country : null;
    // }


    // public function actionRetake($id, $policyId)
    // {

    //     $policy = PolicyDraft::findOne(['id' => $policyId]);

    //     if ($policy === null) {
    //         throw new \yii\web\NotFoundHttpException('The requested policy draft does not exist.');
    //     }


    //     $passengers = PolicyDraftPassengers::findAll(['draft_id' => $policyId]);

    //     foreach ($passengers as $passenger) {
    //         $passenger->delete();
    //     }


    //     return $this->redirect(['insurance/passengers', 'draft' => $policy->id]);
    // }


    // protected function getCountryName($countryCode)
    // {

    //     $cacheKey = 'country_name_' . $countryCode;


    //     $countryName = Yii::$app->cache->get($cacheKey);

    //     if ($countryName === false) {

    //         $country = Countries::findOne(['code' => $countryCode]);

    //         $countryName = $country ? $country->country : null;


    //         Yii::$app->cache->set($cacheKey, $countryName, 27000);
    //     }

    //     return $countryName;
    // }



    // public function actionPassengers($draft)
    // {

    //     // dd($draft);
    //     $policy = PolicyDraft::findOne($draft);


    //     $policy->setScenario('update');
    //     $attr = array();

    //     if ($policy->adult != null) {
    //         for ($i = 1; $i <= $policy->adult; $i++) {
    //             $name = 'Adult' . ($i);
    //             $attr[] = $name;
    //             $labels[$name] = ucwords(Yii::t('app', "Adult Passport (#" . ($i) . ")"));
    //         }
    //     }
    //     if ($policy->children != null) {
    //         for ($i = 1; $i <= $policy->children; $i++) {
    //             $name = 'Child' . ($i);
    //             $attr[] = $name;
    //             $labels[$name] = ucwords(Yii::t('app', "Child Passport (#" . ($i) . ")"));
    //         }
    //     }
    //     if ($policy->infant != null) {
    //         for ($i = 1; $i <= $policy->infant; $i++) {
    //             $name = 'Infant' . ($i);
    //             $attr[] = $name;
    //             $labels[$name] = ucwords(Yii::t('app', "Infant Passport (#" . ($i) . ")"));
    //         }
    //     }

    //     $model = new \yii\base\DynamicModel($attr);
    //     $model->setAttributeLabels($labels);
    //     $model->addRule($attr, 'required');




    //     if ($model->load(Yii::$app->request->post()) && $policy->load(Yii::$app->request->post())) {
    //         $policy->save();

    //         $allFilesProcessed = true;

    //         foreach ($attr as $item) {
    //             // dd($attr['i']);
    //             $files = UploadedFile::getInstances($model, $item);

    //             foreach ($files as $file) {
    //                 if ($file !== null) {
    //                     $fileName = $file->baseName . '.' . time() . $file->extension;
    //                     $path = Yii::getAlias('@webroot/uploads/') . $fileName;

    //                     if ($file->saveAs($path)) {
    //                         $post = [
    //                             'file_base64' => base64_encode(file_get_contents($path)),
    //                             'apikey' => 'pS2xHPtEAwqbspQBxFBYKpFIO54pqwNg',
    //                             'authenticate' => true,
    //                             'authenticate_module' => 2,
    //                             'verify_expiry' => true,
    //                             'type' => "IPD"
    //                         ];

    //                         $ch = curl_init();
    //                         curl_setopt($ch, CURLOPT_URL, 'https://api.idanalyzer.com');
    //                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //                         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    //                         $response = curl_exec($ch);
    //                         curl_close($ch);

    //                         $json_request = json_decode($response, true);

    //                         if (isset($json_request['error'])) {
    //                             Yii::$app->session->setFlash('error', $json_request['error']['message'] . ' (File: ' . $fileName . ')');
    //                             $allFilesProcessed = false;
    //                             PolicyDraftPassengers::deleteAll(['draft_id' => $policy->id]);

    //                             break 2;
    //                         } elseif ($json_request['verification']['passed']) {
    //                             $dob = $json_request['result']['dob'] ?? "null";
    //                             $PolicyDraftPassengers = new PolicyDraftPassengers();
    //                             $PolicyDraftPassengers->draft_id = $policy->id;
    //                             $PolicyDraftPassengers->id_number = $json_request['result']['documentNumber'] ?? "null";
    //                             $PolicyDraftPassengers->first_name = $json_request['result']['firstName'] ?? "null";
    //                             $PolicyDraftPassengers->middle_name = $json_request['result']['middleName'] ?? "null";
    //                             $PolicyDraftPassengers->last_name = $json_request['result']['lastName'] ?? "null";
    //                             $PolicyDraftPassengers->dob = $dob;
    //                             $PolicyDraftPassengers->id_type = $json_request['result']['documentType'] ?? "null";
    //                             $PolicyDraftPassengers->country = $json_request['result']['issuerOrg_iso2'] ?? "null";
    //                             $PolicyDraftPassengers->nationality = $json_request['result']['nationality_iso2'] ?? "null";
    //                             $PolicyDraftPassengers->gender = $json_request['result']['sex'] ?? "null";

    //                             $PolicyDraftPassengers->gender = ($PolicyDraftPassengers->gender == 'M') ? 'Male' : 'Female';
    //                             $PolicyDraftPassengers->id_type = ($PolicyDraftPassengers->id_type == 'P') ? 'Passport' : $PolicyDraftPassengers->id_type;
    //                             $PolicyDraftPassengers->warning = isset($json_request['authentication']['warning']) ? implode(',', $json_request['authentication']['warning']) : "null";
    //                             $PolicyDraftPassengers->document_link = '/uploads/' . $fileName;
    //                             $PolicyDraftPassengers->save();
    //                         } else {
    //                             //   dd("shatha");
    //                             Yii::$app->session->setFlash('error', join(" and ", $json_request['authentication']['warning']));

    //                             $allFilesProcessed = false;
    //                             PolicyDraftPassengers::deleteAll(['draft_id' => $policy->id]);
    //                             break;
    //                         }
    //                     } else {
    //                         Yii::$app->session->setFlash('error', 'Failed to save file: ' . $file->name);
    //                         $allFilesProcessed = false;
    //                         PolicyDraftPassengers::deleteAll(['draft_id' => $policy->id]);

    //                         break;
    //                     }
    //                 }
    //             }
    //         }

    //         if ($allFilesProcessed) {
    //             return $this->redirect(['review', 'draft' => $policy->id]);
    //         }
    //     }



    //     return $this->render('passengers', [
    //         'model' => $model,
    //         'policy' => $policy,
    //     ]);
    // }



    // public function actionReview($draft)
    // {
    //     $policy = PolicyDraft::findOne($draft);
    //     // dd($policy);
    //     return $this->render('review', [
    //         'policy' => $policy,
    //     ]);
    // }

    // public function actionDownload()
    // {
    //     $filePath = '/path/to/your/file.pdf'; 
    //     $fileName = 'document.odf'; 
    //     if (file_exists($filePath)) {
    //         Yii::$app->response->sendFile($filePath, $fileName, [
    //             'mimeType' => 'application/vnd.oasis.opendocument.text',
    //             'forceDownload' => true,
    //         ]);
    //         return;
    //     }
                        
    //     throw new NotFoundHttpException('The requested file does not exist.');
    // }

    // public function actionType($slug = null)
    // {
    //     $country = InsuranceCountries::findOne(['slug' => $slug]);
    //     $model = new InquiryForm();

    //     $sourceCountry = $country ? $country->country_code : null;

    //     // $insurances = $country ? \common\models\Insurances::find()
    //     //     ->joinWith('insuranceCountries')
    //     //     ->where(['source_country' => $country->source_country])
    //     //     ->all() : [];

    //     $insurances = $country
    //         ? \common\models\Insurances::find()->joinWith('insuranceCountries')->where(['source_country' => $country->source_country])->all()
    //         : \common\models\Insurances::find()->all();
    //     // dd( $country);
    //     return $this->render('site/', [
    //         'model' => $model,
    //         'country' => $country,
    //         'sourceCountry' => $sourceCountry,
    //         'insurances' => $insurances,
    //     ]);
    // }







    public function actionPrograms($slug = null)
    {
        if ($slug === null) {
            $firstInsurance = Insurances::find()->orderBy(['id' => SORT_ASC])->one();
            if ($firstInsurance !== null) {
                $slug = $firstInsurance->slug;
            } else {
                throw new NotFoundHttpException('No insurance records found.');
            }
        }
        // $country = InsuranceCountries::findOne(['slug' => $slug]);
        $insurance = Insurances::findOne(['slug' => $slug]);
        // if ($country === null && $insurance === null) {
        //     throw new NotFoundHttpException('The requested page does not exist.');
        // }
// dd( $insurance);

        $model = new InquiryForm();
        return $this->render('programs', [
            'model' => $model,

            'insurance' => $insurance,
        ]);
    }

    // public function actionCheck()
    // {
    //     $model = new \yii\base\DynamicModel(['mobile', 'reCaptcha']);
    //     $model->addRule(['mobile'], 'required');

    //     if ($model->load(Yii::$app->request->post())) {
    //         $mobile = $model->mobile;


    //         $customer = Customers::findOne(['mobile' => $mobile]);

    //         if ($customer) {

    //             $sessionData = Yii::$app->session->get('session_data', []);
    //             $lastResendTimestamp = $sessionData['last_resend_timestamp'] ?? 0;
    //             $currentTimestamp = time();
    //             $interval = 5 * 60;

    //             if ($lastResendTimestamp && ($currentTimestamp - $lastResendTimestamp < $interval)) {
    //                 $remainingTime = $interval - ($currentTimestamp - $lastResendTimestamp);
    //                 Yii::$app->session->setFlash('info', "Please wait " . intval($remainingTime / 60) . "m " . ($remainingTime % 60) . "s before requesting a new OTP.");
    //                 return $this->render('policy', ['model' => $model]);
    //             }


    //             $response = $this->actionSend($mobile);
    //             $responseData = json_decode($response, true);

    //             if ($responseData && $responseData['status'] == 201) {

                 
    //         Yii::$app->session->remove(
    //             'session_data'[0],
    //             'last_resend_timestamp',

    //         );

    //                 Yii::$app->session->set('mobile', $mobile);
    //                 return $this->redirect(['verify-otp']);
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Failed to send OTP.');
    //             }
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Mobile number not found.');
    //         }
    //     }

    //     return $this->render('policy', ['model' => $model]);
    // }





    // public function actionResend($mobile)
    // {





    //     $response = $this->actionSend($mobile);
    //     $responseData = json_decode($response, true);

    //     if ($responseData && $responseData['status'] == 201) {

    //         Yii::$app->session->set('mobile', $mobile);
    //         return $this->redirect(['verify-otp']);
    //     } else {
    //         Yii::$app->session->setFlash('error', 'Failed to send OTP.');
    //     }
    //     return $responseData;
    // }

    // public function actionResend($mobile)
    // {
    //     $sessionData = Yii::$app->session->get('session_data', []);
    //     $lastResendTimestamp = $sessionData['last_resend_timestamp'] ?? 0;
    //     $currentTimestamp = time();
    //     $interval = 5 * 60;

    //     if ($lastResendTimestamp && ($currentTimestamp - $lastResendTimestamp < $interval)) {
    //         Yii::$app->session->setFlash('error', 'You can only resend OTP every 5 minutes.');
    //         return $this->redirect(['verify-otp']);
    //     }

    //     $sessionData = [
    //         'last_resend_timestamp' => $currentTimestamp,
    //         'mobile_resend' => $mobile,
    //     ];


    //     Yii::$app->session->set('session_data', $sessionData);


    //     $response = $this->actionSend($mobile);
    //     $responseData = json_decode($response, true);

    //     if ($responseData && $responseData['status'] == 201) {
    //         Yii::$app->session->set('mobile', $mobile);

    //         Yii::$app->session->remove(
    //             'session_data'[0],
    //             'last_resend_timestamp',

    //         );
            
    //         return $this->redirect(['verify-otp']);
    //     } else {
    //         Yii::$app->session->setFlash('error', 'Failed to send OTP.');
    //     }

    //     return $this->redirect(['verify-otp']);
    // }



    // public function actionSend($mobile)
    // {
    //     $curl = curl_init();
    //     $from = "360Protect";
    //     $message = "Hello from Releans API";

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://api.releans.com/v2/otp/send",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => "sender=$from&mobile=$mobile&content=$message",
    //         CURLOPT_HTTPHEADER => [
    //             "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImEzNWE5MmFmLWVhMGItNGYwNy04ZmMzLWQ2NmM3NWVmOTlkZCIsImlhdCI6MTcyMDA3NzI4MSwiaXNzIjoxOTQ3OH0.-cHxsksuyLILpuuBbKmNAo_TiZSJTwmtjNPF1CeyRug"
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $error = curl_error($curl);
    //     curl_close($curl);

    //     if ($error) {
    //         Yii::$app->session->setFlash('error', 'Curl error: ' . $error);
    //         return json_encode(['status' => 500, 'message' => 'Curl error']);
    //     }

    //     return $response;
    // }





    // public function actionVerifyOtp()
    // {
    //     $model = new \yii\base\DynamicModel(['otp']);
    //     $model->addRule(['otp'], 'required');
    //     $mobile = Yii::$app->session->get('mobile');

    //     if ($model->load(Yii::$app->request->post())) {

    //         $otpArray = Yii::$app->request->post('DynamicModel')['otp'];
    //         $model->otp = implode('', $otpArray);

    //         if ($model->validate()) {
    //             $otp = $model->otp;
    //             $curl = curl_init();
    //             curl_setopt_array($curl, array(
    //                 CURLOPT_URL => "https://api.releans.com/v2/otp/check",
    //                 CURLOPT_RETURNTRANSFER => true,
    //                 CURLOPT_ENCODING => "",
    //                 CURLOPT_MAXREDIRS => 10,
    //                 CURLOPT_TIMEOUT => 0,
    //                 CURLOPT_FOLLOWLOCATION => true,
    //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                 CURLOPT_CUSTOMREQUEST => "POST",
    //                 CURLOPT_POSTFIELDS => "mobile=$mobile&code=$otp",
    //                 CURLOPT_HTTPHEADER => array(
    //                     "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImEzNWE5MmFmLWVhMGItNGYwNy04ZmMzLWQ2NmM3NWVmOTlkZCIsImlhdCI6MTcyMDA3NzI4MSwiaXNzIjoxOTQ3OH0.-cHxsksuyLILpuuBbKmNAo_TiZSJTwmtjNPF1CeyRug"
    //                 ),
    //             ));

    //             $response = curl_exec($curl);
    //             curl_close($curl);

    //             $responseData = json_decode($response, true);

    //             if (isset($responseData['status']) && $responseData['status'] == 200) {
    //                 // Yii::$app->session->setFlash('success', 'OTP verified successfully.');
    //                 // Yii::$app->session->remove('mobile');

    //                 Yii::$app->session->remove(
    //                     'session_data'[0],
    //                     'last_resend_timestamp',

    //                 );

    //                 return $this->redirect(['display-policy']);
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Failed to verify OTP.');
    //             }
    //         }
    //     }

    //     return $this->render('verify-otp', [
    //         'model' => $model,
    //         'mobile' => $mobile
    //     ]);
    // }



    // private function verifyOtp($mobile, $otp)
    // {
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.releans.com/v2/otp/check",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => "mobile=$mobile&code=$otp",
    //         CURLOPT_HTTPHEADER => array(
    //             "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImEzNWE5MmFmLWVhMGItNGYwNy04ZmMzLWQ2NmM3NWVmOTlkZCIsImlhdCI6MTcyMDA3NzI4MSwiaXNzIjoxOTQ3OH0.-cHxsksuyLILpuuBbKmNAo_TiZSJTwmtjNPF1CeyRug"
    //         ),
    //     ));


    //     dd( array(
    //         CURLOPT_URL => "https://api.releans.com/v2/otp/check",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => "mobile=$mobile&code=$otp",
    //         CURLOPT_HTTPHEADER => array(
    //             "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImEzNWE5MmFmLWVhMGItNGYwNy04ZmMzLWQ2NmM3NWVmOTlkZCIsImlhdCI6MTcyMDA3NzI4MSwiaXNzIjoxOTQ3OH0.-cHxsksuyLILpuuBbKmNAo_TiZSJTwmtjNPF1CeyRug"
    //         ),
    //     ) );
    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     return $response;
    // }


    // public function actionDisplayPolicy($policies=[] )
    // {
    //     $mobile = Yii::$app->session->get('mobile');
    //     $customer = Customers::findOne(['mobile' => $mobile]);

    //     if ($customer) {
    //         $policies = Policy::find()->where(['customer_id' => $customer->id])->all();
    //     } else {
    //         $policies;
    //     }

    //     // Yii::$app->session->remove('mobile');
    //     return $this->render('display-policy', [
    //         'policies' => $policies,
    //     ]);
    // }


    // public function actionContact()
    // {
    //     $model = new \yii\base\DynamicModel(['name', 'email', 'message', 'mobile']);
    //     $model->addRule(['name', 'email', 'message', 'mobile'], 'required')
    //         ->addRule('email', 'email');

    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         // dd( $model);
    //         $email = filter_var($model->email, FILTER_VALIDATE_EMAIL) ? $model->email : 'no-reply@example.com';
    //         $name = !empty($model->name) ? $model->name : 'Unknown';
    //         $message = $model->message;
    //         $mobile = $model->mobile;
    //         Yii::$app->mailer->compose()
    //             ->setTo('shatha.rababah@releans.com')
    //             ->setFrom([$email => $name])
    //             ->setSubject('Contact Form Submission')
    //             ->setHtmlBody('<b>Hay</b>' . $name . '</br>' . $message . '<br>' . $mobile)
    //             ->send();
    //         // Yii::$app->session->setFlash('Thank you for contacting us. We will respond to you as soon as possible.');
    //         Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');

    //         // Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');

    //         return $this->refresh();
    //     }

    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }


    // public function actionDisplayPolicy($policyId = null)
    // {
    //     $mobile = Yii::$app->session->get('mobile');
    //     $customer = Customers::findOne(['mobile' => $mobile]);

    //     if ($customer) {
    //         $policies = Policy::find()->where(['customer_id' => $customer->id])->all();
    //     } else {
    //         $policies = [];
    //     }

    //     if ($policyId) {
    //         $policy = Policy::findOne($policyId);
    //         // dd("shatha");
    //         return $this->render('display-policy', [
    //             'policies' => [$policy],
    //         ]);
    //     }



    //     return $this->render('display-policy', [
    //         'policies' => $policies,
    //     ]);
    // }




    // public function actionPayment($id)
    // {
    //     $policyDraft = PolicyDraft::findOne($id);
    //     $passenger = PolicyDraftPassengers::find()->where(['draft_id' => $id])->one();
    //     if ($policyDraft === null) {
    //         throw new NotFoundHttpException('The requested policy does not exist.');
    //     }

    //     $model = new \yii\base\DynamicModel(['number', 'expmonth', 'expyear', 'cvv', 'price']);
    //     $model->addRule(['number', 'expmonth', 'expyear', 'cvv', 'price'], 'required')
    //         ->addRule(['number'], 'string', ['length' => 16])
    //         ->addRule(['cvv'], 'string', ['length' => [3, 4]])
    //         ->addRule(['expmonth', 'expyear'], 'integer');

    //     $model->price = $policyDraft->price;

    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         $paymentData = [
    //             'number' => $model->number,
    //             'expmonth' => $model->expmonth,
    //             'expyear' => $model->expyear,
    //             'cvv' => $model->cvv,
    //             'price' => $policyDraft->price,
    //             'payment-token' => Yii::$app->request->post('payment-token'),
    //         ];

    //         $response = $this->processPayment($paymentData);
    //         $fromCountryName = $this->getCountryName($policyDraft->DepartCountryCode);
    //         $toCountryName = $this->getCountryName($policyDraft->ArrivalCountryCode);
    //         // dd($policyDraft->source);

    //         if (isset($response['tran_ref']) && !empty($response['tran_ref'])) {
    //             $apiEndpoint = 'https://tuneprotectjo.com/api/policies';
    //             $apiKey = 'eyJhbGciOiJIUzI1NiJ9.eyJpZCI6IjJlMzM3YmM2LWFmMzMtNDFjNS04ZTM2LWQ2NzJjMWRjNDYyNSIsImlhdCI6IjIwMjQtMDctMDQiLCJpc3MiOjE4M30.jdsWqHcU0cL4ZHKr0oZYBvamRrpYwvfCARitiBTVzqU';

    //             // dd($policyDraft->departure_date);
    //             $departureDate = new DateTime($policyDraft->departure_date);
    //             $returnDate = new DateTime($policyDraft->return_date);

    //             $interval = $departureDate->diff($returnDate);
    //             // dd($interval );
    //             $days = $interval->days;
    //             $dob = new DateTime($passenger->dob);
    //             $now = new DateTime();
    //             $age = $now->diff($dob)->y;
    //             // dd($days);
    //             // dd(date('Y-m-d', strtotime($policyDraft->departure_date)));

    //             // personalNumber
    //             $apiPayload = [
    //                 "source" => $fromCountryName,
    //                 "from_country" => $fromCountryName,
    //                 "from_airport" => $policyDraft->from_airport,
    //                 "to_country" => $toCountryName,
    //                 "to_airport" => $policyDraft->going_to,
    //                 "departure_date" => $policyDraft->departure_date,
    //                 "days" => $days,
    //                 "adult" => $policyDraft->adult,
    //                 "child" => $policyDraft->children,
    //                 "infant" => $policyDraft->infant,
    //                 "planCode" => $policyDraft->plan->plan_code,
    //                 "contactDetails" => [
    //                     "name" => "Test Test",
    //                     "email" => $policyDraft->email,
    //                     "mobile" => $policyDraft->mobile
    //                 ],
    //                 "passengers" => [
    //                     [
    //                         "IsInfant" => 0,
    //                         "FirstName" => "Test",
    //                         "LastName" => "Test",
    //                         "Gender" => $passenger->gender,
    //                         "DOB" => $passenger->dob,
    //                         "Age" => $age,
    //                         "IdentityType" => $passenger->id_type,
    //                         "IdentityNo" => $passenger->id_number,
    //                         "IsQualified" => true,
    //                         "Nationality" => $passenger->nationality,
    //                         "CountryOfResidence" => $passenger->country
    //                     ]
    //                 ]
    //             ];

    //             // dd( $apiPayload);
    //             // dd($apiPayload);

    //             // $apiPayload = [
    //             //     "source" => "Jordan",
    //             //     "from_country" => "Jordan",
    //             //     "from_airport" => "AMM",
    //             //     "to_country" => "Lebanon",
    //             //     "to_airport" => "BEY",
    //             //     "departure_date" => "2024-10-09",
    //             //     "days" => 5,
    //             //     "adult" => 1,
    //             //     "child" => 0,
    //             //     "infant" => 0,
    //             //     "planCode" => "JO-API-OUTBOUND-DB COVID PLUS-SILVER",
    //             //     "contactDetails" => [
    //             //         "name" => "Test Test",
    //             //         "email" => "name@example.com",
    //             //         "mobile" => "077XXXXXXXX"
    //             //     ],
    //             //     "passengers" => [
    //             //         [
    //             //             "IsInfant" => 0,
    //             //             "FirstName" => "Test",
    //             //             "LastName" => "Test",
    //             //             "Gender" => "Male",
    //             //             "DOB" => "1991-03-01",
    //             //             "Age" => 33,
    //             //             "IdentityType" => "Passport",
    //             //             "IdentityNo" => "1210000",
    //             //             "IsQualified" => true,
    //             //             "Nationality" => "JO",
    //             //             "CountryOfResidence" => "JO"
    //             //         ]
    //             //     ]
    //             // ];

    //             // dd($apiPayload);
    //             $ch = curl_init($apiEndpoint);
    //             curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //                 'Authorization: Bearer ' . $apiKey,
    //                 'Content-Type: application/json',
    //             ]);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiPayload));

    //             $apiResponse = curl_exec($ch);
    //             // dd(   $apiResponse );
    //             // curl_close($ch);

    //             $apiResponseData = json_decode($apiResponse, true);

    //             // dd($apiResponseData);
    //             // dd( $apiResponseData);
    //             if (isset($apiResponseData['id']) && !empty($apiResponseData['id'])) {

    //                 $customer = Customers::findOne(['mobile' => $policyDraft->mobile]);
    //                 if (!$customer) {
    //                     $customer = new Customers();
    //                     $customer->email = $policyDraft->email;
    //                     $customer->mobile = $policyDraft->mobile;

    //                     if (!$customer->save(false)) {
    //                         Yii::$app->session->setFlash('error', 'Failed to save the customer.');
    //                         return $this->redirect(['error-page']);
    //                     }
    //                 }
    //                 // $response = $this->viewPolicy($id);
    //                 $id = $apiResponseData['id'];
    //                 // dd($id);
    //                 $policy = new Policy();
    //                 $policy->customer_id = $customer->id;
    //                 $policy->source = $fromCountryName;
    //                 $policy->from_airport = $policyDraft->from_airport;
    //                 $policy->DepartCountryCode = $policyDraft->DepartCountryCode;
    //                 $policy->departure_date = $policyDraft->departure_date;
    //                 $policy->going_to = $policyDraft->going_to;
    //                 $policy->ArrivalCountryCode = $policyDraft->ArrivalCountryCode;
    //                 $policy->return_date = $policyDraft->return_date;
    //                 $policy->price = $policyDraft->price;
    //                 $policy->ProposalState = $response['ProposalState'] ?? 'Proposal State';
    //                 $policy->ItineraryID = $id;
    //                 $policy->PNR = $response['PNR'] ?? '';
    //                 $policy->PolicyNo = $response['PolicyNo'] ?? '';
    //                 $policy->PolicyPurchasedDateTime = $response['PolicyPurchasedDateTime'] ?? date('Y-m-d H:i:s');
    //                 $policy->PolicyURLLink = $response['PolicyURLLink'] ?? '';
    //                 $policy->status = $response['status'] ?? 0;
    //                 $policy->status_description = $response['status_description'] ?? 'Status Description';

    //                 if ($policy->save()) {
    //                     // dd($policyDraft->departure_date);
    //                     Yii::$app->queue->delay(5)->push(new \common\jobs\PolicyStatusCheckJob([
    //                         'id' => $id,
    //                         'policyId' => $policy->id
    //                     ]));
    //                     return $this->redirect(['display-policy', 'policyId' => $policy->id]);
    //                 } else {
    //                     var_dump($policy->errors);
    //                 }


    //                 die();


    //                 // Yii::$app->queue->stop( $job );
    //                 // dd($job);
    //                 // $id = $apiResponseData['id'];
    //                 // dd($id );

    //                 // dd(Yii::$app->queue->isWaiting($id));

    //                 // dd(Yii::$app->queue->isReserved($id))
    //                 // ;


    //                 // dd(Yii::$app->queue->isDone($id));

    //                 // sleep(10);

    //                 // Read the log file
    //                 //                     $logFile = Yii::getAlias('@runtime/logs/app.log');
    //                 //                     $logContent = file_get_contents($logFile);
    //                 //                     $logs = explode("\n", $logContent);
    //                 //                     $result = '';

    //                 //                     foreach (array_reverse($logs) as $log) {
    //                 //                         if (strpos($log, "Policy ID: {$id}") !== false) {
    //                 //                             $result = $log;
    //                 //                             dd($log);
    //                 //                             break;
    //                 //                         }
    //                 //                     }
    //                 // dd($result);
    //                 // $policy->ProposalState = $response['ProposalState'] ?? 'Proposal State';
    //                 // $policy->ItineraryID = $id;
    //                 // $policy->PNR = $response['PNR'] ?? '';
    //                 // $policy->PolicyNo = $response['PolicyNo'] ?? '';
    //                 // $policy->PolicyPurchasedDateTime = $response['PolicyPurchasedDateTime'] ?? date('Y-m-d H:i:s');
    //                 // $policy->PolicyURLLink = $response['PolicyURLLink'] ?? '';
    //                 // $policy->status = $response['status'] ?? 1;
    //                 // $policy->status_description = $response['status_description'] ?? 'Status Description';

    //                 // // Fill additional fields from the response
    //                 // $policy->ProposalState = 'Proposal State'; // Set as needed
    //                 // $policy->ItineraryID = $apiResponseData['id']; // Use the returned ID
    //                 // $policy->PNR = ''; // Set as needed
    //                 // // $policy->PolicyNo = $apiResponseData['PolicyNo'];
    //                 // $policy->PolicyPurchasedDateTime = date('Y-m-d H:i:s'); // Set as needed
    //                 // $policy->PolicyURLLink = $apiResponseData['PolicyURLLink'];
    //                 // $policy->status = $apiResponseData['status'];
    //                 // $policy->status_description = 'Status Description'; // Set as needed
    //                 // dd( $response);
    //                 // Yii::$app->session->setFlash('success', 'Payment successful and policy processing is underway.');
    //                 // return $this->redirect(['payment-form', 'price' => $paymentData['price']]);

    //             } else {
    //                 $errorMessage = isset($apiResponseData['error']) ? $apiResponseData['error'] : 'Policy purchase failed. Please try again.';
    //                 Yii::$app->session->setFlash('error', $errorMessage);
    //             }
    //         } else {
    //             $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
    //             Yii::$app->session->setFlash('error', $errorMessage);
    //         }
    //     }

    //     return $this->render('payment', [
    //         'model' => $model,
    //         'policy' => $policyDraft,
    //     ]);
    // }




    // protected function processPayment($data)
    // {
    //     $serverKey = 'SNJN6DLBLB-JGDKD6BLLG-BMGLG6BHZB';
    //     $endpoint = 'https://secure-jordan.paytabs.com/payment/request';

    //     $paymentPayload = [
    //         'profile_id' => '104394',
    //         'tran_type' => 'sale',
    //         'tran_class' => 'ecom',
    //         'cart_id' => 'cart_' . time(),
    //         'cart_currency' => 'JOD',
    //         'cart_amount' => $data['price'],
    //         'cart_description' => 'Payment for insurance policy',
    //         'return' => Yii::$app->urlManager->createAbsoluteUrl(['check']),
    //         'callback' => Yii::$app->urlManager->createAbsoluteUrl(['payment-callback']),
    //         'payment_token' => $data['payment-token'],
    //         'expiry_date' => $data['expmonth'] . '/' . $data['expyear'],
    //         'cvv' => $data['cvv'],


    //     ];

    //     $headers = [
    //         'Authorization:' . $serverKey,
    //         'Content-Type: application/json',
    //     ];

    //     $ch = curl_init($endpoint);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentPayload));

    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     // dd( json_decode($response, true));

    //     return json_decode($response, true);
    // }


    // protected function viewPolicy($id)
    // {
    //     // dd($id);

    //     $apiEndpoint = "https://tuneprotectjo.com/api/policies/$id";
    //     $apiKey = 'eyJhbGciOiJIUzI1NiJ9.eyJpZCI6IjJlMzM3YmM2LWFmMzMtNDFjNS04ZTM2LWQ2NzJjMWRjNDYyNSIsImlhdCI6IjIwMjQtMDctMDQiLCJpc3MiOjE4M30.jdsWqHcU0cL4ZHKr0oZYBvamRrpYwvfCARitiBTVzqU';
    //     $ch = curl_init($apiEndpoint);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         'Authorization: Bearer ' . $apiKey,
    //         'Content-Type: application/json',
    //     ]);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     // Execute the request
    //     $apiResponse = curl_exec($ch);

    //     // Check for cURL errors
    //     if ($apiResponse === false) {
    //         $error = curl_error($ch);
    //         Yii::$app->session->setFlash('error', 'cURL Error: ' . $error);
    //         return $this->redirect(['error-page']);
    //     }

    //     // Close cURL session
    //     curl_close($ch);

    //     // Decode JSON response
    //     $apiResponseData = json_decode($apiResponse, true);

    //     // Check if there's an error in the response
    //     if (isset($apiResponseData['error'])) {
    //         Yii::$app->session->setFlash('error', $apiResponseData['error']);
    //         return $this->redirect(['error-page']);
    //     }

    //     return $apiResponseData;
    // }



    // public function actionPaymentSuccess()
    // {
    //     return $this->render('payment-success');
    // }

    // public function actionPaymentForm($price)
    // {
    //     return $this->render('payment', ['price' => $price]);
    // }
}

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
use borales\extensions\phoneInput\PhoneInputValidator;
use common\models\PaymentMethod;
// use common\components\LanguageComponent;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;

// use GuzzleHttp\Psr7\Request;
// use PhpOffice\PhpSpreadsheet\Chart\Title;
use yii\web\Cookie;
use Yii;
// use yii\queue\file\Queue;

use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


class AsuranceController extends BaseController

{


    // public function actionSwitchLanguage($language)
    // {
    //     Yii::$app->languageComponent->setLanguage($language);

    //     // Debugging
    //     var_dump(Yii::$app->language);
    //     exit;

    //     return $this->redirect(Yii::$app->request->referrer ?: '/');
    // }


    // public $enableCsrfValidation = false;

    // private $uniqueId;
    public function actionSession()
    {
        $sessionData = Yii::$app->session->get('session_data', []);
    
        if (!isset($sessionData['customer_id'])) {
            $uniqueId = Yii::$app->security->generateRandomString();
            $sessionData['customer_id'] = $uniqueId;
            Yii::$app->session->set('session_data', $sessionData);
        } else {
            $uniqueId = $sessionData['customer_id'];
        }
    }
    
    // private function getUniqueId()
    // {
    //     $uniqueId = Yii::$app->session->get('session_data', [])['customer_id']?? null;
    //     return $uniqueId;
    // }
    


    public function actionKinds()
    {
        $model = new InquiryForm();
        $model->setAttributes(\Yii::$app->request->get('InquiryForm'));
        $data = Yii::$app->request->get();
   

        if ($data) {

            if ('JO' === $data['to_country']) {
                Yii::$app->session->setFlash('error', 'Departure and arrival countries cannot be the same.');
                return $this->redirect(Yii::$app->getRequest()->getReferrer());
            }
 
            $model->type;
            $model->from_country = $data['from_country'];
            $model->to_country = $data['to_country'];
            $model->date = $data['date'];
            $model->duration = $data['duration'];
            $model->adult = $data['adult'];
            $model->adult_senior = $data['adult_senior'];
            $model->children = $data['children'];
            $model->infants = $data['infants'];
            $model->plan = $data['plan'] ?? null;
            $model->pax_type = $data['pax_type'];
        }
        

      
        //  dd($data);


        return $this->render('/insurance/insurances', [
            'data' => $data,

        ]);
    }





    //     public function actionType(){

    //         return $this->render('/insurance/insurances');
    // }

    public function actionTravel($id = null)
    {


        $data = Yii::$app->request->queryParams;


        // dd(  $data);
        $model = new InquiryForm();
        $model->setAttributes(\Yii::$app->request->get('InquiryForm'));
        // if($id = null){

        $data = Yii::$app->request->get();
        if ($data) {

            if ($id != null) {
                $data['type'] = $id;
            }
            $model->type = $data['type'];
            $model->from_country = $data['from_country'];
            $model->to_country = $data['to_country'];
            $model->date = $data['date'];
            $model->duration = $data['duration'];
            $model->adult = $data['adult'];
            $model->adult_senior = $data['adult_senior'];
            $model->children = $data['children'];
            $model->infants = $data['infants'];
            $model->plan = $data['plan'] ?? null;
            $model->pax_type = $data['pax_type'];
        }

        // }

        $fromCountryName = 'Jordan';
        $toCountryName = $this->getCountryName($model->to_country);

        if ('JO' === $model->to_country) {
            Yii::$app->session->setFlash('error', 'Departure and arrival countries cannot be the same.');
            return $this->redirect(Yii::$app->getRequest()->getReferrer());
        }

        $adultPassenger = $model->adult ? "adult" : null;
        $childrenPassenger = $model->children ? "child" : null;

        $sourceCountries = InsuranceCountries::find()
            ->select(['id', 'source_country'])
            ->asArray()
            ->all();

        // $fromCountryNameEn = ucfirst(strtolower($fromCountryName['name_en']));
        $fromCountryNameEn = 'Jordan';
        $countryLookup = [];
        foreach ($sourceCountries as $country) {

            $countryLookup[strtolower($country['source_country'])] = $country;
        }
        // dd($sourceCountries);
        $defaultCountry = 'united arab emirates';

        $id = null;

        function findCountryByPartialName($countries, $partialName)
        {
            foreach ($countries as $country) {
                // dd($country['source_country']);
                if (stripos($country['source_country'], $partialName) !== false) {
                    return $country['id'];
                }
            }
            return null;
        }



        $paxTypeRanges = [
            '76-85' => ['min_age' => 76, 'max_age' => 85],
            '19-75' => ['min_age' => 19, 'max_age' => 75],
            '2-18' => ['min_age' => 2, 'max_age' => 18],
        ];

        $selectedPaxType = $model->pax_type;
        // dd(  $model->pax_type);


        // dd(     $id );
        // dd(   $id );
        function getPlans($insuranceId, $sourceId, $planCodeLike, $planCodeNotLike, $minAge, $maxAge)
        {
            $plans = Plans::find()
                ->where(['insurance_id' => $insuranceId])
                ->andWhere(['source_id' => $sourceId])
                ->andWhere(['between', 'min_age', $minAge, $maxAge])
                ->andWhere(['between', 'max_age', $minAge, $maxAge]);

            if ($planCodeLike) {
                $plans->andWhere(['like', 'plan_code', $planCodeLike]);
            }

            if ($planCodeNotLike) {
                $plans->andWhere(['not like', 'plan_code', $planCodeNotLike]);
            }
            // dd( $plans);
            return $plans->all();
        }

        $plans = [];

        if (isset($paxTypeRanges[$selectedPaxType])) {
            $range = $paxTypeRanges[$selectedPaxType];
            $minAge = $range['min_age'];
            $maxAge = $range['max_age'];
            $fromCountryNameKey = strtolower($fromCountryNameEn);
            $id = null;

            if (isset($countryLookup[$fromCountryNameKey]) && $countryLookup[$fromCountryNameKey]['source_country'] !== 'United Arab Emirates') {
                $id = $countryLookup[$fromCountryNameKey]['id'];
                $model->source = $countryLookup[$fromCountryNameKey]['source_country'];

                if ($model->to_country === 'US' || $model->to_country === 'CA') {

                    $plans = getPlans($model->type, $id, 'USCA',  null, $minAge, $maxAge);
                    // dd($plans);
                } else {
                    // dd( $id,$model->type,$minAge, $maxAge);
                    $plans = getPlans($model->type, $id, null, 'USCA', $minAge, $maxAge);
                    // dd( $model->type,  $id, $minAge, $maxAge);
                    // dd($plans);
                }
            } else {
                $id = findCountryByPartialName($sourceCountries, 'emirates');
                if ($id && isset($countryLookup[strtolower($defaultCountry)]) && strpos(strtolower($countryLookup[strtolower($defaultCountry)]['source_country']), 'emirates') !== false) {
                    $id = $countryLookup[strtolower($defaultCountry)]['id'];
                    $model->source = $countryLookup[strtolower($defaultCountry)]['source_country'];
                }

                if ($id !== null) {
                    if ($model->to_country === 'US' || $model->to_country === 'CA') {
                        if ($model->from_country === 'AE') {

                            $plans = getPlans($model->type, $id, 'USCA', 'A2A', $minAge, $maxAge);
                        } else {
                            //    dd("shatha");
                            $plans = getPlans($model->type, $id,  ['USCA', 'A2A'], null, $minAge, $maxAge);
                        }
                    } else {
                        if ($model->from_country === 'AE') {

                            $plans = getPlans($model->type, $id, null, ['USCA', 'A2A'], $minAge, $maxAge);
                        } else {

                            $plans = getPlans($model->type, $id, 'A2A', 'USCA', $minAge, $maxAge);
                        }
                    }
                }
            }




            // dd( $model->source);
        }

        if ($model->load(Yii::$app->request->post())) {
            // dd($model->type);
            $passengers = $model->adult + $model->children + $model->adult_senior;
            $pricing = Pricing::find()
                ->where(['plan_id' => $model->plan])
                ->andWhere(['duration' => $model->duration])
                ->one();

            $price = $pricing->discount_price  && $pricing->status == 1  ? $pricing->discount_price : $pricing->price;


            $draft = new PolicyDraft();
            $draft->insurance_id = $model->type;
            $draft->plan_id = $model->plan;
            $draft->DepartCountryCode = $model->from_country;
            $draft->ArrivalCountryCode = $model->to_country;

            $departureDateFormat = 'd/m/Y';
            $departureDate = DateTime::createFromFormat($departureDateFormat, $model->date);


            if ($departureDate === false) {

                $errors = DateTime::getLastErrors();
                var_dump($errors);
                die('Failed to parse departure date.');
            }


            $timestamp = $departureDate->getTimestamp();
            $duration = '+' . ($model->duration - 1) . ' day';
            $draft->return_date = date('Y-m-d', strtotime($duration, $timestamp));
            $draft->departure_date = $departureDate->format('Y-m-d');
            $draft->adult = $model->adult + $model->adult_senior;
            $draft->children = $model->children;
            $draft->infant = $model->infants;
            $draft->price = $price * $passengers;
            $draft->source = $model->source;
            $draft->AdultCount = $model->adult + $model->adult_senior;
            $draft->ChildrenCount = $model->children;
            $draft->InfantCount = $model->infants;

            if ($draft->save()) {


                // dd(    $draft->source);
                return $this->redirect(['passengers', 'draft' => base64_encode($draft->id)]);
            } else {
                var_dump($draft->errors);
                die();
            }
        }


        $insuranceCountry = InsuranceCountries::findOne($id);

        // dd($plans);
        $options = [];

        foreach ($plans as $plan) {
            $insuranceTitle = $plan->insurance->name;
            $insuranceTitleAr = $plan->insurance->name_ar;
            $price = Pricing::find()
                ->where(['plan_id' => $plan->id])
                ->andWhere(['duration' => $model->duration])
                ->one();

            $options[$plan->id] = [
                'name' => $plan->name,
                'name_ar' => $plan->name_ar,
                'price' => $price ? $price->price : 0,
                'discount_price' => $price ? $price->discount_price : null,
                'status' => $price ? $price->status : 'Pricing::STATUS_INACTIVE',
            ];
        }

        if (empty($options)) {
            Yii::$app->session->setFlash('errorr', 'No plans are available for the selected options.');
            return $this->redirect(Yii::$app->getRequest()->getReferrer());
        }
        // dd($options);
        return $this->render('/insurance/index', [
            'model' => $model,
            'options' => $options,
            'plans' => $plans,
            'insuranceTitle' => $insuranceTitle ?? '',
            'insuranceCountry' => $insuranceCountry,
            'fromCountryName' => $fromCountryName,
            'adultPassenger' => $adultPassenger,
            'childrenPassenger' => $childrenPassenger,
            'toCountryName' => $toCountryName,
            'insuranceTitleAr' => $insuranceTitleAr
        ]);
    }



    // public function actionTravel()
    // {

    //     // $session = Yii::$app->session;
    //     // $session->destroy();
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
    //         $draft->DepartCountryCode = $modelaction->from_country;
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
    //             return $this->redirect(['passengers', 'draft' => $draft->id]);
    //         } else {
    //             var_dump($draft->errors);
    //             die();
    //         }
    //     }
    //     // $adultPassenger = null;
    //     // $childrenPassenger = null;

    //     $plans = Plans::find()
    //         ->where(['insurance_id' => $model->type])

    //         ->all();
    //     // if ($model->adult) {
    //     //     $adultPassenger = "adult";
    //     // }
    //     // if ($model->children) {
    //     //     $childrenPassenger = "child";
    //     // }

    //     // dd( $childrenPassenger );
    //     // $plans = Plans::find()
    //     //     ->joinWith('pricings')
    //     //     ->where(['plans.insurance_id' => $model->type])
    //     //     ->andWhere(['pricing.duration' => $model->duration])
    //     //     ->andWhere([
    //     //         'or',
    //     //         ['pricing.passenger' => $adultPassenger],
    //     //         ['pricing.passenger' => $childrenPassenger],
    //     //         [
    //     //             'and',
    //     //             ['pricing.passenger' => $adultPassenger],
    //     //             ['pricing.passenger' => $childrenPassenger]
    //     //         ]
    //     //     ])
    //     //     ->all();



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

    //             // dd(  $price);

    //         $options[$plan->id] = [
    //             'name' => $plan->name,
    //             'price' => $price ? $price->price : 0,
    //             'discount_price' => $price ? $price->discount_price : null,
    //             'status' => $price ? $price->status : 'Pricing::STATUS_INACTIVE',
    //         ];
    //     }
    //     foreach ($options as $value) {
    //         if ($value['price']==null) {
    //             Yii::$app->session->setFlash('error', 'No plans are available for the selected options.');
    //             return $this->redirect(Yii::$app->getRequest()->getReferrer());
    //         }
    //     }

    //     return $this->render('/insurance/index', [
    //         'model' => $model,
    //         'options' => $options,
    //         'insuranceTitle' => $insuranceTitle ?? '',
    //         'insuranceCountry' => $insuranceCountry,
    //         'fromCountryName' => $fromCountryName,
    //         // 'adultPassenger' => $adultPassenger,
    //         // 'childrenPassenger' => $childrenPassenger,
    //         'toCountryName' => $toCountryName,
    //     ]);

    // }
    protected function getCountryName($countryCode)
    {
        $country = Countries::findOne(['code' => $countryCode]);
        if ($country) {
            return [
                'name_en' => $country->name_en,
                'name_ar' => $country->name_ar,
            ];
        }
        return null;
    }





    // public function actionPassengers($draft, $passengers = null)
    // {
    //     $decodedDraft = base64_decode($draft);
    //     $policy = PolicyDraft::findOne($decodedDraft);
    //     $policy->setScenario('update');

    //     $attr = [];
    //     $labels = [];

    //     Yii::$app->session->set('passengers', ['adult' => $policy->adult, 'children' => $policy->children, 'infant' => $policy->infant]);
    //     $passengers1 = Yii::$app->session->get('passengers');


    //     if ($passengers1['adult']  != null) {
    //         for ($i = 1; $i <= $passengers1['adult']; $i++) {
    //             $name = 'Adult' . ($i);
    //             $attr[] = $name;
    //             $labels[$name] = ucwords(Yii::t('app', "Adult Passport (#" . ($i) . ")"));
    //         }
    //     }
    //     if ($passengers1['children'] != null) {
    //         for ($i = 1; $i <= $passengers1['children']; $i++) {
    //             $name = 'Child' . ($i);
    //             $attr[] = $name;
    //             $labels[$name] = ucwords(Yii::t('app', "Child Passport (#" . ($i) . ")"));
    //         }
    //     }
    //     if ($passengers1['infant'] != null) {
    //         for ($i = 1; $i <= $passengers1['infant']; $i++) {
    //             $name = 'Infant' . ($i);
    //             $attr[] = $name;
    //             $labels[$name] = ucwords(Yii::t('app', "Infant Passport (#" . ($i) . ")"));
    //         }
    //     }

    //     $model = new \yii\base\DynamicModel($attr);
    //     $model->setAttributeLabels($labels);
    //     $model->addRule($attr, 'required');
    //     $savedFiles = [];

    //     if ($model->load(Yii::$app->request->post()) && $policy->load(Yii::$app->request->post())) {
    //         $policy->save();
    //         // dd($attr);


    //         $allFilesProcessed = true;
    //         $errorMessages = [];
    //         $successfulRecords = [];

    //         foreach ($attr as $item) {
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
    //                             $errorMessages[$item][] = $json_request['error']['message'] . ' (File: ' . $fileName . ')';
    //                             $allFilesProcessed = false;
    //                             continue;
    //                         } elseif ($json_request['verification']['passed']) {
    //                             $dob = $json_request['result']['dob'] ?? "null";
    //                             $dobDate = new DateTime($dob);
    //                             $now = new DateTime();
    //                             $age = $now->diff($dobDate)->y;

    //                             if ((strpos($item, 'Adult') !== false && $age < 18) ||
    //                                 (strpos($item, 'Child') !== false && $age >= 18)
    //                             ) {
    //                                 $errorMessages[$item][] = 'The uploaded document does not match the passenger type. Age: ' . $age . '. The document was uploaded for: ' . $item . '. Please ensure that the document is appropriate for the passenger\'s age group (Adult, Child, or Infant).';
    //                                 $allFilesProcessed = false;
    //                                 continue;
    //                             }

    //                             $existingRecord = PolicyDraftPassengers::find()
    //                                 ->where(['draft_id' => $policy->id])
    //                                 ->andWhere([
    //                                     'first_name' => $json_request['result']['firstName'] ?? "null",
    //                                     'middle_name' => $json_request['result']['middleName'] ?? "null",
    //                                     'last_name' => $json_request['result']['lastName'] ?? "null"
    //                                 ])
    //                                 ->one();

    //                             if ($existingRecord === null) {

    //                                 $policy->adult != 0 ? $passengers1['adult']-- : $policy->adult;
    //                                 $policy->children != 0 ? $passengers1['children']-- : $policy->children;


    //                                 $policy->save();
    //                                 $PolicyDraftPassengers = new PolicyDraftPassengers();
    //                                 $PolicyDraftPassengers->draft_id = $policy->id;
    //                                 $PolicyDraftPassengers->id_number = $json_request['result']['documentNumber'] ?? "null";
    //                                 $PolicyDraftPassengers->first_name = $json_request['result']['firstName'] ?? "null";
    //                                 $PolicyDraftPassengers->middle_name = $json_request['result']['middleName'] ?? "null";
    //                                 $PolicyDraftPassengers->last_name = $json_request['result']['lastName'] ?? "null";
    //                                 $PolicyDraftPassengers->dob = $dob;
    //                                 $PolicyDraftPassengers->id_type = $json_request['result']['documentType'] ?? "null";
    //                                 $PolicyDraftPassengers->country = $json_request['result']['issuerOrg_iso2'] ?? "null";
    //                                 $PolicyDraftPassengers->nationality = $json_request['result']['nationality_iso2'] ?? "null";
    //                                 $PolicyDraftPassengers->gender = ($json_request['result']['sex'] ?? "null") === 'M' ? 'Male' : 'Female';
    //                                 $PolicyDraftPassengers->id_type = ($json_request['result']['documentType'] ?? "null") === 'P' ? 'Passport' : $PolicyDraftPassengers->id_type;
    //                                 $PolicyDraftPassengers->warning = isset($json_request['authentication']['warning']) ? implode(',', $json_request['authentication']['warning']) : "null";
    //                                 $PolicyDraftPassengers->document_link = '/uploads/' . $fileName;
    //                                 $PolicyDraftPassengers->save();
    //                                 // if(  $PolicyDraftPassengers->save()){



    //                                 // }


    //                                 $savedFiles[] = $PolicyDraftPassengers;
    //                             } else {
    //                                 $errorMessages[$item][] = 'A document for this person already exists. You cannot upload another document for the same person. Please try with a different person or document.';
    //                                 $allFilesProcessed = false;
    //                                 continue;
    //                             }
    //                         } else {
    //                             $errorMessages[$item][] = join(" and ", $json_request['authentication']['warning']);
    //                             $allFilesProcessed = false;
    //                             continue;
    //                         }
    //                     } else {
    //                         $errorMessages[$item][] = 'Failed to save file: ' . $file->name;
    //                         $allFilesProcessed = false;
    //                         continue;
    //                     }
    //                 }
    //             }
    //         }

    //         if ($allFilesProcessed || !empty($passengers)) {

    //             return $this->redirect(['review', 'draft' => base64_encode($policy->id), 'passengers' =>  base64_encode($passengers)]);
    //         }


    //         if (!empty($errorMessages)) {
    //             $errorMessage = '';
    //             foreach ($errorMessages as $item => $messages) {
    //                 $label = isset($labels[$item]) ? $labels[$item] : $item;
    //                 $errorMessage .= 'Errors for ' . $label . ':<br>' . implode('<br>', $messages) . '<br><br>';
    //             }
    //             Yii::$app->session->setFlash('warning', $errorMessage);
    //         }
    //     }

    //     $savedFiles = PolicyDraftPassengers::find()
    //         ->where(['draft_id' => $policy->id])
    //         ->all();

    //     return $this->render('/insurance/passengers', [
    //         'model' => $model,
    //         'policy' => $policy,
    //         'savedFiles' => $savedFiles
    //     ]);
    // }


    public function actionPassengers($draft, $passengers = null)
    {




        // if ($language !== null) {
        //     Yii::$app->language = $language;
        // }
        $decodedDraft = base64_decode($draft);
        $policy = PolicyDraft::findOne($decodedDraft);
        $policy->setScenario('update');

        $attr = [];
        $labels = [];
        // dd($policy->adult );
        if ($policy->adult != null) {
            for ($i = 1; $i <= $policy->adult; $i++) {
                $name = 'Adult' . ($i);
                $attr[] = $name;
                $labels[$name] = ucwords(Yii::t('app', "Adult Passport (#" . ($i) . ")"));
            }
        }
        if ($policy->children != null) {
            for ($i = 1; $i <= $policy->children; $i++) {
                $name = 'Child' . ($i);
                $attr[] = $name;
                $labels[$name] = ucwords(Yii::t('app', "Child Passport (#" . ($i) . ")"));
            }
        }
        if ($policy->infant != null) {
            for ($i = 1; $i <= $policy->infant; $i++) {
                $name = 'Infant' . ($i);
                $attr[] = $name;
                $labels[$name] = ucwords(Yii::t('app', "Infant Passport (#" . ($i) . ")"));
            }
        }

        $model = new \yii\base\DynamicModel($attr);
        $model->setAttributeLabels($labels);
        $model->addRule($attr, 'required');
        $savedFiles = [];

        if ($model->load(Yii::$app->request->post()) && $policy->load(Yii::$app->request->post())) {
            $policy->save();
            $allFilesProcessed = true;
            $errorMessages = [];
            $successfulRecords = [];

            foreach ($attr as $item) {
                $files = UploadedFile::getInstances($model, $item);

                foreach ($files as $file) {
                    if ($file !== null) {
                        $fileName = $file->baseName . '.' . time() . $file->extension;
                        $path = Yii::getAlias('@webroot/uploads/') . $fileName;

                        if ($file->saveAs($path)) {
                            $post = [
                                'file_base64' => base64_encode(file_get_contents($path)),
                                'apikey' => 'pS2xHPtEAwqbspQBxFBYKpFIO54pqwNg',
                                'authenticate' => true,
                                'authenticate_module' => 2,
                                'verify_expiry' => true,
                                'type' => "IPD"
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, 'https://api.idanalyzer.com');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
                            $response = curl_exec($ch);
                            curl_close($ch);

                            //    dd(     $response );
                            $json_request = json_decode($response, true);
                            // dd(     $response );
                            if (isset($json_request['error'])) {
                                $errorMessages[$item][] = $json_request['error']['message'] . ' (File: ' . $fileName . ')';
                                $allFilesProcessed = false;
                                continue;
                            } elseif ($json_request['verification']['passed']) {
                                $dob = $json_request['result']['dob'] ?? "null";
                                $dobDate = new DateTime($dob);
                                $now = new DateTime();
                                $age = $now->diff($dobDate)->y;

                                if ((strpos($item, 'Adult') !== false && $age < 18) ||
                                    (strpos($item, 'Child') !== false && $age >= 18)
                                ) {
                                    $errorMessages[$item][] = 'The uploaded document does not match the passenger type. Age: ' . $age . '. The document was uploaded for: ' . $item . '. Please ensure that the document is appropriate for the passenger\'s age group (Adult, Child, or Infant).';
                                    $allFilesProcessed = false;
                                    continue;
                                }

                                $existingRecord = PolicyDraftPassengers::find()
                                    ->where(['draft_id' => $policy->id])
                                    ->andWhere([
                                        'first_name' => $json_request['result']['firstName'] ?? "null",
                                        'middle_name' => $json_request['result']['middleName'] ?? "null",
                                        'last_name' => $json_request['result']['lastName'] ?? "null"
                                    ])
                                    ->one();

                                if ($existingRecord === null) {

                                    // $policy->adult != 0 ? $policy->adult-- : $policy->adult;
                                    // $policy->children != 0 ? $policy->children-- : $policy->children;

                                    // if ($policy->adult != 0) {
                                    //     $policy->adult--;

                                    //     $attr = array_filter($attr, function($item) use ($policy) {
                                    //         return strpos($item, 'Adult') === false || $item !== 'Adult' . ($policy->adult + 1);
                                    //     });
                                    // }

                                    if (strpos($item, 'Adult') !== false && $policy->adult > 0) {
                                        $policy->adult--;
                                    } elseif (strpos($item, 'Child') !== false && $policy->children > 0) {
                                        $policy->children--;
                                    } elseif (strpos($item, 'Infant') !== false && $policy->infant > 0) {
                                        $policy->infant--;
                                    }
                                    $policy->save();
                                    $PolicyDraftPassengers = new PolicyDraftPassengers();
                                    $PolicyDraftPassengers->draft_id = $policy->id;
                                    $PolicyDraftPassengers->id_number = $json_request['result']['documentNumber'] ?? "null";
                                    $PolicyDraftPassengers->first_name = $json_request['result']['firstName'] ?? "null";
                                    $PolicyDraftPassengers->middle_name = $json_request['result']['middleName'] ?? "null";
                                    $PolicyDraftPassengers->last_name = $json_request['result']['lastName'] ?? "null";
                                    $PolicyDraftPassengers->dob = $dob;
                                    $PolicyDraftPassengers->id_type = $json_request['result']['documentType'] ?? "null";
                                    $PolicyDraftPassengers->country = $json_request['result']['issuerOrg_iso2'] ?? "null";
                                    $PolicyDraftPassengers->nationality = $json_request['result']['nationality_iso2'] ?? "null";
                                    $PolicyDraftPassengers->gender = ($json_request['result']['sex'] ?? "null") === 'M' ? 'Male' : 'Female';
                                    $PolicyDraftPassengers->id_type = ($json_request['result']['documentType'] ?? "null") === 'P' ? 'Passport' : $PolicyDraftPassengers->id_type;
                                    $PolicyDraftPassengers->warning = isset($json_request['authentication']['warning']) ? implode(',', $json_request['authentication']['warning']) : "null";
                                    $PolicyDraftPassengers->document_link = '/uploads/' . $fileName;
                                    $PolicyDraftPassengers->save();



                                    $savedFiles[] = $PolicyDraftPassengers;
                                } else {
                                    $errorMessages[$item][] = 'A document for this person already exists. You cannot upload another document for the same person. Please try with a different person or document.';
                                    $allFilesProcessed = false;
                                    continue;
                                }
                            } else {
                                $errorMessages[$item][] = join(" and ", $json_request['authentication']['warning']);
                                $allFilesProcessed = false;
                                continue;
                            }
                        } else {
                            $errorMessages[$item][] = 'Failed to save file: ' . $file->name;
                            $allFilesProcessed = false;
                            continue;
                        }
                    }
                }
            }

            if ($allFilesProcessed || !empty($passengers)) {

                return $this->redirect(['review', 'draft' => base64_encode($policy->id), 'passengers' =>  base64_encode($passengers)]);
            }


            if (!empty($errorMessages)) {
                $errorMessage = '';
                foreach ($errorMessages as $item => $messages) {
                    $label = isset($labels[$item]) ? $labels[$item] : $item;
                    $errorMessage .= 'Errors for ' . $label . ':<br>' . implode('<br>', $messages) . '<br><br>';
                }
                Yii::$app->session->setFlash('warning', $errorMessage);
            }
        }
        // dd($attr);
        // if (count($savedFiles) == ($policy->AdultCount + $policy->ChildrenCount + $policy->InfantCount)) {
        //     return $this->redirect(['review', 'draft' => base64_encode($policy->id), 'passengers' => base64_encode($passengers)]);
        // }

        if ($policy->adult != null) {
            $attr = [];
            $labels = [];

            for ($i = 1; $i <= $policy->adult; $i++) {
                $name = 'Adult' . ($i);
                $attr[] = $name;
                $labels[$name] = ucwords(Yii::t('app', "Adult Passport (#" . ($i) . ")"));
            }
        }

        if ($policy->children != null) {
            for ($i = 1; $i <= $policy->children; $i++) {
                $name = 'Child' . ($i);
                $attr[] = $name;
                $labels[$name] = ucwords(Yii::t('app', "Child Passport (#" . ($i) . ")"));
            }
        }

        if ($policy->infant != null) {
            for ($i = 1; $i <= $policy->infant; $i++) {
                $name = 'Infant' . ($i);
                $attr[] = $name;
                $labels[$name] = ucwords(Yii::t('app', "Infant Passport (#" . ($i) . ")"));
            }
        }


        $model = new \yii\base\DynamicModel($attr);
        $model->setAttributeLabels($labels);
        $model->addRule($attr, 'required');


        $savedFiles = PolicyDraftPassengers::find()
            ->where(['draft_id' => $policy->id])
            ->all();
        $fromCountryName = $this->getCountryName($policy->DepartCountryCode);
        $toCountryName = $this->getCountryName($policy->ArrivalCountryCode);
        // dd($policy);
        return $this->render('/insurance/passengers', [
            'model' => $model,
            'policy' => $policy,
            'savedFiles' => $savedFiles,
            'fromCountryName' => $fromCountryName,
            'toCountryName' => $toCountryName
        ]);
    }



    // public function actionPassengers($draft, $passengers = null)
    // {
    //     // Decode the draft ID and find the policy draft
    //     $decodedDraft = base64_decode($draft);
    //     $policy = PolicyDraft::findOne($decodedDraft);

    //     if (!$policy) {
    //         throw new \yii\web\NotFoundHttpException('Policy draft not found.');
    //     }

    //     $policy->setScenario('update');

    //     // Initialize attributes and labels for dynamic model
    //     $attr = [];
    //     $labels = [];

    //     // Save the original number of adults, children, and infants
    //     $originalAdults = $policy->adult;
    //     $originalChildren = $policy->children;
    //     $originalInfants = $policy->infant;

    //     // Determine the number of fields based on the current policy
    //     foreach (['adult' => 'Adult', 'children' => 'Child', 'infant' => 'Infant'] as $key => $type) {
    //         if ($policy->$key != null) {
    //             for ($i = 1; $i <= $policy->$key; $i++) {
    //                 $name = $type . $i;
    //                 $attr[] = $name;
    //                 $labels[$name] = ucwords(Yii::t('app', "$type Passport (#" . ($i) . ")"));
    //             }
    //         }
    //     }

    //     $model = new \yii\base\DynamicModel($attr);
    //     $model->setAttributeLabels($labels);
    //     $model->addRule($attr, 'required');

    //     $savedFiles = [];
    //     $errorMessages = [];

    //     if ($model->load(Yii::$app->request->post()) && $policy->load(Yii::$app->request->post())) {
    //         $policy->save();
    //         $allFilesProcessed = true;

    //         foreach ($attr as $item) {
    //             $files = UploadedFile::getInstances($model, $item);
    //             foreach ($files as $file) {
    //                 if ($file !== null) {
    //                     $fileName = $file->baseName . '.' . time() . '.' . $file->extension;
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
    //                             $errorMessages[$item][] = $json_request['error']['message'] . ' (File: ' . $fileName . ')';
    //                             $allFilesProcessed = false;
    //                             continue;
    //                         }

    //                         if ($json_request['verification']['passed']) {
    //                             $dob = $json_request['result']['dob'] ?? "null";
    //                             $dobDate = new DateTime($dob);
    //                             $now = new DateTime();
    //                             $age = $now->diff($dobDate)->y;

    //                             if ((strpos($item, 'Adult') !== false && $age < 18) ||
    //                                 (strpos($item, 'Child') !== false && $age >= 18)) {
    //                                 $errorMessages[$item][] = 'The uploaded document does not match the passenger type. Age: ' . $age . '. The document was uploaded for: ' . $item . '. Please ensure that the document is appropriate for the passenger\'s age group (Adult, Child, or Infant).';
    //                                 $allFilesProcessed = false;
    //                                 continue;
    //                             }

    //                             $existingRecord = PolicyDraftPassengers::find()
    //                                 ->where(['draft_id' => $policy->id])
    //                                 ->andWhere([
    //                                     'first_name' => $json_request['result']['firstName'] ?? "null",
    //                                     'middle_name' => $json_request['result']['middleName'] ?? "null",
    //                                     'last_name' => $json_request['result']['lastName'] ?? "null"
    //                                 ])
    //                                 ->one();

    //                             if ($existingRecord === null) {
    //                                 // Update the counts of remaining passengers
    //                                 if (strpos($item, 'Adult') !== false) {
    //                                     $policy->adult--;
    //                                 } elseif (strpos($item, 'Child') !== false) {
    //                                     $policy->children--;
    //                                 } elseif (strpos($item, 'Infant') !== false) {
    //                                     $policy->infant--;
    //                                 }

    //                                 $policy->save();
    //                                 $PolicyDraftPassengers = new PolicyDraftPassengers();
    //                                 $PolicyDraftPassengers->draft_id = $policy->id;
    //                                 $PolicyDraftPassengers->id_number = $json_request['result']['documentNumber'] ?? "null";
    //                                 $PolicyDraftPassengers->first_name = $json_request['result']['firstName'] ?? "null";
    //                                 $PolicyDraftPassengers->middle_name = $json_request['result']['middleName'] ?? "null";
    //                                 $PolicyDraftPassengers->last_name = $json_request['result']['lastName'] ?? "null";
    //                                 $PolicyDraftPassengers->dob = $dob;
    //                                 $PolicyDraftPassengers->id_type = $json_request['result']['documentType'] ?? "null";
    //                                 $PolicyDraftPassengers->country = $json_request['result']['issuerOrg_iso2'] ?? "null";
    //                                 $PolicyDraftPassengers->nationality = $json_request['result']['nationality_iso2'] ?? "null";
    //                                 $PolicyDraftPassengers->gender = ($json_request['result']['sex'] ?? "null") === 'M' ? 'Male' : 'Female';
    //                                 $PolicyDraftPassengers->id_type = ($json_request['result']['documentType'] ?? "null") === 'P' ? 'Passport' : $PolicyDraftPassengers->id_type;
    //                                 $PolicyDraftPassengers->warning = isset($json_request['authentication']['warning']) ? implode(',', $json_request['authentication']['warning']) : "null";
    //                                 $PolicyDraftPassengers->document_link = '/uploads/' . $fileName;
    //                                 $PolicyDraftPassengers->save();

    //                                 $savedFiles[] = $PolicyDraftPassengers;
    //                             } else {
    //                                 $errorMessages[$item][] = 'A document for this person already exists. You cannot upload another document for the same person. Please try with a different person or document.';
    //                                 $allFilesProcessed = false;
    //                                 continue;
    //                             }
    //                         } else {
    //                             $errorMessages[$item][] = 'Failed to process the document for: ' . $item . '. Please try again.';
    //                             $allFilesProcessed = false;
    //                             continue;
    //                         }
    //                     } else {
    //                         $errorMessages[$item][] = 'Failed to save file: ' . $file->name;
    //                         $allFilesProcessed = false;
    //                         continue;
    //                     }
    //                 }
    //             }
    //         }

    //         if ($allFilesProcessed || !empty($passengers)) {
    //             return $this->redirect(['review', 'draft' => base64_encode($policy->id), 'passengers' => base64_encode($passengers)]);
    //         }

    //         if (!empty($errorMessages)) {
    //             $errorMessage = '';
    //             foreach ($errorMessages as $item => $messages) {
    //                 $label = isset($labels[$item]) ? $labels[$item] : $item;
    //                 $errorMessage .= 'Errors for ' . $label . ':<br>' . implode('<br>', $messages) . '<br><br>';
    //             }
    //             Yii::$app->session->setFlash('warning', $errorMessage);
    //         }
    //     }


    //     $savedFiles = PolicyDraftPassengers::find()
    //         ->where(['draft_id' => $policy->id])
    //         ->all();


    //     $remainingAttributes = [
    //         'adult' => max($originalAdults - count($savedFiles), 0),
    //         'children' => max($originalChildren - count($savedFiles), 0),
    //         'infant' => max($originalInfants - count($savedFiles), 0),
    //     ];

    //     $attr = [];
    //     $labels = [];
    //     foreach ($remainingAttributes as $type => $count) {
    //         if ($count > 0) {
    //             for ($i = 1; $i <= $count; $i++) {
    //                 $name = ucfirst($type) . $i;
    //                 $attr[] = $name;
    //                 $labels[$name] = ucwords(Yii::t('app', ucfirst($type) . " Passport (#" . ($i) . ")"));
    //             }
    //         }
    //     }

    //     $model = new \yii\base\DynamicModel($attr);
    //     $model->setAttributeLabels($labels);
    //     $model->addRule($attr, 'required');

    //     return $this->render('/insurance/passengers', [
    //         'model' => $model,
    //         'policy' => $policy,
    //         'savedFiles' => $savedFiles
    //     ]);
    // }

    // public function actionDeleteFile()
    // {
    //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    //     $id = Yii::$app->request->post('id');
    //     $record = PolicyDraftPassengers::findOne($id);

    //     if (!$record) {
    //         return ['error' => 'Record not found'];
    //     }


    //     $filePath = Yii::getAlias('@webroot') . $record->document_link;


    //     if (!file_exists($filePath)) {

    //         $correctedFilePath = $filePath . '.jpg';
    //         if (!file_exists($correctedFilePath)) {
    //             return [
    //                 'error' => 'File does not exist',
    //                 'filePath' => $filePath
    //             ];
    //         }

    //         $filePath = $correctedFilePath;
    //     }

    //     if (unlink($filePath)) {
    //         $dob = new DateTime($record->dob);
    //         $now = new DateTime();
    //         $age = $now->diff($dob)->y;

    //         $policyDraft = PolicyDraft::find()->where(['id' => $record->draft_id])->one();
    //         if ($age > 18) {
    //             $policyDraft->adult++;
    //         } else {
    //             $policyDraft->children++;
    //         }

    //         $policyDraft->save();

    //         $record->delete();

    //         return ['success' => true];
    //     }

    //     return ['success' => false];
    // }

    public function actionDeleteFile()
    {
        $id = Yii::$app->request->post('id');
        $record = PolicyDraftPassengers::findOne($id);
        $draft = PolicyDraft::findOne($record->draft_id);
        if (!$record) {
            Yii::$app->session->setFlash('error', 'Record not found');
            return $this->redirect(['passengers', 'draft' => base64_encode($draft->id)]);
        }

        $filePath = Yii::getAlias('@webroot') . $record->document_link;

        if (!file_exists($filePath)) {
            $correctedFilePath = $filePath . '.jpg';
            if (!file_exists($correctedFilePath)) {
                Yii::$app->session->setFlash('error', 'File does not exist');
                return $this->redirect(['passengers', 'draft' => base64_encode($draft->id)]);
            }

            $filePath = $correctedFilePath;
        }

        if (unlink($filePath)) {
            $dob = new DateTime($record->dob);
            $now = new DateTime();
            $age = $now->diff($dob)->y;

            $policyDraft = PolicyDraft::findOne($record->draft_id);
            if ($age > 18) {
                $policyDraft->adult++;
            } else {
                $policyDraft->children++;
            }

            $policyDraft->save();

            $record->delete();
            Yii::$app->session->setFlash('success', 'File deleted successfully');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to delete the file');
        }

        return $this->redirect(['passengers', 'draft' => base64_encode($draft->id)]);
    }


    // public function actionReview($draft)
    // {
    //     $policy = PolicyDraft::findOne($draft);
    //     // dd($policy);
    //     return $this->render('/insurance/review', [
    //         'policy' => $policy,
    //     ]);
    // }



    // public function actionReview($draft)
    // {
    //     $decodedDraft = base64_decode($draft);
    //     $policy = PolicyDraft::findOne($decodedDraft);

    //     if (!$policy) {
    //         Yii::$app->session->setFlash('error', 'Policy draft not found.');
    //     }


    //     $model = new \yii\base\DynamicModel(['file']);

    //     return $this->render('/insurance/review', [
    //         'policy' => $policy,
    //         'model' => $model,
    //     ]);
    // }





    // public function actionRetake($id, $policyId)
    // {



    //     $id = base64_decode($id);
    //     $policyId = base64_decode($policyId);
    //     $policy = PolicyDraft::findOne($policyId);

    //     $model = new \yii\base\DynamicModel(['file']);
    //     $model->addRule(['file'], 'required');

    //     if ($policy === null) {
    //         throw new \yii\web\NotFoundHttpException('The requested policy draft does not exist.');
    //     }

    //     $passengerdraft = PolicyDraftPassengers::find()->where(['id' => $id])->one();




    //     if ($model->load(Yii::$app->request->post())) {


    //         $file = UploadedFile::getInstance($model, 'file');

    //         if ($file) {
    //             $fileName = time() . '_' . $file->baseName . '.' . $file->extension;
    //             $path = Yii::getAlias('@webroot/uploads/') . $fileName;

    //             if ($file->saveAs($path)) {

    //                 $post = [
    //                     'file_base64' => base64_encode(file_get_contents($path)),
    //                     'apikey' => 'pS2xHPtEAwqbspQBxFBYKpFIO54pqwNg',
    //                     'authenticate' => true,
    //                     'authenticate_module' => 2,
    //                     'verify_expiry' => true,
    //                     'type' => "IPD"
    //                 ];

    //                 $ch = curl_init();
    //                 curl_setopt($ch, CURLOPT_URL, 'https://api.idanalyzer.com');
    //                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //                 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    //                 $response = curl_exec($ch);
    //                 curl_close($ch);

    //                 $json_request = json_decode($response, true);

    //                 if (isset($json_request['error'])) {
    //                     Yii::$app->session->setFlash('error', 'Error processing the file.');
    //                 } elseif ($json_request['verification']['passed']) {
    //                     // dd(    $passengerdraft);
    //                     $passengerdraft->delete();
    //                     // if ($passengerdraft !== []) {
    //                     //     if ($passengerdraft->delete() !== false) {
    //                     //         Yii::$app->session->setFlash('success', 'Draft record deleted successfully.');
    //                     //     } else {
    //                     //         Yii::$app->session->setFlash('error', 'Failed to delete the draft record.');
    //                     //     }
    //                     // } else {
    //                     //     Yii::$app->session->setFlash('error', 'No draft record found.');
    //                     // }
    //                     $dob = $json_request['result']['dob'] ?? "null";
    //                     $dobDate = new \DateTime($dob);
    //                     $now = new \DateTime();
    //                     $age = $now->diff($dobDate)->y;


    //                     $passenger = new PolicyDraftPassengers();
    //                     $passenger->draft_id = $policy->id;
    //                     $passenger->id_number = $json_request['result']['documentNumber'] ?? "null";
    //                     $passenger->first_name = $json_request['result']['firstName'] ?? "null";
    //                     $passenger->middle_name = $json_request['result']['middleName'] ?? "null";
    //                     $passenger->last_name = $json_request['result']['lastName'] ?? "null";
    //                     $passenger->dob = $dob;
    //                     $passenger->id_type = $json_request['result']['documentType'] ?? "null";
    //                     $passenger->country = $json_request['result']['issuerOrg_iso2'] ?? "null";
    //                     $passenger->nationality = $json_request['result']['nationality_iso2'] ?? "null";
    //                     $passenger->gender = ($json_request['result']['sex'] ?? "null") === 'M' ? 'Male' : 'Female';
    //                     $passenger->id_type = ($json_request['result']['documentType'] ?? "null") === 'P' ? 'Passport' : $passenger->id_type;
    //                     $passenger->warning = isset($json_request['authentication']['warning']) ? implode(',', $json_request['authentication']['warning']) : "null";
    //                     $passenger->document_link = '/uploads/' . $fileName;
    //                     $passenger->save();

    //                     // dd($passengerdraft);



    //                     Yii::$app->session->setFlash('success', 'Document has been updated successfully.');
    //                 }
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Document verification failed.');
    //             }
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Failed to save file.');
    //         }
    //     } else {
    //         Yii::$app->session->setFlash('error', 'No file uploaded.');
    //     }



    //     return $this->redirect(['review', 'draft' => base64_encode($policy->id)]);
    // }





    // public function actionReview($draft, $id = null)
    // {
    //     $decodedDraft = base64_decode($draft);
    //     $policy = PolicyDraft::findOne($decodedDraft);

    //     // if (!$policy) {
    //     //     Yii::$app->session->setFlash('error', 'Policy draft not found.');
    //     // }

    //     $model = new \yii\base\DynamicModel(['file']);

    //     if ($id !== null) {

    //         $id = base64_decode($id);
    //         $passengerdraft = PolicyDraftPassengers::findOne($id);

    //         // if (!$passengerdraft) {
    //         //     Yii::$app->session->setFlash('error', 'Passenger draft not found.');
    //         //     return $this->redirect(['review', 'draft' => base64_encode($policy->id)]);
    //         // }

    //         $model->addRule(['file'], 'required');

    //         if ($model->load(Yii::$app->request->post())) {
    //             $file = UploadedFile::getInstance($model, 'file');
    //             if ($file) {
    //                 $fileName = time() . '_' . $file->baseName . '.' . $file->extension;
    //                 $path = Yii::getAlias('@webroot/uploads/') . $fileName;

    //                 if ($file->saveAs($path)) {

    //                     $post = [
    //                         'file_base64' => base64_encode(file_get_contents($path)),
    //                         'apikey' => 'pS2xHPtEAwqbspQBxFBYKpFIO54pqwNg',
    //                         'authenticate' => true,
    //                         'authenticate_module' => 2,
    //                         'verify_expiry' => true,
    //                         'type' => "IPD"
    //                     ];

    //                     $ch = curl_init();
    //                     curl_setopt($ch, CURLOPT_URL, 'https://api.idanalyzer.com');
    //                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //                     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    //                     $response = curl_exec($ch);
    //                     curl_close($ch);

    //                     $json_request = json_decode($response, true);

    //                     if (isset($json_request['error'])) {
    //                         Yii::$app->session->setFlash('error', 'Error processing the file.');
    //                     } elseif ($json_request['verification']['passed']) {

    //                         if ($passengerdraft !== null) {

    //                             $passengerdraft->delete();

    //                         }

    //                         $dob = $json_request['result']['dob'] ?? "null";
    //                         $dobDate = new \DateTime($dob);
    //                         $now = new \DateTime();
    //                         $age = $now->diff($dobDate)->y;

    //                         $passenger = new PolicyDraftPassengers();
    //                         $passenger->draft_id = $policy->id;
    //                         $passenger->id_number = $json_request['result']['documentNumber'] ?? "null";
    //                         $passenger->first_name = $json_request['result']['firstName'] ?? "null";
    //                         $passenger->middle_name = $json_request['result']['middleName'] ?? "null";
    //                         $passenger->last_name = $json_request['result']['lastName'] ?? "null";
    //                         $passenger->dob = $dob;
    //                         $passenger->id_type = $json_request['result']['documentType'] ?? "null";
    //                         $passenger->country = $json_request['result']['issuerOrg_iso2'] ?? "null";
    //                         $passenger->nationality = $json_request['result']['nationality_iso2'] ?? "null";
    //                         $passenger->gender = ($json_request['result']['sex'] ?? "null") === 'M' ? 'Male' : 'Female';
    //                         $passenger->id_type = ($json_request['result']['documentType'] ?? "null") === 'P' ? 'Passport' : $passenger->id_type;
    //                         $passenger->warning = isset($json_request['authentication']['warning']) ? implode(',', $json_request['authentication']['warning']) : "null";
    //                         $passenger->document_link = '/uploads/' . $fileName;
    //                         $passenger->save();

    //                         Yii::$app->session->setFlash('success', 'Document has been updated successfully.');
    //                         return $this->render('/insurance/review', [
    //                             'policy' => $policy,
    //                             'model' => $model,
    //                         ]);
    //                         // return $this->redirect(['review', 'draft' => base64_encode($policy->id)]);
    //                     } else {
    //                         Yii::$app->session->setFlash('error', 'Document verification failed.');
    //                     }
    //                 } else {
    //                     Yii::$app->session->setFlash('error', 'Failed to save file.');
    //                 }
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'No file uploaded.');
    //             }
    //         }
    //     }

    //     return $this->render('/insurance/review', [
    //         'policy' => $policy,
    //         'model' => $model,
    //     ]);
    // }


    public function actionReview($draft, $id = null)
    {
        $decodedDraft = base64_decode($draft);
        $policy = PolicyDraft::findOne($decodedDraft);
        $policy->setScenario('update');


        $model = new \yii\base\DynamicModel(['file']);

        if ($id !== null) {

            $id = base64_decode($id);
            $passengerdraft = PolicyDraftPassengers::findOne($id);

            $model->addRule(['file'], 'required');

            if ($model->load(Yii::$app->request->post())) {
                $file = UploadedFile::getInstance($model, 'file');
                if ($file) {
                    $fileName = time() . '_' . $file->baseName . '.' . $file->extension;
                    $path = Yii::getAlias('@webroot/uploads/') . $fileName;

                    if ($file->saveAs($path)) {

                        $post = [
                            'file_base64' => base64_encode(file_get_contents($path)),
                            'apikey' => 'pS2xHPtEAwqbspQBxFBYKpFIO54pqwNg',
                            'authenticate' => true,
                            'authenticate_module' => 2,
                            'verify_expiry' => true,
                            'type' => "IPD"
                        ];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://api.idanalyzer.com');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
                        $response = curl_exec($ch);
                        curl_close($ch);

                        $json_request = json_decode($response, true);

                        if (isset($json_request['error'])) {
                            Yii::$app->session->setFlash('error', 'Error processing the file.');
                        } elseif ($json_request['verification']['passed']) {

                            $dob = $json_request['result']['dob'] ?? "null";
                            $dobDate = new \DateTime($dob);
                            $now = new \DateTime();
                            $age = $now->diff($dobDate)->y;

                            if ($passengerdraft !== null) {

                                $passengerdraft->id_number = $json_request['result']['documentNumber'] ?? "null";
                                $passengerdraft->first_name = $json_request['result']['firstName'] ?? "null";
                                $passengerdraft->middle_name = $json_request['result']['middleName'] ?? "null";
                                $passengerdraft->last_name = $json_request['result']['lastName'] ?? "null";
                                $passengerdraft->dob = $dob;
                                $passengerdraft->id_type = $json_request['result']['documentType'] ?? "null";
                                $passengerdraft->country = $json_request['result']['issuerOrg_iso2'] ?? "null";
                                $passengerdraft->nationality = $json_request['result']['nationality_iso2'] ?? "null";
                                $passengerdraft->gender = ($json_request['result']['sex'] ?? "null") === 'M' ? 'Male' : 'Female';
                                $passengerdraft->id_type = ($json_request['result']['documentType'] ?? "null") === 'P' ? 'Passport' : $passengerdraft->id_type;
                                $passengerdraft->warning = isset($json_request['authentication']['warning']) ? implode(',', $json_request['authentication']['warning']) : "null";
                                $passengerdraft->document_link = '/uploads/' . $fileName;

                                if ($passengerdraft->save()) {
                                    Yii::$app->session->setFlash('success', 'Document has been updated successfully.');
                                } else {
                                    Yii::$app->session->setFlash('error', 'Failed to update the passenger draft.');
                                }
                            } else {
                                Yii::$app->session->setFlash('error', 'Passenger draft not found.');
                            }

                            return $this->render('/insurance/review', [
                                'policy' => $policy,
                                'model' => $model,
                            ]);
                        } else {
                            Yii::$app->session->setFlash('error', 'Document verification failed.');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to save file.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'No file uploaded.');
                }
            }
        }

        return $this->render('/insurance/review', [
            'policy' => $policy,
            'model' => $model,
            // 'modelPayment'=>$modelPayment
        ]);
    }

    public function actionCheck()
    {





        $model = new \yii\base\DynamicModel(['mobile', 'reCaptcha']);
        $model->addRule(['mobile'], PhoneInputValidator::class);

        $model->addRule(['mobile'], 'required', ['message' => 'Mobile number cannot be blank.']);

        $model->addRule(['mobile'], 'number');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $mobile = $model->mobile;

            // dd($mobile);
            $customer = Customers::findOne(['mobile' => $mobile]);

            if ($customer) {

                $sessionData = Yii::$app->session->get('session_data', []);

                $lastResendTimestamp = $sessionData['last_resend_timestamp'] ?? 0;
                $currentTimestamp = time();
                $interval = 5 * 60;

                if ($lastResendTimestamp && ($currentTimestamp - $lastResendTimestamp < $interval)) {
                    $remainingTime = $interval - ($currentTimestamp - $lastResendTimestamp);
                    Yii::$app->session->setFlash('info', "Please wait " . intval($remainingTime / 60) . "m " . ($remainingTime % 60) . "s before requesting a new OTP.");
                    return $this->render('/insurance/policy', ['model' => $model]);
                }


                $response = $this->actionSend($mobile);
                $responseData = json_decode($response, true);

                if ($responseData && $responseData['status'] == 201) {

                    $lastResendTimestamp = 5 * 60;
                    $sessionData = Yii::$app->session->get('session_data', []);
                    // $uniqueId = Yii::$app->session->get('session_data', [])['customer_id'];
                    if (isset($sessionData['customer_id'])) {
                        Yii::$app->session->remove('session_data');
                    } 
                    return $this->redirect(['verify-otp', 'mobile' =>$mobile]);
         
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to send OTP.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Mobile number not found.');
            }
        }

        return $this->render('/insurance/policy', ['model' => $model]);
    }


    public function actionResend($mobile)
    {
        $sessionData = Yii::$app->session->get('session_data', []);
        $lastResendTimestamp = $sessionData['last_resend_timestamp'] ?? 0;
        $currentTimestamp = time();
        $interval = 5 * 60;

        if ($lastResendTimestamp && ($currentTimestamp - $lastResendTimestamp < $interval)) {
            Yii::$app->session->setFlash('error', 'You can only resend OTP every 5 minutes.');
            return $this->redirect(['verify-otp', 'mobile' =>$mobile]);
        }

        $this->actionSession();
        $uniqueId = Yii::$app->session->get('session_data', []);

        $sessionData['mobile_resend']=$mobile;
        $sessionData['last_resend_timestamp']=$currentTimestamp;
        $sessionData['customer_id']=$uniqueId['customer_id'];

        Yii::$app->session->set('session_data', $sessionData);
        $response = $this->actionSend($mobile);
        $responseData = json_decode($response, true);

        if ($responseData && $responseData['status'] == 201) {
            // Yii::$app->session->set('mobile', $mobile);
            return $this->redirect(['verify-otp', 'mobile' =>$mobile]);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to send OTP.');
        }

        return $this->redirect(['verify-otp', 'mobile' =>$mobile]);
    }




    public function actionSend($mobile)
    {
        $curl = curl_init();
        $from = "360TVLCARE";
        $message = "Hello from Releans API";

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.releans.com/v2/otp/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "sender=$from&mobile=$mobile&content=$message",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer
                 eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImMwMzEzZjgxLTE3Y2QtNGMxMC1iY2Y1LTllYWYyMmQyYzg5ZiIsImlhdCI6MTczMzY2Mzk5NiwiaXNzIjoxOTQ3OH0.JHAzoFErO6Ii8r38Qwt2JkZovNelikVVP7FqzxR6RwM"
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            Yii::$app->session->setFlash('error', 'Curl error: ' . $error);
            return json_encode(['status' => 500, 'message' => 'Curl error']);
        }

        return $response;
    }


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

    //             // $sessionData = Yii::$app->session->get('session_data', []);
    //             // $lastResendTimestamp = $sessionData['last_resend_timestamp'] ?? 0;
    //             if (isset($responseData['status']) && $responseData['status'] == 200) {
    //                 // Yii::$app->session->setFlash('success', 'OTP verified successfully.');
    //                 // Yii::$app->session->remove('mobile');
    //                 // $lastResendTimestamp = 5 * 60;
    //                 // Yii::$app->session->remove(
    //                 //     'session_data'[0],
    //                 //     'last_resend_timestamp',

    //                 // );

    //                 return $this->redirect(['display-policy']);
    //             } else {
    //                 Yii::$app->session->setFlash('error', 'Failed to verify OTP.');
    //             }
    //         }
    //     }

    //     return $this->render('/insurance/verify-otp', [
    //         'model' => $model,
    //         'mobile' => $mobile
    //     ]);
    // }

    public function actionVerifyOtp($mobile)
    {
        $model = new \yii\base\DynamicModel(['otp']);
        $model->addRule(['otp'], 'required');
        if ($model->load(Yii::$app->request->post())) {
            $otpArray = Yii::$app->request->post('DynamicModel')['otp'];
            $model->otp = implode('', $otpArray);

            if ($model->validate()) {
                $otp = $model->otp;
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://api.releans.com/v2/otp/check",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "mobile=$mobile&code=$otp",
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImMwMzEzZjgxLTE3Y2QtNGMxMC1iY2Y1LTllYWYyMmQyYzg5ZiIsImlhdCI6MTczMzY2Mzk5NiwiaXNzIjoxOTQ3OH0.JHAzoFErO6Ii8r38Qwt2JkZovNelikVVP7FqzxR6RwM"
                    ],
                ]);

                $response = curl_exec($curl);
                curl_close($curl);

                $responseData = json_decode($response, true);

                if (isset($responseData['status']) && $responseData['status'] == 200) {
                    // $sessionData = Yii::$app->session->get('session_data', []);
                    // $sessionData['last_resend_timestamp'] = time() + (5 * 60) + 10;
                    // Yii::$app->session->set('session_data', $sessionData);
                    // dd(    $sessionData );
                    $sessionData = Yii::$app->session->get('session_data', []);
                    // $uniqueId = Yii::$app->session->get('session_data', [])['customer_id'];
                    if (isset($sessionData['customer_id'])) {
                        Yii::$app->session->remove('session_data');
                    } 
                    // Yii::$app->session->set('refresh', "shatha");
                    return $this->redirect(['display-policy', 'policyIds' => null, 'id' => null,'mobile'=>$mobile]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to verify OTP.');
                }
            }
        }

        return $this->render('/insurance/verify-otp', [
            'model' => $model,
            'mobile' => $mobile
        ]);
    }


    public function actionRemoveRefreshSession()
    {
        Yii::$app->session->remove('refresh');
        return 'success';
    }



    public function actionContact()
    {

        $model = new \yii\base\DynamicModel(['name', 'email', 'message', 'mobile']);
        $model->addRule(['name', 'email', 'message', 'mobile'], 'required')
            ->addRule('email', 'email');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // dd( $model);
            $email = filter_var($model->email, FILTER_VALIDATE_EMAIL) ? $model->email : 'no-reply@example.com';
            $name = !empty($model->name) ? $model->name : 'Unknown';
            $message = $model->message;
            $mobile = $model->mobile;
            Yii::$app->mailer->compose()
                ->setTo('shatha.rababah@releans.com')
                ->setFrom([$email => $name])
                ->setSubject('Contact Form Submission')
                ->setHtmlBody('<b>Hay</b>' . $name . '</br>' . $message . '<br>' . $mobile)
                ->send();
            Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            return $this->refresh();
        }

        return $this->render('/insurance/contact', [
            'model' => $model,
        ]);
    }


    public function actionTerms()
    {
        return $this->render('/insurance/about');
    }


    public function actionPaymentMethod($id)
    {

        $id = base64_decode($id);
        $policy = PolicyDraft::findOne($id);
        $model = new \yii\base\DynamicModel(['mobile']);
        $model->addRule(['mobile'], 'required');
        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['payment', 'id' => base64_encode($policy->id),'method'=>'alawneh']);
        }
        return $this->render('/insurance/paymentmethod', [
            'model' =>  $model,
            'policy' => $policy
        ]);
    }

    // public function actionDisplayPolicy($policyId = null, $id = null)
    // {




    //     $decodedPolicy = base64_decode($policyId);
    //     $id = base64_decode($id);
    //     $request = Yii::$app->request;
    //     $policyDraft = $request->get('policyDraft');

    //     $mobile = Yii::$app->session->get('mobile');
    //     $customer = Customers::findOne(['mobile' => $mobile]);

    //     if ($customer) {
    //         $policies = Policy::find()->where(['customer_id' => $customer->id])->all();
    //     } else {
    //         $policies = [];
    //     }

    //     if ($decodedPolicy) {
    //         $policy = Policy::findOne($decodedPolicy);
    //         return $this->render('/insurance/display-policy', [
    //             'policies' => [$policy],
    //             'policyDraft' => $policyDraft,
    //             'id' => $id
    //         ]);
    //     }

    //     return $this->render('/insurance/display-policy', [
    //         'policies' => $policies,
    //         'policyDraft' => $policyDraft,
    //         'id' => $id
    //     ]);
    // }
    public function actionDisplayPolicy($policyIds = null, $id = null,$mobile=null)
    {

        $decodedPolicyIds = array_map('base64_decode', explode(',', $policyIds));
        $id = base64_decode($id);
        $request = Yii::$app->request;
        $policyDraft = $request->get('policyDraft');

        // $mobile = Yii::$app->session->get('mobile');
        $customer = Customers::findOne(['mobile' => $mobile]);

        if ($customer) {

            $policies = Policy::find()->where(['customer_id' => $customer->id])->orderBy(['created_at' => SORT_DESC])->all();
        } else {
            $policies = [];
        }






        if (is_array($decodedPolicyIds) && !empty($decodedPolicyIds) && array_filter($decodedPolicyIds)) {
            $policies = Policy::find()->where(['id' => $decodedPolicyIds])->orderBy(['created_at' => SORT_DESC])->all();
            return $this->render('/insurance/display-policy', [
                'policies' => $policies,
                'policyDraft' => $policyDraft,
                'id' => $id,
                'customer'=>$customer
            ]);
        }




        return $this->render('/insurance/display-policy', [
            'policies' => $policies,
            'policyDraft' => $policyDraft,
            'id' => $id,
            'customer'=>$customer
        ]);
    }


    // public function actionPayment($id)
    // {
    //     $policyDraft = PolicyDraft::findOne($id);
    //     $passenger = PolicyDraftPassengers::find()->where(['draft_id' => $id])->one();
    //     if ($policyDraft === null) {
    //         throw new NotFoundHttpException('The requested policy does not exist.');
    //     }

    //     // $model = new \yii\base\DynamicModel(['number', 'expmonth', 'expyear', 'cvv', 'price']);
    //     // $model->addRule(['number', 'expmonth', 'expyear', 'cvv', 'price'], 'required')
    //     //     ->addRule(['number'], 'string', ['length' => 16])
    //     //     ->addRule(['cvv'], 'string', ['length' => [3, 4]])
    //     //     ->addRule(['expmonth', 'expyear'], 'integer');

    //     // $model->price = $policyDraft->price;

    //     // if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //     $paymentData = [
    //         'name' => $passenger->first_name . ' ' . $passenger->last_name,
    //         'phone' => $policyDraft->mobile,
    //         'country' => $passenger->nationality,
    //         'ip' => '20002',
    //         'email' => $policyDraft->email,
    //         'price' => $policyDraft->price
    //     ];


    //     $response = $this->processPayment($paymentData, $policyDraft, $passenger);
    //     return $this->redirect($response);


    //     // }

    //     // return $this->render('/insurance/payment', [
    //     //     'model' => $model,
    //     //     'policy' => $policyDraft,
    //     // ]);
    // }

    // public function actionPaymentCallback($policyDraft1, $passenger1)
    // // {   dd("shathsa");
    // {
    //     // dd("sh")
    //     $policyDraft = PolicyDraft::find()->where(['id' => $policyDraft1])->one();
    //     $passenger = PolicyDraftPassengers::find()->where(['id' => $passenger1])->one();


    //     $postData = Yii::$app->request->post();
    //     if (isset($postData['respStatus']) && $postData['respStatus'] === 'A') {
    //         $fromCountryName = $this->getCountryName($policyDraft->DepartCountryCode);
    //         $toCountryName = $this->getCountryName($policyDraft->ArrivalCountryCode);

    //         $response = $postData['tranRef'];

    //         if (isset($response) && !empty($response)) {
    //             $apiEndpoint = 'https://tuneprotectjo.com/api/policies';
    //             $apiKey = 'eyJhbGciOiJIUzI1NiJ9.eyJpZCI6IjJlMzM3YmM2LWFmMzMtNDFjNS04ZTM2LWQ2NzJjMWRjNDYyNSIsImlhdCI6IjIwMjQtMDctMDQiLCJpc3MiOjE4M30.jdsWqHcU0cL4ZHKr0oZYBvamRrpYwvfCARitiBTVzqU';



    //             $departureDate = new DateTime($policyDraft->departure_date);
    //             $returnDate = new DateTime($policyDraft->return_date);
    //             $interval = $departureDate->diff($returnDate);
    //             $days = $interval->days;
    //             $dob = new DateTime($passenger->dob);
    //             $now = new DateTime();
    //             $age = $now->diff($dob)->y;

    //             $apiPayload = [
    //                 "source" => $fromCountryName,
    //                 "from_country" => $fromCountryName,
    //                 "from_airport" => $policyDraft->from_airport,
    //                 "to_country" => $toCountryName,
    //                 "to_airport" => $policyDraft->going_to,
    //                 "departure_date" => $policyDraft->departure_date,
    //                 "days" => $days + 1,
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

    //             $ch = curl_init($apiEndpoint);
    //             curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //                 'Authorization: Bearer ' . $apiKey,
    //                 'Content-Type: application/json',
    //             ]);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiPayload));

    //             $apiResponse = curl_exec($ch);
    //             $apiResponseData = json_decode($apiResponse, true);

    //             if (curl_errno($ch)) {
    //                 Yii::$app->session->setFlash('error', 'Failed to communicate with the policy API.');
    //                 curl_close($ch);
    //                 return $this->redirect(['error-page']);
    //             }
    //             curl_close($ch);

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

    //                 $id = $apiResponseData['id'];
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
    //                 $policy->ProposalState = $apiResponseData['ProposalState'] ?? 'Proposal State';
    //                 $policy->ItineraryID = $id;
    //                 $policy->PNR = $apiResponseData['PNR'] ?? '';
    //                 $policy->PolicyNo = $apiResponseData['PolicyNo'] ?? '';
    //                 $policy->PolicyPurchasedDateTime = $apiResponseData['PolicyPurchasedDateTime'] ?? date('Y-m-d H:i:s');
    //                 $policy->PolicyURLLink = $apiResponseData['PolicyURLLink'] ?? '';
    //                 $policy->status = $apiResponseData['status'] ?? 0;
    //                 $policy->status_description = $apiResponseData['status_description'] ?? 'Status Description';

    //                 if ($policy->save()) {
    //                     Yii::$app->queue->delay(5)->push(new \common\jobs\PolicyStatusCheckJob([
    //                         'id' => $id,
    //                         'policyId' => $policy->id
    //                     ]));
    //                     return $this->redirect(['display-policy', 'policyId' => $policy->id]);
    //                 } else {
    //                     Yii::$app->session->setFlash('error', 'Failed to save the policy.');
    //                 }
    //             } else {
    //                 $errorMessage = $apiResponseData['error'] ?? 'Policy purchase failed. Please try again.';
    //                 Yii::$app->session->setFlash('error', $errorMessage);
    //             }
    //         } else {
    //             $errorMessage = $postData['message'] ?? 'Payment failed. Please try again.';
    //             Yii::$app->session->setFlash('error', $errorMessage);
    //         }
    //     }
    //     $errorMessage = $postData['message'] ?? 'Payment failed. Please try again.';
    //     Yii::$app->session->setFlash('error', $errorMessage);
    //     // dd( $policyDraft);
    //     // $url = Yii::$app->urlManager->createAbsoluteUrl([

    //     // ]);

    //     return $this->redirect([
    //         'asurance/review',
    //         'draft' => $policyDraft
    //     ]);
    // }


    // protected function processPayment($data, $policyDraft, $passenger)
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
    //         'callback' => Yii::$app->urlManager->createAbsoluteUrl(['asurance/check']),


    //         // 'return' => Yii::$app->urlManager->createAbsoluteUrl(['asurance/payment-callback',array('policyDraft' => $policyDraft, 'passenger' => $passenger),  'protocol' => 'https' ]),
    //         'return' => Yii::$app->urlManager->createAbsoluteUrl([
    //             'asurance/payment-callback',
    //             'policyDraft' => $policyDraft->id,
    //             'passenger' => $passenger->id,

    //         ]),
    //         'hide_shipping' => true,

    //         'customer_details' => array(
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //             'phone' => $data['phone'],
    //             'country' => $data['country'],
    //             'ip' => $data['ip'],
    //         )
    //         // 'payment_token' => $data['payment-token'],
    //         // 'expiry_date' => $data['expmonth'] . '/' . $data['expyear'],
    //         // 'cvv' => $data['cvv'],
    //     ];
    //     // dd($paymentPayload);
    //     $headers = [
    //         'Authorization:' . $serverKey,
    //         'Content-Type: application/json',
    //     ];

    //     $ch = curl_init($endpoint);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentPayload));

    //     $response = json_decode(curl_exec($ch));

    //     curl_close($ch);
    //     // dd( $response);

    //     return $response->redirect_url;
    // }


    public function actionPayment($id, $method)
    {
        $id = base64_decode($id);
        $policyDraft = PolicyDraft::findOne($id);

        if ($policyDraft !== null) {

            $policyDraft->paymentmethod = $method;
            $policyDraft->save();
            // $policyDraft->setScenario(PolicyDraft::SCENARIO_UPDATE);

            // if (!$policyDraft->save(false)) {
            //     throw new \Exception('Failed to update policy draft');
            // }
        }

        $passengers = PolicyDraftPassengers::find()->where(['draft_id' => $id])->all();

        if ($policyDraft === null) {
            throw new NotFoundHttpException('The requested policy does not exist.');
        }

        $customer = Customers::findOne(['mobile' => $policyDraft->mobile]);

        if ($customer === null) {

            if ($policyDraft->paymentmethod === "alawneh") {


                return $this->handleNewCustomerPaymentAlawneh($policyDraft, $passengers);
            } else {
                return $this->handleNewCustomerPayment($policyDraft, $passengers);
            }
        } else {
            // dd("shatha");
            return $this->handleExistingCustomerPayment($policyDraft, $passengers, $customer);
        }
    }




    protected function handleNewCustomerPaymentAlawneh($policyDraft, $passengers)
    {
        $response = $this->processPaymentAlawneh($policyDraft, $passengers);

        if (isset($response['success']) && !empty($response['success'])) {
            $this->processPurchase($policyDraft, $passengers);
        } else {
            $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
            Yii::$app->session->setFlash('error', $errorMessage);
        }
    }


    protected function getAlawnehAccessToken()
    {
        $url = 'https://gateway.alawnehpay.com/auth-server/oauth/token';
        $client_id = 'tuneprotect';
        $client_secret = 'TeSuT19Huyc@jiu';


        $credentials = base64_encode($client_id . ':' . $client_secret);
// dd($credentials);
        $headers = [
            'Authorization: Basic ' . $credentials,
            'Content-Type: application/x-www-form-urlencoded',
        ];


        $postData = http_build_query([
            'grant_type' => 'client_credentials',
        ]);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        $data = json_decode($response, true);
       var_dump( $data );
       die();
        if ($httpCode == 200 && isset($data['access_token'])) {
            return $data['access_token'];
        }

        throw new \Exception('Failed to retrieve access token: ' . $response);
    }

    //     protected function processPaymentAlawneh($policyDraft, $passengers)
    //     {

    //         $accessToken = $this->getAlawnehAccessToken();
    //         $url = 'https://gateway-test.alawnehpay.com/businessapi/payments/singlePayment';

    //         $payload = [
    //             "amount" => $policyDraft->price,
    //             "toAlias" => "0790751376",
    //             "purpose" => "TRANSFER_TO_OWN_ACCOUNT",
    //             "channel" => "MOBILE_ONLINE",
    //             "paymentType" => "MONEY_TRANSFER",


    //         ];

    //         $headers = [
    //             'Authorization: Bearer ' . $accessToken,
    //             'Content-Type: application/json',
    //         ];


    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_POST, true);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


    //         $response = curl_exec($ch);
    //         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //         $responseData = json_decode($response, true);

    //         dd( $responseData,$httpCode  );
    //         curl_close($ch);


    //         if ($responseData['success'] == true &&$responseData['data'] =! [] ) {
    //             $responseData = json_decode($response, true);
    //             return $responseData;
    //         } else {


    // $amount = $policyDraft->price; 
    // $url = 'https://gateway.alawnehpay.com/businessapi/qr/' . $amount;

    // $headers = [
    //     'Authorization: Bearer ' . $accessToken,
    //     'Content-Type: application/json',
    // ];

    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // $response = curl_exec($ch);
    // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // $responseData = json_decode($response, true);

    // dd($responseData); 
    // curl_close($ch);

    // $responseData = json_decode($response, true);
    // return $responseData;
    //             // throw new \Exception('Failed to process payment with Alawneh Pay: ' . $response);
    //         }
    //     }




    protected function processPaymentAlawneh($policyDraft, $passengers)
    {
        $accessToken = $this->getAlawnehAccessToken();
        $url = 'https://gateway-test.alawnehpay.com/businessapi/payments/singlePayment';

        $payload = [
            "amount" => $policyDraft->price,
            "toAlias" => "pnorth",
            "purpose" => "TRANSFER_TO_OWN_ACCOUNT",
            "channel" => "MOBILE_ONLINE",
            "paymentType" => "MONEY_TRANSFER",
        ];

        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $responseData = json_decode($response, true);
        curl_close($ch);

        if ($httpCode == 200 && isset($responseData['success']) && $responseData['success'] == true) {

            return $responseData;
        } else {
            $externalId = rand(1, 10000);
            return $this->generateQRCode($policyDraft->price,$externalId, $accessToken);
        }
    }

    protected function generateQRCode($amount, $externalId, $accessToken)
    {
        $url = 'https://gateway-test.alawnehpay.com/businessapi/qr/generate?amount=' . $amount . '&externalId=' . $externalId;

        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $responseData = json_decode($response, true);
        curl_close($ch);
        dd(   $responseData);
        if (isset($responseData['success']) && $responseData['success'] == true) {

            return $responseData;
        } else {
            throw new \Exception('Failed to generate QR code: ' . json_encode($responseData));
        }
    }

    protected function validateQRCode($externalId, $accessToken)
    {
        $url = 'https://gateway.alawnehpay.com/businessapi/qr/validate/' . $externalId;

        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $responseData = json_decode($response, true);
        curl_close($ch);

        if (isset($responseData['success']) && $responseData['success'] == true) {
            // QR Code validated successfully
            return $responseData;
        } else {
            throw new \Exception('Failed to validate QR code: ' . json_encode($responseData));
        }
    }



    protected function handleNewCustomerPayment($policyDraft, $passengers)
    {



        $model = new \yii\base\DynamicModel(['number', 'expmonth', 'expyear', 'cvv', 'price']);
        $model->addRule(['number', 'expmonth', 'expyear', 'cvv', 'price'], 'required')
            ->addRule(['number'], 'string', ['length' => 16])
            ->addRule(['cvv'], 'string', ['length' => [3, 4]])
            ->addRule(['expmonth', 'expyear'], 'integer');

        $model->price = $policyDraft->price;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $paymentData = [
                'number' => $model->number,
                'expmonth' => $model->expmonth,
                'expyear' => $model->expyear,
                'cvv' => $model->cvv,
                'price' => $policyDraft->price,
                'payment-token' => Yii::$app->request->post('payment-token'),
            ];

            $response = $this->processPayment($paymentData);

            if (isset($response['tran_ref']) && !empty($response['tran_ref'])) {
                $this->processPurchase($policyDraft, $passengers);
            } else {
                $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
                Yii::$app->session->setFlash('error', $errorMessage);
            }
        }



        return $this->render('/insurance/payment', [
            'model' => $model,
            'policy' => $policyDraft,
        ]);
    }





    protected function handleExistingCustomerPayment($policyDraft, $passengers, $customer)
    {
        $totalPrice = $policyDraft->price;
        $remainingPrice = $totalPrice - $customer->credit;

        if ($remainingPrice > 0) {

            $model = new \yii\base\DynamicModel(['number', 'expmonth', 'expyear', 'cvv', 'price']);
            $model->addRule(['number', 'expmonth', 'expyear', 'cvv', 'price'], 'required')
                ->addRule(['number'], 'string', ['length' => 16])
                ->addRule(['cvv'], 'string', ['length' => [3, 4]])
                ->addRule(['expmonth', 'expyear'], 'integer');

            $model->price = $remainingPrice;

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $paymentData = [
                    'number' => $model->number,
                    'expmonth' => $model->expmonth,
                    'expyear' => $model->expyear,
                    'cvv' => $model->cvv,
                    'price' => $remainingPrice,
                    'payment-token' => Yii::$app->request->post('payment-token'),
                ];

                $response = $this->processPayment($paymentData);

                if (isset($response['tran_ref']) && !empty($response['tran_ref'])) {

                    $customer->credit = 0;
                    $customer->save(false);
                    $this->processPurchase($policyDraft, $passengers);
                } else {
                    $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
                    Yii::$app->session->setFlash('error', $errorMessage);
                }
            }


            return $this->render('/insurance/payment', [
                'model' => $model,
                'policy' => $policyDraft,
            ]);
        } else {

            $customer->credit -= $totalPrice;


            $customer->save(false);

            $this->processPurchase($policyDraft, $passengers);
        }
    }
    // protected function handleExistingCustomerPayment($policyDraft, $passengers, $customer)
    // {
    //     $totalPrice = $policyDraft->price;
    //     $remainingPrice = $totalPrice - $customer->credit;

    //     if ($remainingPrice > 0) {
    //         if ($policyDraft->paymentmethod === "alawneh") {
    //             // $response = $this->PaymentAlawneh($policyDraft, $passengers);
    //             $response = $this->PaymentAlawneh($policyDraft, $passengers);
    //             if (isset($response['success']) && !empty($response['success'])) {
    //                 $customer->credit = 0;
    //                 $customer->save(false);
    //                 $this->processPurchase($policyDraft, $passengers);
    //             } else {
    //                 $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
    //                 Yii::$app->session->setFlash('error', $errorMessage);
    //             }


    //             return;
    //         }


    //         if ($policyDraft->paymentmethod === "meps") {
    //                 //  dd("shatha");
    //             $model = new \yii\base\DynamicModel(['number', 'expmonth', 'expyear', 'cvv', 'price']);
    //             $model->addRule(['number', 'expmonth', 'expyear', 'cvv', 'price'], 'required')
    //                 ->addRule(['number'], 'string', ['length' => 16])
    //                 ->addRule(['cvv'], 'string', ['length' => [3, 4]])
    //                 ->addRule(['expmonth', 'expyear'], 'integer');

    //             $model->price = $remainingPrice;

    //             if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //                 $paymentData = [
    //                     'number' => $model->number,
    //                     'expmonth' => $model->expmonth,
    //                     'expyear' => $model->expyear,
    //                     'cvv' => $model->cvv,
    //                     'price' => $remainingPrice,
    //                     'payment-token' => Yii::$app->request->post('payment-token'),
    //                 ];

    //                 $response = $this->processPayment($paymentData);
    // // dd( $response);
    //                 if (isset($response['tran_ref']) && !empty($response['tran_ref'])) {
    //                     $customer->credit = 0;
    //                     $customer->save(false);
    //                     $this->processPurchase($policyDraft, $passengers);
    //                 } else {
    //                     $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
    //                     Yii::$app->session->setFlash('error', $errorMessage);
    //                 }
    //             }






    //         }
    // //             return $this->render('/insurance/payment', [
    // //     'model' => $model,
    // //     'policy' => $policyDraft,
    // // ]);  

    //     } else {
    //         // dd("shatha");
    //         $customer->credit -= $totalPrice;
    //         $customer->save(false);
    //         $this->processPurchase($policyDraft, $passengers);
    //     }



    // }

    //     protected function handleExistingCustomerPayment($policyDraft, $passengers, $customer)
    //     {
    //         $totalPrice = $policyDraft->price;
    //         $remainingPrice = $totalPrice - $customer->credit;

    //         if ($remainingPrice > 0) {
    //             if ($policyDraft->paymentmethod === "alawneh") {

    //                 $response = $this->PaymentAlawneh($policyDraft, $passengers);


    //                 if (isset($response['success']) && !empty($response['success'])) {

    //                     $customer->credit = 0;
    //                     $customer->save(false);
    //                     $this->processPurchase($policyDraft, $passengers);
    //                 } else {
    //                     $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
    //                     Yii::$app->session->setFlash('error', $errorMessage);
    //                 }

    // }else{
    //             $model = new \yii\base\DynamicModel(['number', 'expmonth', 'expyear', 'cvv', 'price']);
    //             $model->addRule(['number', 'expmonth', 'expyear', 'cvv', 'price'], 'required')
    //                 ->addRule(['number'], 'string', ['length' => 16])
    //                 ->addRule(['cvv'], 'string', ['length' => [3, 4]])
    //                 ->addRule(['expmonth', 'expyear'], 'integer');

    //             $model->price = $remainingPrice;

    //             if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //                 $paymentData = [
    //                     'number' => $model->number,
    //                     'expmonth' => $model->expmonth,
    //                     'expyear' => $model->expyear,
    //                     'cvv' => $model->cvv,
    //                     'price' => $remainingPrice,
    //                     'payment-token' => Yii::$app->request->post('payment-token'),
    //                 ];

    //                 $response = $this->processPayment($paymentData);


    //     $response = $this->processPayment($paymentData);


    //     if (isset($response['tran_ref']) && !empty($response['tran_ref'])) {

    //         $customer->credit = 0;
    //         $customer->save(false);
    //         // dd(    $response );
    //         $this->processPurchase($policyDraft, $passengers);
    //     } else {
    //         $errorMessage = isset($response['message']) ? $response['message'] : 'Payment failed. Please try again.';
    //         Yii::$app->session->setFlash('error', $errorMessage);
    //     }

    //     return $this->render('/insurance/payment', [
    //         'model' => $model,
    //         'policy' => $policyDraft,
    //     ]);

    // }

    //             }



    //         } else {
    // //    dd("shatha");
    //             $customer->credit -= $totalPrice;


    //             $customer->save(false);

    //             $this->processPurchase($policyDraft, $passengers);
    //         }
    //     }



    protected function processPurchase($policyDraft, $passengers)
    {


        $fromCountryName = $this->getCountryName($policyDraft->DepartCountryCode);
        $toCountryName = $this->getCountryName($policyDraft->ArrivalCountryCode);


        $apiEndpoint = 'https://pannorthjo.com/api/policies';
        $apiKey = 'eyJhbGciOiJIUzI1NiJ9.eyJpZCI6IjJlMzM3YmM2LWFmMzMtNDFjNS04ZTM2LWQ2NzJjMWRjNDYyNSIsImlhdCI6IjIwMjQtMDctMDQiLCJpc3MiOjE4M30.jdsWqHcU0cL4ZHKr0oZYBvamRrpYwvfCARitiBTVzqU';





        $departureDate = new DateTime($policyDraft->departure_date);
        $returnDate = new DateTime($policyDraft->return_date);



        $passengersArray = [];


        foreach ($passengers as $passenger) {
            $dob = new DateTime($passenger->dob);
            $now = new DateTime();
            $age = $now->diff($dob)->y;

            $passengersArray[] = [
                "IsInfant" =>  $age < 2 ? 1 : 0,
                "FirstName" => 'Test',
                "LastName" => 'Test',
                "Gender" => $passenger->gender,
                "DOB" => $passenger->dob,
                "Age" => $age,
                "IdentityType" => $passenger->id_type,
                "IdentityNo" => $passenger->id_number,
                "IsQualified" => true,
                "Nationality" => $passenger->nationality,
                "CountryOfResidence" => $passenger->country
            ];
        }



        $interval = $departureDate->diff($returnDate);

        $days = $interval->days + 1;
        $dob = new DateTime($passenger->dob);
        $now = new DateTime();
        $age = $now->diff($dob)->y;

        $apiPayload = [
            "source" => $policyDraft->source,
            "from_country" => 'Jordan',
            "from_airport" => $policyDraft->from_airport,
            "to_country" =>$toCountryName['name_en'],
            "to_airport" => $policyDraft->going_to,
            "departure_date" => $policyDraft->departure_date,
            "days" => $days,
            "adult" => $policyDraft->AdultCount,
            "child" => $policyDraft->ChildrenCount,
            "infant" => $policyDraft->InfantCount,
            "planCode" => $policyDraft->plan->plan_code,
            "contactDetails" => [
                "name" => $policyDraft->name,
                "email" => $policyDraft->email,
                "mobile" => $policyDraft->mobile
            ],
            "passengers" => $passengersArray
        ];

        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiPayload));

        $apiResponse = curl_exec($ch);

        // dd(  $apiPayload);
        $apiResponseData = json_decode($apiResponse, true);
    
        $customer = Customers::findOne(['mobile' => $policyDraft->mobile]);
        if (!$customer) {
            $customer = new Customers();
            $customer->name = $policyDraft->name;
            $customer->email = $policyDraft->email;
            $customer->mobile = $policyDraft->mobile;

            if (!$customer->save(false)) {
                Yii::$app->session->setFlash('error', 'Failed to save the customer.');
                return $this->redirect(['error-page']);
            }
        } else {
            $customer->name = $policyDraft->name;
            $customer->email = $policyDraft->email;
            $customer->save(false);
        }

        $paymentmethod = new PaymentMethod();
        $paymentmethod->customer_id = $customer->id;
        $paymentmethod->method = $policyDraft->paymentmethod;
        $paymentmethod->response = $apiResponseData['message'] ?? "null";
        $paymentmethod->save();

        if (isset($apiResponseData['id']) && !empty($apiResponseData['id'])) {

            $this->processView($policyDraft,  $passengers, $apiResponseData);
        } else {
            $errorMessage = isset($apiResponseData['error']) ? $apiResponseData['error'] : 'Policy purchase failed. Please try again.';
            Yii::$app->session->setFlash('error', $errorMessage);
        }
    }


    protected function processView($policyDraft, $passengers, $apiResponseData)
    {

        $id = $apiResponseData['id'];
        // dd($apiResponseData);


        $customer = Customers::findOne(['mobile' => $policyDraft->mobile]);
        // foreach ($passengers as $passenger) {
        // $PassengerCount=count($passengers);
        //     $dob = new DateTime($passenger->dob);
        //             $now = new DateTime();
        //             $age = $now->diff($dob)->y;

        //             if($age < 2){
        //                 $PassengerCount=count($passengers)-1;

        // }else{

        //     $PassengerCount=count($passengers);
        // }}


        //         foreach ($passengers as $passenger) {





        //             $policy = new Policy();
        //             $policy->customer_id = $customer->id;
        //             $policy->source = $policyDraft->source;
        //             $policy->from_airport = $policyDraft->from_airport;
        //             $policy->DepartCountryCode = $policyDraft->DepartCountryCode;
        //             $policy->departure_date = $policyDraft->departure_date;
        //             $policy->going_to = $policyDraft->going_to;
        //             $policy->ArrivalCountryCode = $policyDraft->ArrivalCountryCode;
        //             $policy->return_date = $policyDraft->return_date;

        // if($age <2){
        //     $policy->price = 0;
        // }else{
        //     $policy->price = $policyDraft->price/  $PassengerCount ;

        // }



        //             $policy->ProposalState = $apiResponseData['ProposalState'] ?? 'Proposal State';
        //             $policy->ItineraryID = $id;
        //             $policy->PNR = $apiResponseData['PNR'] ?? '';
        //             $policy->PolicyNo = $apiResponseData['PolicyNo'] ?? '';
        //             $policy->PolicyPurchasedDateTime = $apiResponseData['PolicyPurchasedDateTime'] ?? date('Y-m-d H:i:s');
        //             $policy->PolicyURLLink = $apiResponseData['PolicyURLLink'] ?? '';
        //             $policy->status = $apiResponseData['status'] ?? 0;
        //             $policy->status_description = $apiResponseData['status_description'] ?? 'Processing';

        //             if ($policy->save()) {

        //                 $policies[] = $policy;
        //             } else {
        //                 var_dump($policy->errors);
        //                 die();
        //             }
        //         }



        $PassengerCount = count($passengers);
        $policies = [];

        foreach ($passengers as $passenger) {
            $dob = new DateTime($passenger->dob);
            $now = new DateTime();
            $age = $now->diff($dob)->y;

            if ($age < 2) {
                $PassengerCount--;
            }
        }


        foreach ($passengers as $passenger) {
            $dob = new DateTime($passenger->dob);
            $now = new DateTime();
            $age = $now->diff($dob)->y;

            $policy = new Policy();
            $policy->customer_id = $customer->id;
            $policy->source = $policyDraft->source;
            $policy->from_airport = $policyDraft->from_airport;
            $policy->DepartCountryCode ='JO';
            $policy->departure_date = $policyDraft->departure_date;
            $policy->going_to = $policyDraft->going_to;
            $policy->ArrivalCountryCode = $policyDraft->ArrivalCountryCode;
            $policy->return_date = $policyDraft->return_date;
            $policy->name = $passenger->first_name . ' ' . $passenger->last_name;
            if ($age < 2) {
                $policy->price = 0;
            } else {

                $policy->price = $PassengerCount > 0 ? $policyDraft->price / $PassengerCount : 0;
            }

            $policy->ProposalState = $apiResponseData['ProposalState'] ?? 'Proposal State';
            $policy->ItineraryID = $id;
            $policy->PNR = $apiResponseData['PNR'] ?? '';
            $policy->PolicyNo = $apiResponseData['PolicyNo'] ?? '';
            $policy->PolicyPurchasedDateTime = $apiResponseData['PolicyPurchasedDateTime'] ?? date('Y-m-d H:i:s');
            $policy->PolicyURLLink = $apiResponseData['PolicyURLLink'] ?? '';
            $policy->status = $apiResponseData['status'] ?? 0;
            $policy->status_description = $apiResponseData['status_description'] ?? 'Processing';

            if ($policy->save()) {
                $policies[] = $policy;
            } else {
                var_dump($policy->errors);
                die();
            }
        }


        // dd(   $policies);
        $policyIds = array_map(fn($policy) => base64_encode($policy->id), $policies);

        // if ($policy->save()) {


        Yii::$app->queue->delay(13)->push(new \common\jobs\PolicyStatusCheckJob([
            'id' => $id,
            'policies' => $policies,
            'customer' => $customer

        ]));

        // Yii::$app->session->set('refresh', "shatha");
        Yii::$app->session->remove('passenger');


        $policyIds = array_filter(array_map(fn($policy) => $policy->id ? base64_encode($policy->id) : null, $policies));

        // dd($policyIds ); 



        return $this->redirect(['display-policy', 'policyIds' => implode(',', $policyIds), 'id' => base64_encode($id),'mobile' => $policyDraft->mobile]);

        //         // return $this->redirect(['display-policy', 'policyId' => base64_encode($policy->id), 'id' => base64_encode($id)]);
        //     } else {
        //         var_dump($policy->errors);
        //     }

        //     die();
        // }


        // public function actionRetry($policy, $id)
        // {

        //     $policy = Policy::findOne($policy);

        //     if ($policy) {


        //         if ($policy->save(false) && $policy->status == 0) {

        //             Yii::$app->queue->delay(5)->push(new \common\jobs\PolicyStatusCheckJob([
        //                 'id' => $id,
        //                 'policyId' => $policy->id
        //             ]));

        //             if ($policy->status == 0) {
        //                 $policy->status = 2;
        //                 $policy->status_description = 'Cancelled';
        //                 $policy->save();
        //             } else {
        //                 $policy->status_description = 'Completed';
        //                 $policy->save();
        //             }

        //             Yii::$app->session->setFlash('success', 'Retry request has been processed.');
        //         } else {
        //             Yii::$app->session->setFlash('error', 'Failed to retry the policy.');
        //         }
        //     } else {
        //         Yii::$app->session->setFlash('error', 'Policy not found.');
        //     }

        //     return $this->redirect(['display-policy', 'policyId' => base64_encode($policy->id), 'id' => base64_encode($id)]);
        // }
    }
    public function actionUpdatePolicyStatus()
    {
        $policyId = Yii::$app->request->post('policyId');
        $policy = Policy::findOne($policyId);

        if ($policy) {
            $customer = Customers::findOne(['id' => $policy->customer_id]);
            if ($customer && $customer->credit > 0) {
                Yii::$app->session->setFlash('info', 'You have ' . $customer->credit . ' $ credits saved within your wallet. You can use it to purchase another policy any time or contact us for full refund.');
            }
        }

        return $this->asJson(['status' => 'success']);
    }
















    protected function processPayment($data)
    {
        $serverKey = 'SNJN6DLBLB-JGDKD6BLLG-BMGLG6BHZB';
        $endpoint = 'https://secure-jordan.paytabs.com/payment/request';

        $paymentPayload = [
            'profile_id' => '104394',
            'tran_type' => 'sale',
            'tran_class' => 'ecom',
            'cart_id' => 'cart_' . time(),
            'cart_currency' => 'JOD',
            'cart_amount' => $data['price'],
            'cart_description' => 'Payment for insurance policy',
            'return' => Yii::$app->urlManager->createAbsoluteUrl(['check']),
            'callback' => Yii::$app->urlManager->createAbsoluteUrl(['payment-callback']),
            'payment_token' => $data['payment-token'],
            'expiry_date' => $data['expmonth'] . '/' . $data['expyear'],
            'cvv' => $data['cvv'],


        ];

        $headers = [
            'Authorization:' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentPayload));

        $response = curl_exec($ch);
        curl_close($ch);
        // dd( json_decode($response, true));

        return json_decode($response, true);
    }
}

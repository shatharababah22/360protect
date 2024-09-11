<?php

namespace common\jobs;

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;
use common\models\Policy;
use common\models\PolicyDraft;
use common\models\PolicyDraftPassengers;

class PolicyStatusCheckJob extends BaseObject implements JobInterface
{
    public $id;
    public $policyId;
    public $customer;
    public $policies;
 

    public function execute($queue)
    {
        $responses = $this->viewPolicy($this->id);
        var_dump($responses);

        if ($responses === null) {
            Yii::error("Failed to retrieve policy data for ID: {$this->id}", __METHOD__);
            return;
        }

  

        if ($responses != null) {
           
                foreach ($this->policies as $policy) {
                    foreach ($responses as $response) {
                $policy->ProposalState = $response['ProposalState'] ?? 'Proposal State';
                $policy->PNR = $response['PNR'] ?? '';
                $policy->PolicyNo = $response['PolicyNo'] ?? '';
                $policy->PolicyPurchasedDateTime = $response['PolicyPurchasedDateTime'] ?? date('Y-m-d H:i:s');
                $policy->PolicyURLLink = $response['PolicyURLLink'] ?? '';
                $policy->status = $response['status'] ?? 0;
                $policy->status_description = 'Completed';
                if ($policy->save()) {
                    $send = $this->sendMessage($policy->customer->mobile, $policy->PolicyURLLink);

                    if ($send['status'] == 201) {
                        PolicyDraft::deleteAll();
                        PolicyDraftPassengers::deleteAll();
                  
                    }
                } else {
                    Yii::error("Failed to update policy with ID: {$this->policyId}", __METHOD__);
                   
                }
            }}
        } else {
            foreach ($this->policies as $policy) {
            if ($policy && $policy->status == 0) {
                $policy->status = 2;
                $policy->status_description = 'Failed';
                $this->customer->credit += $policy->price;
                $policy->save();
                $this->customer->save(false);
          
            }}
        }
    }



    private function viewPolicy($id)
    {

        $apiEndpoint = "https://tuneprotectjo.com/api/policies/$id";
        $apiKey = 'eyJhbGciOiJIUzI1NiJ9.eyJpZCI6IjJlMzM3YmM2LWFmMzMtNDFjNS04ZTM2LWQ2NzJjMWRjNDYyNSIsImlhdCI6IjIwMjQtMDctMDQiLCJpc3MiOjE4M30.jdsWqHcU0cL4ZHKr0oZYBvamRrpYwvfCARitiBTVzqU';

        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $apiResponse = curl_exec($ch);

        if ($apiResponse === false) {
            $error = curl_error($ch);
            Yii::error('cURL Error: ' . $error, __METHOD__);
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        $response = json_decode($apiResponse, true);
        // var_dump( $response);
        return $response;
    }

    private function sendMessage($mobile, $policyURLLink)
    {
        $messageContent = "Dear Customer, \n\n" .
            "We would like to inform you that you can review the details of your policy by visiting the following link: $policyURLLink.\n\n";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.releans.com/v2/message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "sender=360Protect&mobile=$mobile&content=" . urlencode($messageContent),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImZiYTFkZGFlLTY4M2UtNGQ3OS1iZjFiLWJlZDRhODM2YTg5MiIsImlhdCI6MTcyMTU2OTQyMSwiaXNzIjoxOTQ3OH0.p_B-G3fAeorMR8WsC3GjUV2fM9PdheiVHLLWaC4WqNE"
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        if ($response === false) {
            echo "cURL Error: ";
            var_dump($error);
        }

        curl_close($curl);

        return ['status' => $httpCode, 'response' => $response];
    }
}

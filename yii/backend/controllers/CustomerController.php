<?php

namespace backend\controllers;

use common\models\Customers;
use common\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use common\models\UploadForm;
use Exception;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;

/**
 * CustomerController implements the CRUD actions for Customers model.
 */
class CustomerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Customers models.
     *
     * @return string
     */

     public function actionExport()
     {
         $models = Customers::find()->all();
         if (empty($models)) {
            Yii::$app->session->setFlash('error', 'No Customers data found.');
            return $this->redirect(['index']); 
        }
    
 
         $spreadsheet = new Spreadsheet();
         $sheet = $spreadsheet->getActiveSheet();
 
         $sheet->setCellValue('A1', 'Name');
         $sheet->setCellValue('B1', 'Email');
         $sheet->setCellValue('C1', 'Mobile Number');
         $sheet->setCellValue('D1', 'Credit (JOD)');
   
 
         $headerStyle = [
             'fill' => [
                 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                 'startColor' => [
                     'argb' => 'FF808080',
                 ],
                 'font' => [
                     'color' => [
                         'argb' => 'FFFFFFFF',
                     ],
                 ],
             ],
         ];

         $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);
 
         $row = 2;
         
         foreach ($models as $model) {
             $sheet->setCellValue('A' . $row, $model->name);
             $sheet->setCellValue('B' . $row, $model->email);
            //  $sheet->setCellValue('C' . $row, $model->mobile);
            $sheet->setCellValueExplicit('C' . $row, $model->mobile, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

             $sheet->setCellValue('D' . $row, $model->credit);
             $row++;
         }
 
         $writer = new Xlsx($spreadsheet);
         $fileName = 'Customers.xlsx';
         $temp_file = tempnam(sys_get_temp_dir(), $fileName);
         $writer->save($temp_file);
 
         return Yii::$app->response->sendFile($temp_file, $fileName);
     }

    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customers model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Customers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            if (!$model->save()) {
                $errorMessage = 'Payment save failed. Errors: ' . json_encode($model->errors);

                var_dump($errorMessage);
            exit;
            }
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customers::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

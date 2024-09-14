<?php

namespace backend\controllers;

use common\models\Insurances;
use common\models\PlansItems;
use common\models\PlansItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\web\UploadedFile;
use common\models\UploadForm;
use PhpOffice\PhpSpreadsheet\IOFactory;


// use PhpOffice\PhpSpreadsheet\IOFactory;
use yii;


/**
 * BenefitController implements the CRUD actions for PlansItems model.
 */
class BenefitController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'], // Allow only authenticated users
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }





    public function actionExport()
    {
        $models = PlansItems::find()->all();
        if (empty($models)) {
            Yii::$app->session->setFlash('error', 'No  data found.');
            return $this->redirect(['index']); 
        }
 


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Insurance Name');
        $sheet->setCellValue('B1', 'Title Name');


        $headerStyle = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF808080',
                ],
            ],
            'font' => [
                'color' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];
        $sheet->getStyle('A1:B1')->applyFromArray($headerStyle);
        $row = 2;
        foreach ($models as $model) {
            $sheet->setCellValue('A' . $row, $model->insurance->name);
            $sheet->setCellValue('B' . $row, $model->title);
            $row++;
        }

        

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Benefit.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return Yii::$app->response->sendFile($temp_file, $fileName);
    }



    /**
     * Lists all PlansItems models.
     *
     * @return string
     */
    // public function actionIndex()
    // {
    //     $searchModel = new PlansItemsSearch();
    //     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       



    //     $model = new UploadForm();
    //     if (Yii::$app->request->isPost) {
    //         $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
    //         if ($model->upload()) {
    //             $inputFile = 'images/' . $model->imageFile->baseName . '.' . $model->imageFile->extension;
    //             echo "File uploaded: " . $inputFile . "<br>";
    
    //             try {
    //                 $spreadsheet = IOFactory::load($inputFile);
    //                 echo "Spreadsheet loaded successfully.<br>";
    //             } catch (Exception $e) {
    //                 die('Error loading file "' . pathinfo($inputFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    //             }
    
    //             $sheet = $spreadsheet->getActiveSheet();
    //             $highestRow = $sheet->getHighestRow();
    //             $highestColumn = $sheet->getHighestColumn();
    
    //             $startRow = 2;
            
            
    //         }


    //     return $this->render('index', [
    //         'searchModel' => $searchModel,

    //         'dataProvider' => $dataProvider,
          
    //     ]);
    // }


    public function actionMultiple()
    {
        
        
        // dd("shatha");
        $selectedIds = Yii::$app->request->post('selected_ids', []);

        if (!empty($selectedIds)) {
            
            PlansItems::deleteAll(['id' => $selectedIds]);
            Yii::$app->session->setFlash('success', 'Selected items have been deleted.');
        } else {
            Yii::$app->session->setFlash('error', 'No items were selected for deletion.');
        }
    
        return $this->redirect(['index']); 
    }

    public function actionIndex()
{
    $searchModel = new PlansItemsSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


    $model = new UploadForm();
    if (Yii::$app->request->isPost) {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        if ($model->upload()) {
      
            $inputFile = 'images/' .  $model->imageFile->baseName . '.' . $model->imageFile->extension;
            echo "File uploaded: " . $inputFile . "<br>";
            $spreadsheet = IOFactory::load($inputFile);
            echo "Spreadsheet loaded successfully.<br>";
       

            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $startRow = 2;
            for ($row = $startRow; $row <= $highestRow; $row++) {
                $insuranceName = $sheet->getCell('A' . $row)->getValue();
                $titleName = $sheet->getCell('B' . $row)->getValue();

    
                $insurance = Insurances::find()->where(['name' => $insuranceName])->one();

                
                if (!$insurance) {
                    continue;
                }


          
                    $planItem = new PlansItems();
                    $planItem->insurance_id = $insurance->id;
                    $planItem->title = $titleName;
                    if (!$planItem->save()) {
                        print_r($planItem->getErrors());
                    } 
            }
        }
    }

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'model' => $model, 
    ]);
}



    /**
     * Displays a single PlansItems model.
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
     * Creates a new PlansItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PlansItems();

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
     * Updates an existing PlansItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PlansItems model.
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
     * Finds the PlansItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PlansItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlansItems::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

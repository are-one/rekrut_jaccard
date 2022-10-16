<?php

namespace frontend\controllers;

use frontend\models\Interview;
use frontend\models\Lowongan;
use frontend\models\Pelamar;
use frontend\models\search\LowonganSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LowonganController implements the CRUD actions for Lowongan model.
 */
class LowonganController extends Controller
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
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all Lowongan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LowonganSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lowongan model.
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
     * Creates a new Lowongan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lowongan();

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
     * Updates an existing Lowongan model.
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
     * Deletes an existing Lowongan model.
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
     * Finds the Lowongan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Lowongan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lowongan::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLamar($id)
    {
        try {
            
            // CEK APAKAH DATA LENGKAP
            // $modelPelamar = new Pelamar();
            $modelPelamar = Pelamar::findOne(['email' => Yii::$app->user->identity->email]);
            if($modelPelamar){

                if($modelPelamar->validasiData()){
                    $modelInterview = new Interview();
        
                    $modelInterview->lowongan_id = $id;
                    $modelInterview->pelamar_nik = strval($modelPelamar->nik);
        
                    if($modelInterview->save()){
                        Yii::$app->session->setFlash('success', "Loker berhasil dilamar");
                        return $this->redirect(['/site/index']);
                    }else{
                        Yii::$app->session->setFlash('error', "Loker gagal dilamar");
                    }
                    
                }else{
                    Yii::$app->session->setFlash('error', "Mohon lengkapi data anda untuk dapat melamar loker.");
                    return $this->redirect(['/site/profile']);
                }
                
            }else{
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', "Mohon lakukan registrasi ulang karena anda tidak ditemukan.");
                return $this->redirect(['/site/login']);
            }

            
        } catch (\Throwable $th) {
            throw new NotFoundHttpException("Terjadi masalah pada server $th");
            
        }
    }

    
}
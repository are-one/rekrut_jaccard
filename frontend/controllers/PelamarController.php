<?php

namespace frontend\controllers;

use frontend\models\Pelamar;
use frontend\models\search\PelamarSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PelamarController implements the CRUD actions for Pelamar model.
 */
class PelamarController extends Controller
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
                    'except' => ['login', 'signup'],
                    'rules' => [
                        // [
                        //     'actions' => ['login','signup'],
                        //     'allow' => true,
                        //     'roles' => ['?'],
                        // ],
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
     * Lists all Pelamar models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PelamarSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pelamar model.
     * @param string $nik Nik
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($nik)
    {
        return $this->render('view', [
            'model' => $this->findModel($nik),
        ]);
    }

    /**
     * Creates a new Pelamar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pelamar(['scenario' => Pelamar::SCENARIO_INSERT]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'nik' => $model->nik]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pelamar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $nik Nik
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nik)
    {
        $model = $this->findModel($nik);

        $model->scenario = $model::SCENARIO_UPDATE;
        if($model->file_cv != null || $model->file_ijazah != null) $model->scenario = $model::SCENARIO_INSERT;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->uploadCv = UploadedFile::getInstance($model,'uploadCv');
            $model->uploadIjazah = UploadedFile::getInstance($model,'uploadIjazah');
            
            if($model->uploadCv != null){
                $model->file_cv = $model->nik. "-cv-".time(). '.' . $model->uploadCv->extension;
            }

            if($model->uploadIjazah != null){
                $model->file_ijazah = $model->nik. "-ijazah-".time(). '.' . $model->uploadIjazah->extension;
            }
            
            if($model->upload(false)){
                if($model->save()){
                    Yii::$app->session->setFlash('success','Profile berhasil diedit.');
                    return $this->redirect(['/site/profile']);
                }
            }

            Yii::$app->session->setFlash('error','Terjadi kesalahan, Profile gagal diedit.');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pelamar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $nik Nik
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nik)
    {
        $this->findModel($nik)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pelamar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nik Nik
     * @return Pelamar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nik)
    {
        if (($model = Pelamar::findOne(['nik' => $nik])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFile($id, $type)
    {
        $attachment = ($type == 1)? "File Ijazah.pdf" : "File CV.pdf";
        $filePath = Yii::getAlias('@frontend/assets/berkas/'.$id);

        return $this->response->sendFile($filePath,$attachment,['inline' => true])->send();
    }
}
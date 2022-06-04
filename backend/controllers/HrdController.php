<?php

namespace backend\controllers;

use backend\models\Akun;
use backend\models\Hrd;
use backend\models\search\HrdSearch;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HrdController implements the CRUD actions for Hrd model.
 */
class HrdController extends Controller
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
                            'actions' => ['create', 'view', 'update', 'index', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function () {
                                return Yii::$app->user->identity->is_hrd == 2;
                            }
                        ],
                        [
                            'actions' => ['edit', 'akun'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function () {
                                return Yii::$app->user->identity->is_hrd == 1;
                            }
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
     * Lists all Hrd models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HrdSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hrd model.
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
     * Creates a new Hrd model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Hrd();
        $model->scenario = $model::SCENARIO_INSERT;

        if ($this->request->isPost) {
            try {

                if ($model->load($this->request->post())) {
                    $transction = Yii::$app->db->beginTransaction();

                    if ($model->save() && $model->buatAkun()) {
                        $transction->commit();
                        Yii::$app->session->setFlash('success', 'Data berhasil ditambahkan.');
                        return $this->redirect(['view', 'nik' => $model->nik]);
                    } else {
                        $transction->rollBack();
                        Yii::$app->session->setFlash('error', 'Data gagal ditambahkan.');
                    }
                }
            } catch (\Exception $e) {
                $transction->rollBack();
                throw new Exception($e->getMessage());
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Hrd model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $nik Nik
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($nik)
    {
        $model = $this->findModel($nik);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nik' => $model->nik]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hrd model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $nik Nik
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($nik)
    {
        try {
            $transction = Yii::$app->db->beginTransaction();
            $hrd = $this->findModel($nik);

            if ($hrd->delete() && $hrd->hapusAkun()) {
                Yii::$app->session->setFlash("success", "Data berhasil dihapus.");
                $transction->commit();
            } else {
                Yii::$app->session->setFlash("error", "Data gagal dihapus.");
                $transction->rollBack();
            }
        } catch (\Exception $e) {
            $transction->rollBack();
            throw new Exception("Terjadi Masalah");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hrd model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $nik Nik
     * @return Hrd the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($nik)
    {
        if (($model = Hrd::findOne(['nik' => $nik])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEdit($nik)
    {
        $model = $this->findModel($nik);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/site/profile']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionAkun($nik)
    {
        $model = new Akun();
        $model->loadOldData();


        if ($this->request->isPost && $model->load($this->request->post())) {

            if ($model->updateAkun()) {
                return $this->redirect(['/site/profile']);
            }

            Yii::$app->session->setFlash('error', 'Data gagal disimpan.');
        }

        print_r($model->errors);
        // die;
        return $this->render('akun', [
            'model' => $model,
        ]);
    }
}

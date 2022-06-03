<?php

namespace backend\controllers;

use backend\models\Penilaian;
use backend\models\PilihanJawaban;
use backend\models\SoalInterview;
use backend\models\search\SoalInterviewSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SoalInterviewController implements the CRUD actions for SoalInterview model.
 */
class SoalInterviewController extends Controller
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
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
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
     * Lists all SoalInterview models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SoalInterviewSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SoalInterview model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PilihanJawaban::find()->where(['soal_interview_id' => $id]),
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SoalInterview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SoalInterview();

        $hrdNik = Yii::$app->user->identity->id;
        $model->hrd_nik = strval($hrdNik);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            // print_r($model->errors);die;
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SoalInterview model.
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
     * Deletes an existing SoalInterview model.
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
     * Finds the SoalInterview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SoalInterview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SoalInterview::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPilihSoal($id)
    {
        $soalInterviewModel = new SoalInterview;

        $dataProvider = new ActiveDataProvider([
            'query' => $soalInterviewModel->find(),
        ]);
        $penilaianModel = new Penilaian();
        $pilihanSoalLama = ArrayHelper::getColumn($penilaianModel->find()->where(['interview_id' => $id])->all(), 'soal_interview_id');
        // print_r($pilihanSoal);die;

        if ($this->request->isPost) {
            $pilihan = $this->request->post('pilihan') ?? [];
            $lama = $pilihanSoalLama;

            try {
                $transaction = Yii::$app->db->beginTransaction();

                $isSuccess = true;

                foreach ($pilihan as $key => $value) {
                    if (in_array($value, $lama)) {
                        $keyDel = array_search($value, $lama);
                        unset($lama[$keyDel]);
                        continue;
                    }

                    $modelPenilaian = new Penilaian();
                    $modelPenilaian->interview_id = $id;
                    $modelPenilaian->soal_interview_id = $value;

                    if (!$modelPenilaian->save()) {
                        $isSuccess = false;
                        break;
                    }
                }

                if ($lama) {
                    foreach ($lama as $key => $value) {
                        $hapusModel = Penilaian::findOne(['interview_id' => $id, 'soal_interview_id' => $value])->delete();
                    }
                }

                if ($isSuccess) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Data berhasil disimpan');
                    return $this->redirect(['/interview/index']);
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Data gagal disimpan');
                }
            } catch (\Throwable $th) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Terjadi masalah. Data gagal disimpan' . $th);
            }
        }

        return $this->render('pilih-soal', ['pilihanSoalLama' => $pilihanSoalLama, 'dataProvider' => $dataProvider]);
    }
}

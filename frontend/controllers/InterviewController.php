<?php

namespace frontend\controllers;

use common\models\main\Penilaian as MainPenilaian;
use frontend\models\Interview;
use frontend\models\Pelamar;
use frontend\models\Penilaian;
use frontend\models\search\InterviewSearch;
use frontend\models\SoalInterview;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\ConflictHttpException;

/**
 * InterviewController implements the CRUD actions for Interview model.
 */
class InterviewController extends Controller
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
     * Lists all Interview models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InterviewSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $pelamar = Pelamar::findOne(['email' => Yii::$app->user->identity->email]);
        $dataProvider->query->andWhere(['pelamar_nik' => $pelamar->nik]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Interview model.
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
     * Creates a new Interview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Interview();

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
     * Updates an existing Interview model.
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
     * Deletes an existing Interview model.
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
     * Finds the Interview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Interview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Interview::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTest($id)
    {
        try {
            $transaction = Yii::$app->db->beginTransaction();
            
            $pelamar = Pelamar::findOne(['email' => Yii::$app->user->identity->email]);
            $interview = Interview::findOne(['id' => $id, 'pelamar_nik' => $pelamar->nik]);

            $soal = Penilaian::find()->where(['interview_id' => $interview->id])->all();

            $sudahTest = false;

            foreach ($soal as $i => $m) {
                if ($m->pilih != null) {
                    $sudahTest = true;
                }
            }

            if ($this->request->isPost) {

                $jawaban = $this->request->post('jawab');
                // print_r($this->request->post());
                // print_r($soal);
                // die;

                $sukses = true;
                foreach ($soal as $i => $modelSoal) {
                    $idSoal = $modelSoal->soal_interview_id;

                    if (isset($jawaban[$idSoal])) {
                        $pilih = $jawaban[$idSoal];
                        $modelSoal->pilih = $pilih;
                        $modelSoal->save();
                    } else {
                        $sukses = false;
                    }
                }

                // foreach ($jawaban as $id_soal => $id_jawaban) {
                //     // Cari data penilaiaan lalu update
                //     $jawab = Penilaian::findOne(['soal_interview_id' => $id_soal,'interview_id' => $interview->id]);

                //     $jawab->pilih = $id_jawaban;

                //     $jawab->save();
                // }

                if ($sukses) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Jawaban anda <b>Berhasil disimpan.</b>');
                    return $this->redirect(['index']);
                }

                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Jawaban anda <b>Gagal disimpan.</b>');
            }
        } catch (\Throwable $th) {
            $transaction->rollBack();
            throw new BadRequestHttpException('Terjadi Kesalahan' . $th->getMessage());
        }

        return $this->render('test', ['soal' => $soal, 'sudahTest' => $sudahTest]);
    }
}
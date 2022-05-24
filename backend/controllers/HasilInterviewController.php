<?php

namespace backend\controllers;

use backend\models\HasilInterview;
use backend\models\Interview;
use backend\models\Lowongan;
use backend\models\Pelamar;
use backend\models\search\HasilInterviewSearch;
use backend\models\search\InterviewSearch;
use backend\models\search\LowonganSearch;
use backend\models\SoalInterview;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * HasilInterviewController implements the CRUD actions for HasilInterview model.
 */
class HasilInterviewController extends Controller
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
     * Lists all HasilInterview models.
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
     * Displays a single HasilInterview model.
     * @param int $id ID
     * @param int $interview_id Interview ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($lowongan_id)
    {
        $modelLowongan = Lowongan::findOne(['id' => $lowongan_id]);
        $searchModel = new InterviewSearch();

        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->query->andWhere(['lowongan_id' => $lowongan_id]);

        return $this->render('view', [
            'modelLowongan' => $modelLowongan,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Creates a new HasilInterview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new HasilInterview();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'interview_id' => $model->interview_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing HasilInterview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param int $interview_id Interview ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $interview_id)
    {
        $model = $this->findModel($id, $interview_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'interview_id' => $model->interview_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HasilInterview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param int $interview_id Interview ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $interview_id)
    {
        $this->findModel($id, $interview_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HasilInterview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param int $interview_id Interview ID
     * @return HasilInterview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $interview_id)
    {
        if (($model = HasilInterview::findOne(['id' => $id, 'interview_id' => $interview_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // =========================================================================================================================
    //  BEGIN UPDATE HASIL
    // =========================================================================================================================
    public function actionUpdateHasil()
    {
        try {
            $transaction = Yii::$app->db->beginTransaction();

            $hasil = $this->hitung();
            // echo "<pre>";
            // print_r($hasil);
            // echo "</pre>";
            // die;

            $isSaved = true;
            foreach ($hasil as $id_loker => $dataHasil) {
                foreach ($dataHasil as $ih => $h) {
                    $modelHI1 = HasilInterview::findOne(['interview_id' => $h['id_interview_1']]) ??  new HasilInterview;
                    $modelHI2 = HasilInterview::findOne(['interview_id' => $h['id_interview_2']]) ?? new HasilInterview;

                    if ($modelHI1->interview_id == null) {
                        $modelHI1->interview_id = $h['id_interview_1'];
                    }

                    $modelHI1->hasil = $h['perbedaan'];
                    $modelHI1->keterangan = ($modelHI1->hasil > 60) ? "Lamaran Diterima" : "Lamaran Ditolak";


                    if ($modelHI2->interview_id == null) {
                        $modelHI2->interview_id = $h['id_interview_2'];
                    }

                    $modelHI2->hasil = $h['perbedaan'];
                    $modelHI2->keterangan = ($modelHI2->hasil > 60) ? "Lamaran Diterima" : "Lamaran Ditolak";

                    if (!$modelHI1->save() || !$modelHI2->save()) {
                        $isSaved = false;
                        break;
                    }
                }

                if (!$isSaved) break;
            }

            // echo "<pre>";
            // print_r([$modelHI1->errors, $modelHI2->errors]);
            // echo "</pre>";
            // die;
            if ($isSaved) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Data hasil interview berhasil diperbaharui');
            } else {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Data hasil interview gagal diperbaharui');
            }

            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new ServerErrorHttpException("Terjadi masalah " . $e->getMessage());
        }
    }
    // =========================================================================================================================
    // END UPDATE HASIL
    // =========================================================================================================================


    private function getData($loker, $daftarInterview, $soalInterview)
    {
        $arraySoalInterview = ArrayHelper::map($soalInterview, 'id', function ($model) {
            return $model;
        });

        /* $data = [
            id_loker => [
                [
                    'nik' => 3454,
                    'nama' => 'Bambang',
                    'jawaban' => [
                        id_soal => ['interview_id' => 23, 'pilih' => 3],
                        id_soal => ['interview_id' => 23, 'pilih' => 4],
                        id_soal => ['interview_id' => 23, 'pilih' => 5],
                        id_soal => ['interview_id' => 23, 'pilih' => 4],
                    ]
                ],
            ];
         */
        $data = [];

        foreach ($loker as $il => $mLoker) {

            // Memetakan data interview berdasarkan lowongan kerja
            foreach ($daftarInterview as $ik => $mInterview) {
                if ($mInterview['lowongan_id'] == $mLoker->id) {
                    unset($mInterview['lowongan_id']);
                    unset($mInterview['tanggal_interview']);

                    $tempJawaban = ArrayHelper::map($mInterview['penilaians'], 'soal_interview_id', function ($dj) {
                        return $dj;
                    });

                    // TODO Urutkan jawaban sesuai data soal dan Validasi jawaban berdasarkan jawaban soal
                    foreach ($arraySoalInterview as $is => $mSoal) {
                        if (isset($tempJawaban[$mSoal->id])) {
                            $dataJawaban = $tempJawaban[$mSoal->id];

                            unset($dataJawaban['soal_interview_id']);

                            /* 
                                check jika jawaban mSoal sama dengan pilihan dataJawaban, jika iya ubah nilai [pilih] = 1, jika sebailknya beri nilai 0
                             */
                            $dataJawaban['pilih'] = ($mSoal->jawaban == $dataJawaban['pilih']) ? 1 : 0;
                            $mInterview['jawaban'][$mSoal->id] = $dataJawaban;
                        } else {
                            $mInterview['jawaban'] = false;
                        }
                        unset($mInterview['penilaians']);
                    }


                    $data[$mLoker->id][] = $mInterview;
                }
            }
        }

        return $data;
    }

    private function analisis($data, $soalInterview)
    {


        // print_r($data);
        // die;
        /* 
        $hasil = [
            id_loker => [
                0 => [
                    id_pelamar_1 => 23,
                    id_pelamar_2 => 21,
                    intersect => 3,
                    union => 4,
                    kesamaan => 30,          
                    perbedaan => 20, 
                ]
            ]
        ]
        */
        $hasil = [];
        foreach ($data as $id_loker => $list1Interview) {
            $hasil[$id_loker] = [];
            $urutanHasil = 0;

            $list2Interview = $list1Interview;
            // print_r($list1Interview);
            // die;

            // Ambil bagian pertama list1
            foreach ($list1Interview as $il => $interview1) {

                // Jika jumlah data di list2 tersisa 1, maka proses membandingkan di loker 1 di hentikan
                if (count($list2Interview) < 2) break;

                unset($list2Interview[$il]);

                if ($interview1['jawaban'] == false) {
                    // Hapus data $interview1 yang ada dalam list2 agar tidak dibandingkan dengan data yang sama
                    continue;
                }

                // Ambil data bagian kedua di list2
                // lalu bandingkan dengan data list1
                foreach ($list2Interview as $il2 => $interview2) {
                    if ($interview2['jawaban'] == false) continue;
                    $hasil[$id_loker][$urutanHasil]['id_interview_1'] = $interview1['id'];
                    $hasil[$id_loker][$urutanHasil]['id_pelamar_1'] = $interview1['pelamar_nik'];
                    $hasil[$id_loker][$urutanHasil]['id_interview_2'] = $interview2['id'];
                    $hasil[$id_loker][$urutanHasil]['id_pelamar_2'] = $interview2['pelamar_nik'];
                    $jawabanInterview1 = $interview1['jawaban'];
                    $jawabanInterview2 = $interview2['jawaban'];

                    // Proses membandingkan jawaban tiap soal
                    // 
                    // - Hitung dengan poin 1 jika jawaban sama pada nomor soal yang sesusai (Intersect)
                    $nilaiIntersect = 0;
                    foreach ($soalInterview as $i => $modelSoal) {
                        $id_soal = $modelSoal->id;
                        $j1 = $jawabanInterview1[$id_soal]['pilih'];
                        $j2 = $jawabanInterview2[$id_soal]['pilih'];
                        if (($j1 == 1) && ($j2 == 1)) $nilaiIntersect++;
                    }
                    $hasil[$id_loker][$urutanHasil]['intersect'] = $nilaiIntersect; // Hasil poin disimpan disini

                    // - Gabungkan jawaban interview pertama dan interview ke 2 pada nomor soal yang sesuai,
                    // tetapkan poin 1 jika memiliki nilai 1, tetapkan poin 2 jika tidak memiliki poin 1 sama sekali (Union)
                    $nilaiUnion = 0;
                    foreach ($soalInterview as $i => $modelSoal) {
                        $id_soal = $modelSoal->id;
                        $j1 = $jawabanInterview1[$id_soal]['pilih'];
                        $j2 = $jawabanInterview2[$id_soal]['pilih'];
                        if (($j1 == 1) || ($j2 == 1)) $nilaiUnion++;
                    }
                    $hasil[$id_loker][$urutanHasil]['union'] = $nilaiUnion; // Hasil poin disimpan disini

                    $urutanHasil++;
                }

                // unset bagian pertama list2 yang telah digunakan dari data list1
                unset($list2Interview[0]);
            }
        }

        return $hasil;
    }

    public function hitung()
    {
        $loker = Lowongan::find()->all();
        $daftarInterview = Interview::find()->joinWith(['pelamarNik', 'penilaians'])->asArray()->all();
        $soalInterview = SoalInterview::find()->all();
        $data = $this->getData($loker, $daftarInterview, $soalInterview);
        $analisis = $this->analisis($data, $soalInterview);

        $hasil = [];
        foreach ($analisis as $id_loker => $listData) {

            try {
                foreach ($listData as $id => $d) {
                    $d['kesamaan'] = floatval((int) $d['intersect'] / (int) $d['union']) * 100;
                    $d['perbedaan'] = floatval(((int) $d['union'] - (int) $d['intersect']) / (int) $d['union']) * 100;
                    $hasil[$id_loker][$id] = $d;
                }
            } catch (\Exception $e) {
                throw new BadRequestHttpException($e->getMessage());
            }
        }

        return $hasil;
    }
}

<?php

namespace backend\controllers;

use backend\models\HasilInterview;
use backend\models\search\HasilInterviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new HasilInterviewSearch();
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
    public function actionView($id, $interview_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $interview_id),
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

    public function actionHitung()
    {
        $data = [
            0 => [
                    'id_loker' => 3,
                    'nik' => 3454,
                    'nama' => 'Bambang',
                    'jawaban' => [
                        0 => ['id_soal' => 23, 'jawaban' => 'a'],
                        1 => ['id_soal' => 23, 'jawaban' => 'a'],
                        2 => ['id_soal' => 23, 'jawaban' => 'a'],
                        3 => ['id_soal' => 23, 'jawaban' => 'a'],
                        4 => ['id_soal' => 23, 'jawaban' => 'a'],
                        5 => ['id_soal' => 23, 'jawaban' => 'a'],
                        6 => ['id_soal' => 23, 'jawaban' => 'a'],
                    ]
                ],
            1 => [
                    'id_loker' => 3,
                    'nik' => 3451,
                    'nama' => 'Cahyono',
                    'jawaban' => [
                        0 => ['id_soal' => 23, 'jawaban' => 'a'],
                        1 => ['id_soal' => 23, 'jawaban' => 'a'],
                        2 => ['id_soal' => 23, 'jawaban' => 'a'],
                        3 => ['id_soal' => 23, 'jawaban' => 'a'],
                        4 => ['id_soal' => 23, 'jawaban' => 'a'],
                        5 => ['id_soal' => 23, 'jawaban' => 'a'],
                        6 => ['id_soal' => 23, 'jawaban' => 'a'],
                    ]
                ],
            2 => [
                    'id_loker' => 3,
                    'nik' => 3453,
                    'nama' => 'Dedi',
                    'jawaban' => [
                        0 => ['id_soal' => 23, 'jawaban' => 'a'],
                        1 => ['id_soal' => 23, 'jawaban' => 'a'],
                        2 => ['id_soal' => 23, 'jawaban' => 'a'],
                        3 => ['id_soal' => 23, 'jawaban' => 'a'],
                        4 => ['id_soal' => 23, 'jawaban' => 'a'],
                        5 => ['id_soal' => 23, 'jawaban' => 'a'],
                        6 => ['id_soal' => 23, 'jawaban' => 'a'],
                    ]
                ],
            3 => [
                    'id_loker' => 3,
                    'nik' => 3453,
                    'nama' => 'Eko',
                    'jawaban' => [
                        0 => ['id_soal' => 23, 'jawaban' => 'a'],
                        1 => ['id_soal' => 23, 'jawaban' => 'a'],
                        2 => ['id_soal' => 23, 'jawaban' => 'a'],
                        3 => ['id_soal' => 23, 'jawaban' => 'a'],
                        4 => ['id_soal' => 23, 'jawaban' => 'a'],
                        5 => ['id_soal' => 23, 'jawaban' => 'a'],
                        6 => ['id_soal' => 23, 'jawaban' => 'a'],
                    ]
                ],

        ];



    }
}
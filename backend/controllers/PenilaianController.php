<?php

namespace backend\controllers;

use backend\models\Penilaian;
use backend\models\search\PenilaianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenilaianController implements the CRUD actions for Penilaian model.
 */
class PenilaianController extends Controller
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
     * Lists all Penilaian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PenilaianSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penilaian model.
     * @param int $interview_id Interview ID
     * @param int $soal_interview_id Soal Interview ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($interview_id, $soal_interview_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($interview_id, $soal_interview_id),
        ]);
    }

    /**
     * Creates a new Penilaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Penilaian();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'interview_id' => $model->interview_id, 'soal_interview_id' => $model->soal_interview_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Penilaian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $interview_id Interview ID
     * @param int $soal_interview_id Soal Interview ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($interview_id, $soal_interview_id)
    {
        $model = $this->findModel($interview_id, $soal_interview_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'interview_id' => $model->interview_id, 'soal_interview_id' => $model->soal_interview_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Penilaian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $interview_id Interview ID
     * @param int $soal_interview_id Soal Interview ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($interview_id, $soal_interview_id)
    {
        $this->findModel($interview_id, $soal_interview_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Penilaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $interview_id Interview ID
     * @param int $soal_interview_id Soal Interview ID
     * @return Penilaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($interview_id, $soal_interview_id)
    {
        if (($model = Penilaian::findOne(['interview_id' => $interview_id, 'soal_interview_id' => $soal_interview_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

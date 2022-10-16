<?php

namespace backend\controllers;

use backend\models\PilihanJawaban;
use backend\models\search\PilihanJawabanSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PilihanJawabanController implements the CRUD actions for PilihanJawaban model.
 */
class PilihanJawabanController extends Controller
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
     * Lists all PilihanJawaban models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PilihanJawabanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PilihanJawaban model.
     * @param int $id ID
     * @param string $soal_interview_id Soal Interview ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $soal_interview_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $soal_interview_id),
        ]);
    }

    /**
     * Creates a new PilihanJawaban model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($soal_interview_id)
    {
        $model = new PilihanJawaban();
        $model->soal_interview_id = $soal_interview_id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['/soal-interview/view', 'id' => $model->soal_interview_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PilihanJawaban model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param string $soal_interview_id Soal Interview ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $soal_interview_id)
    {
        $model = $this->findModel($id, $soal_interview_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'soal_interview_id' => $model->soal_interview_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PilihanJawaban model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param string $soal_interview_id Soal Interview ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $soal_interview_id)
    {
        $this->findModel($id, $soal_interview_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PilihanJawaban model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param string $soal_interview_id Soal Interview ID
     * @return PilihanJawaban the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $soal_interview_id)
    {
        if (($model = PilihanJawaban::findOne(['id' => $id, 'soal_interview_id' => $soal_interview_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace backend\controllers;

use backend\models\Pelamar;
use backend\models\search\PelamarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $model = new Pelamar();

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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'nik' => $model->nik]);
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
}

<?php

namespace frontend\controllers;

use Exception;
use frontend\models\EmployeeProject;
use frontend\models\Employees;
use frontend\models\EmployeesSearch;
use frontend\models\Model;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * EmployeesController implements the CRUD actions for Employees model.
 */
class EmployeesController extends Controller
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
     * Lists all Employees models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployeesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Employees model.
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
     * Creates a new Employees model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Employees();
        $modelsEmployeeProject = [new EmployeeProject];

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $modelsEmployeeProject = Model::createMultiple(EmployeeProject::classname());
                Model::loadMultiple($modelsEmployeeProject, Yii::$app->request->post());
                // validate all models
                // $valid = $model->validate();
                // $valid = Model::validateMultiple($modelsEmployeeProject) && $valid;
                
                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if ($flag = $model->save()) {
                    
                        foreach ($modelsEmployeeProject as $modelsEmployeeProject) {
                            
                            $modelsEmployeeProject->employee_id = $model->id;
                            if (! ($flag = $modelsEmployeeProject->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                   
                    if ($flag) {
                        $transaction->commit();
                    
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } 

            return $this->render('create', [
                'model' => $model,
                'modelsEmployeeProject' => (empty($modelsEmployeeProject)) ? [new EmployeeProject] : $modelsEmployeeProject
            ]);
    }

   
    /**
     * Updates an existing Employees model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $modelsEmployeeProject = $model->employeeProjects;
        $modelsEmployeeProject = EmployeeProject::find()->where(['employee_id'=>$model->id])->all();
        // echo "<pre>";
        // var_dump($modelsEmployeeProject);
        // die;        

        if ($this->request->isPost && $model->load($this->request->post())) {
            $oldIDs= ArrayHelper::map($modelsEmployeeProject, 'id', 'id');
            $modelsEmployeeProject = Model::createMultiple(EmployeeProject::className(),$modelsEmployeeProject);
            Model::loadMultiple($modelsEmployeeProject, Yii::$app->request->post());
            $deletedIds= array_diff($oldIDs, array_filter(ArrayHelper::map($modelsEmployeeProject, 'id', 'id')));
            $transaction = \Yii::$app->db->beginTransaction(); 
            try{
                if ($flag = $model->save()) {
                    
                    if (!empty($deletedIds)) {
                        EmployeeProject::deleteAll(['id' => $deletedIds]);
                    }
                    foreach ($modelsEmployeeProject as $modelsEmployeeProject) {

                        $modelsEmployeeProject->employee_id = $model->id;

                        if (! ($flag = $modelsEmployeeProject->save())) {
                            $transaction->rollBack();
                            break;
                        }

                    }
                }
                if ($flag) {

                    $transaction->commit();

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }catch(Exception $e){
                $transaction->rollBack();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelsEmployeeProject' => (empty($modelsEmployeeProject)) ? [new EmployeeProject] : $modelsEmployeeProject

        ]);
    }

    /**
     * Deletes an existing Employees model.
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
     * Finds the Employees model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employees the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employees::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

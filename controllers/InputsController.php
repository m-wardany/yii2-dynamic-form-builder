<?php

namespace wardany\dform\controllers;

use Yii;
use wardany\dform\models\DynamicFormInput;
use wardany\dform\models\DynamicFormInputSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InputsController implements the CRUD actions for DynamicFormInput model.
 */
class InputsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actions(){
        return [
            'sortItem' => [
                'class' => \richardfan\sortable\SortableAction::className(),
                'activeRecordClassName' => DynamicFormInput::className(),
                'orderColumn' => 'sortOrder',
            ],
        ];
    }
    /**
     * Lists all DynamicFormInput models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new DynamicFormInputSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        $inputs = \wardany\dform\helpers\InputHelper::inputs();
        $inputs_list = yii\helpers\ArrayHelper::getColumn($inputs, 'title');;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'form_id'=> $id,
            'inputs' => $inputs,
            'inputs_list' => $inputs_list,
        ]);
    }

    /**
     * Displays a single DynamicFormInput model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DynamicFormInput model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type, $form_id)
    {
        $model = \wardany\dform\helpers\InputHelper::getInstance($type);
        $list = new \wardany\dform\models\DynamicInputList();
        $validators = $model->getValidatorsModels();
        $model->form_id = $form_id;
        if ($this->load($model, $validators, $list) && $this->saveModels($model, $list)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'validators'=> $validators,
            'list'=> $list
        ]);
    }

    /**
     * Updates an existing DynamicFormInput model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list = $this->findList($id);
        $validators = $model->getValidatorsModels();
        if ($this->load($model, $validators, $list) && $this->saveModels($model, $list)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'validators'=> $validators,
            'list'=> $list
        ]);
    }

    /**
     * 
     * @param DynamicFormInput $model
     * @param array $validators
     * @param \wardany\dform\models\DynamicInputList $list
     */
    protected function load($model, $validators, $list) {
        $data = Yii::$app->request->post();
        $load_model = $model->load($data);
        $load_validators = $model->loadValidators($validators, $data);
        $load_list = true;
        if($model->isListable()){
            $load_list = $list->load($data);
        }
        return $load_model && $load_list && $load_validators;
    }
    
    /**
     * 
     * @param DynamicFormInput $model
     * @param \wardany\dform\models\DynamicInputList $list
     */
    protected function saveModels($model, $list) {
        if($model->save()){
            if($model->isListable())
                $list->isNewRecord? $list->link('input', $model): $list->save();
            return true;
        }
        return false;
    }
    
    /**
     * Deletes an existing DynamicFormInput model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DynamicFormInput model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DynamicFormInput the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DynamicFormInput::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function findList($id)
    {
        if (($model = \wardany\dform\models\DynamicInputList::find()->where(['input_id'=> $id])->one()) !== null) {
            return $model;
        }
        return new \wardany\dform\models\DynamicInputList();
    }
}

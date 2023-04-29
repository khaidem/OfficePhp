<?php

use frontend\models\Designation;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;



/** @var yii\web\View $this */
/** @var frontend\models\Employees $model */
/** @var yii\widgets\ActiveForm $form */


?>



<div class="employees-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'employee_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->textInput() ?>


    

    <?= $form->field($model, 'designation_id')->textInput() ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>


  
    <div class="rows">
    <div class="card  card-default">
        <!-- <div class="panel-heading"><h4><i class="bi-arrow-right-circle"></i>Dyanamic Form</h4></div> -->
        <div class="card-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsEmployeeProject[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'project_name',
                    'description',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsEmployeeProject as $i => $modelsEmployeeProject): ?>
                <div class="item card card-default"><!-- widgetBody -->
                    <div class="card-heading">
                        <h3 class="card-title pull-left">Add Employee Project Name</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <?php
                            // necessary for update action.
                            if (! $modelsEmployeeProject->isNewRecord) {
                                echo Html::activeHiddenInput($modelsEmployeeProject, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($modelsEmployeeProject, "[{$i}]project_name")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelsEmployeeProject, "[{$i}]description")->textInput(['maxlength' => true]) ?>
                            </div>
                          
                        </div><!-- .row -->
                        
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    

    </div>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success ', 'id'=> 'saveForm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

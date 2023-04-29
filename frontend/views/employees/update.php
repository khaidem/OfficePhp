<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Employees $model */

// $this->title = 'Update Employees: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employees-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h1>Edit of Employee</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsEmployeeProject'=>$modelsEmployeeProject,

    ]) ?>

</div>

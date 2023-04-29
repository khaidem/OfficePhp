<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\EmployeeProject $model */

$this->title = 'Update Employee Project: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employee Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-project-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

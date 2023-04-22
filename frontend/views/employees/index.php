<?php

use frontend\models\Employees;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var frontend\models\EmployeesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Employees';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employees', ['create'], ['class' => 'btn btn-success modalButton']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
        Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modal',
            //'options' => ['class' => 'modal'] //in case if you dont want animation, by default class is 'modal fade'
        ]);
        echo "<div id='modalContent'><div style='text-align:center'>"

            . "</div></div>";
        Modal::end();

        ?>
      


    <?= GridView::widget([
       
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //** For boostrap pagination broken problem slove */
        'pager' => [
            'class'=> 'yii\bootstrap5\LinkPager'
        ],
        // 'rowOptions' => function ($model) {
        //     if ($model->gender === 'male') {
        //         return ['style' => 'background-color: pink'];
        //     } else {
        //         return [];
        //     }
        // },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'employee_name',
            // [
            //     'attribute'=>'department_id',
            //     'value'=>function($model){
            //         return $model->department->department;
            //     }
            // ],
            'department.department',
            'designation.designation',
            'branch.branch_id',
            'gender',
          
            [
                'class' => ActionColumn::className(),
                'template' => '{view}  {update}',
                'buttons'=> [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa-solid fa-eye text-primary"></i>', ['view', 'id' => $model->id], ['class' => 'modalButton']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa-solid fa-pen-to-square"></i>', $url, ['class' => 'btn-xs btn-primary modalButton']);
                    },
                ]
                
                
                // 'urlCreator' => function ($action, Employees $model, $key, $index, $column) {
                //     return Url::toRoute([$action, 'id' => $model->id]);
                //  }
            ],
        ],
        
    ]); ?>
   





</div>

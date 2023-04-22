<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $employee_name
 * @property string $department_id
 * @property string $designation_id
 * @property string $branch_id
 * @property string $gender
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_name', 'department_id', 'designation_id', 'branch_id', 'gender'], 'required'],
            [['employee_name', 'department_id', 'designation_id', 'branch_id'], 'string', 'max' => 200],
            [['gender'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_name' => 'Employee Name',
            'department_id' => 'Department ID',
            'designation_id' => 'Designation ID',
            'branch_id' => 'Branch ID',
            'gender' => 'Gender',
        ];
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $employee_name
 * @property int $department_id
 * @property int $designation_id
 * @property int $branch_id
 * @property string $gender
 *
 * @property Designation $designation
 * @property EmployeeProject[] $employeeProjects
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
            [['department_id', 'designation_id', 'branch_id'], 'integer'],
            [['employee_name'], 'string', 'max' => 200],
            [['gender'], 'string', 'max' => 250],
            [['designation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Designation::class, 'targetAttribute' => ['designation_id' => 'id']],
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
    

    /**
     * Gets query for [[Designation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDesignation()
    {
        return $this->hasOne(Designation::class, ['id' => 'designation_id']);
    }

    /**
     * Gets query for [[EmployeeProjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeProjects()
    {
        return $this->hasMany(EmployeeProject::class, ['employee_id' => 'id']);
    }
    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }
        /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }

   
}

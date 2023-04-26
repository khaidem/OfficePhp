<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "employee_project".
 *
 * @property int $id
 * @property string $project_name
 * @property int $employee_id
 * @property int $employee_education
 *
 * @property Employees $employee
 * @property Education $employeeEducation
 */
class EmployeeProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_name', 'employee_id', 'employee_education'], 'required'],
            [['employee_id', 'employee_education'], 'integer'],
            [['project_name'], 'string', 'max' => 200],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::class, 'targetAttribute' => ['employee_id' => 'id']],
            [['employee_education'], 'exist', 'skipOnError' => true, 'targetClass' => Education::class, 'targetAttribute' => ['employee_education' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'employee_id' => 'Employee ID',
            'employee_education' => 'Employee Education',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::class, ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[EmployeeEducation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeEducation()
    {
        return $this->hasOne(Education::class, ['id' => 'employee_education']);
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "employee_project".
 *
 * @property int $id
 * @property string $project_name
 * @property int $employee_id
 * @property string $description
 *
 * @property Employees $employee
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
            [['project_name', 'employee_id', 'description'], 'required'],
            [['employee_id'], 'integer'],
            [['project_name', 'description'], 'string', 'max' => 200],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::class, 'targetAttribute' => ['employee_id' => 'id']],
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
            'description' => 'Description',
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
}

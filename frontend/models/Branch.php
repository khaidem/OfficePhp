<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string $branch_name
 *
 * @property Employees[] $employees
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_name'], 'required'],
            [['branch_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_name' => 'Branch Name',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::class, ['branch_id' => 'id']);
    }
}

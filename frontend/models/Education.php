<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "education".
 *
 * @property int $id
 * @property int $qualification
 * @property string $institution_name
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qualification', 'institution_name'], 'required'],
            [['qualification'], 'integer'],
            [['institution_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qualification' => 'Qualification',
            'institution_name' => 'Institution Name',
        ];
    }
}

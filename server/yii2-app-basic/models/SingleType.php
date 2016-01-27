<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "single_type".
 *
 * @property string $id
 * @property string $name
 *
 * @property Single[] $singles
 */
class SingleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'single_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingles()
    {
        return $this->hasMany(Single::className(), ['type_id' => 'id']);
    }
}

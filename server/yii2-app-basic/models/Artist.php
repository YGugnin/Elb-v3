<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artist".
 *
 * @property string $id
 * @property string $name
 * @property string $main_single_id
 * @property integer $single_count
 *
 * @property Single $mainSingle
 * @property Single[] $singles
 */
class Artist extends \yii\db\ActiveRecord
{
    public function fields()
    {
        return ['id', 'name'];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'artist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['main_single_id', 'single_count'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['name'], 'unique']
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
            'main_single_id' => 'Main Single ID',
            'single_count' => 'Single Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainSingle()
    {
        return $this->hasOne(Single::className(), ['id' => 'main_single_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingles()
    {
        return $this->hasMany(Single::className(), ['artist_id' => 'id']);
    }
}

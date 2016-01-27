<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "style".
 *
 * @property string $id
 * @property string $name
 * @property string $_order
 *
 * @property SingleStyle[] $singleStyles
 */
class Style extends \yii\db\ActiveRecord
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
        return 'style';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', '_order'], 'required'],
            [['_order'], 'integer'],
            [['name'], 'string', 'max' => 128],
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
            '_order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingleStyles()
    {
        return $this->hasMany(SingleStyle::className(), ['style_id' => 'id']);
    }
}

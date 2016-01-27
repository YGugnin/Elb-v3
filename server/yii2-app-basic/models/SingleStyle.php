<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "single_style".
 *
 * @property string $id
 * @property string $single_id
 * @property string $style_id
 *
 * @property Single $single
 * @property Style $style
 */
class SingleStyle extends \yii\db\ActiveRecord
{
    public function fields()
    {
        return ['style'];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'single_style';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['single_id', 'style_id'], 'required'],
            [['single_id', 'style_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'single_id' => 'Single ID',
            'style_id' => 'Style ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingle()
    {
        return $this->hasOne(Single::className(), ['id' => 'single_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStyle()
    {
        return $this->hasOne(Style::className(), ['id' => 'style_id']);
    }
}

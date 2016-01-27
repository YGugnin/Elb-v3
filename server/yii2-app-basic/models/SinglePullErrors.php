<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "single_pull_errors".
 *
 * @property string $id
 * @property string $artist_name
 * @property string $name
 * @property string $kbps
 * @property string $time_length
 * @property string $weight
 * @property string $lissen_link
 * @property string $download_link
 * @property integer $image
 * @property string $styles
 * @property string $type_id
 * @property string $parsed_url
 * @property string $hide_engines
 * @property string $warning_description
 * @property string $warning_solution
 * @property string $warning_content
 */
class SinglePullErrors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'single_pull_errors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kbps', 'weight', 'image', 'type_id', 'hide_engines'], 'integer'],
            [['time_length'], 'safe'],
            [['parsed_url'], 'required'],
            [['warning_content'], 'string'],
            [['artist_name', 'name', 'styles'], 'string', 'max' => 250],
            [['lissen_link', 'download_link', 'parsed_url', 'warning_description', 'warning_solution'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'artist_name' => 'Artist Name',
            'name' => 'Name',
            'kbps' => 'Kbps',
            'time_length' => 'Time Length',
            'weight' => 'Weight',
            'lissen_link' => 'Lissen Link',
            'download_link' => 'Download Link',
            'image' => 'Image',
            'styles' => 'Styles',
            'type_id' => 'Type ID',
            'parsed_url' => 'Parsed Url',
            'hide_engines' => 'Hide Engines',
            'warning_description' => 'Warning Description',
            'warning_solution' => 'Warning Solution',
            'warning_content' => 'Warning Content',
        ];
    }
}

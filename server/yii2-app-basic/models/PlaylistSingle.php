<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "playlist_single".
 *
 * @property string $id
 * @property string $playlist_id
 * @property string $single_id
 * @property string $_order
 *
 * @property Playlist $playlist
 * @property Single $single
 */
class PlaylistSingle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'playlist_single';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['playlist_id', 'single_id', '_order'], 'required'],
            [['playlist_id', 'single_id', '_order'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'playlist_id' => 'Playlist ID',
            'single_id' => 'Single ID',
            '_order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaylist()
    {
        return $this->hasOne(Playlist::className(), ['id' => 'playlist_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingle()
    {
        return $this->hasOne(Single::className(), ['id' => 'single_id']);
    }
}

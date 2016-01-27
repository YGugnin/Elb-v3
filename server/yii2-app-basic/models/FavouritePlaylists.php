<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favourite_playlists".
 *
 * @property string $id
 * @property string $user_id
 * @property string $playlist_id
 * @property string $is_last_loaded
 *
 * @property Playlist $playlist
 * @property User $user
 */
class FavouritePlaylists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favourite_playlists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'playlist_id'], 'required'],
            [['user_id', 'playlist_id', 'is_last_loaded'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'playlist_id' => 'Playlist ID',
            'is_last_loaded' => 'Is Last Loaded',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

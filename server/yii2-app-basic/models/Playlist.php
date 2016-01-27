<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "playlist".
 *
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $description
 * @property string $max_size
 * @property string $is_last_loaded
 * @property string $is_system
 * @property string $sys_function
 *
 * @property FavouritePlaylists[] $favouritePlaylists
 * @property User $user
 * @property PlaylistSingle[] $playlistSingles
 */
class Playlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'playlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'max_size', 'is_last_loaded', 'is_system'], 'integer'],
            [['name', 'description', 'sys_function'], 'string', 'max' => 255]
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
            'name' => 'Name',
            'description' => 'Description',
            'max_size' => 'Max Size',
            'is_last_loaded' => 'Is Last Loaded',
            'is_system' => 'Is System',
            'sys_function' => 'Sys Function',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavouritePlaylists()
    {
        return $this->hasMany(FavouritePlaylists::className(), ['playlist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaylistSingles()
    {
        return $this->hasMany(PlaylistSingle::className(), ['playlist_id' => 'id']);
    }
}

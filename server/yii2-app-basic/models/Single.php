<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "single".
 *
 * @property string $id
 * @property string $user_id
 * @property string $artist_id
 * @property string $name
 * @property string $kbps
 * @property string $time_length
 * @property double $weight
 * @property string $added_date
 * @property string $lissen_link
 * @property string $download_link
 * @property integer $image
 * @property string $downloads_count
 * @property integer $lissens_count
 * @property integer $comment_count
 * @property string $rate
 * @property string $type_id
 * @property string $description
 * @property string $is_recomendated
 * @property string $is_exlusive
 *
 * @property Artist[] $artists
 * @property Comment[] $comments
 * @property PlaylistSingle[] $playlistSingles
 * @property Artist $artist
 * @property SingleType $type
 * @property User $user
 * @property SingleStyle[] $singleStyles
 * @property SingleVoting[] $singleVotings
 */
class Single extends \yii\db\ActiveRecord
{
    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'artist';
        $fields[] = 'singleStyles';
        return $fields;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'single';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'artist_id', 'kbps', 'image', 'downloads_count', 'lissens_count', 'comment_count', 'rate', 'type_id', 'is_recomendated', 'is_exlusive'], 'integer'],
            [['name', 'time_length'], 'required'],
            [['time_length', 'added_date'], 'safe'],
            [['weight'], 'number'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 250],
            [['lissen_link', 'download_link'], 'string', 'max' => 255]
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
            'artist_id' => 'Artist ID',
            'name' => 'Name',
            'kbps' => 'Kbps',
            'time_length' => 'Time Length',
            'weight' => 'Weight',
            'added_date' => 'Added Date',
            'lissen_link' => 'Lissen Link',
            'download_link' => 'Download Link',
            'image' => 'Image',
            'downloads_count' => 'Downloads Count',
            'lissens_count' => 'Lissens Count',
            'comment_count' => 'Comment Count',
            'rate' => 'Rate',
            'type_id' => 'Type ID',
            'description' => 'Description',
            'is_recomendated' => 'Is Recomendated',
            'is_exlusive' => 'Is Exlusive',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtists()
    {
        return $this->hasMany(Artist::className(), ['main_single_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['single_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaylistSingles()
    {
        return $this->hasMany(PlaylistSingle::className(), ['single_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtist()
    {
        return $this->hasOne(Artist::className(), ['id' => 'artist_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(SingleType::className(), ['id' => 'type_id']);
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
    public function getSingleStyles()
    {
        return $this->hasMany(SingleStyle::className(), ['single_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSingleVotings()
    {
        return $this->hasMany(SingleVoting::className(), ['single_id' => 'id']);
    }
}

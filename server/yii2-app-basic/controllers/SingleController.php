<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class SingleController extends ActiveController
{
    public $modelClass = 'app\models\Single';
    public $reservedParams = ['sort','q','order'];
    public $orderParams = ['id','name'];

    public function behaviors()
    {
        return 
        \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ]);
    }

    public function actions() {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'indexDataProvider'];
        return $actions;
    }

    public function indexDataProvider() {
        $params = \Yii::$app->request->queryParams;

        $model = new $this->modelClass;
        $modelAttr = $model->attributes;

        $order = isset($params['order']) ? (ArrayHelper::keyExists($params['order'], $this->orderParams, false) ? $params['order'] : 'id') : 'id';
        $sort = (isset($params['sort']) && $params['sort'] = 'asc') ? 'ASC' : 'DESC';

        $search = [];

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if(!is_scalar($key) or !is_scalar($value)) {
                    throw new BadRequestHttpException('Bad Request');
                }
                if (!in_array(strtolower($key), $this->reservedParams)
                    && ArrayHelper::keyExists($key, $modelAttr, false)) {
                    $search[$key] = $value;
                }
            }
        }



        //return $model->find()->where($search)->orderBy([$order => $sort])->limit(10)->all();
        return $model->find()->where($search)->orderBy($order . ' ' . $sort)->limit(20)->all();
    }
}
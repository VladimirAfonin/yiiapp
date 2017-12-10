<?php

namespace app\models;

use yii\db\ActiveRecord;

class Categories extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    /**
     * поведение -> для images
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * связь с продуктами
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['category_id' => 'id']);
    }
}
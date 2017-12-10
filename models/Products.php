<?php

namespace app\models;

use yii\db\ActiveRecord;

class Products extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
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
     * один прод имеет одну cat.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
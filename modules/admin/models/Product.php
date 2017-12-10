<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\Category;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $content
 * @property double $price
 * @property string $keywords
 * @property string $description
 * @property string $img
 * @property string $hit
 * @property string $new
 * @property string $sale
 */
class Product extends \yii\db\ActiveRecord
{
    public $image;
    public $gallery;


    /**
     * @inheritdoc
     */
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
     * отношения
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'hit', 'new', 'sale'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description', 'img'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['gallery'], 'file'/*, 'skipOnEmpty' => true*/, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'name' => 'Имя',
            'content' => 'Контент',
            'price' => 'Цена',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'image' => 'Фото',
            'gallery' => 'Фото галереи',
            'hit' => 'Hit',
            'new' => 'New',
            'sale' => 'Sale',
        ];
    }

    /**
     * метод для загрузки фото
     *
     * @return bool
     */
    public function upload()
    {
        if($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }

    /**
     * метод для загрузки галереи
     *
     * @return bool
     */
    public function uploadGallery()
    {
        if($this->validate()) {
            foreach($this->gallery as $file) {
                $path = 'upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace app\controllers;

use app\models\Products;
use app\models\Categories;
use Yii;

class CategoryController extends AppController
{
    /**
     * стартовый вид,
     * хит продуктс
     *
     * @return string
     */
    public function actionIndex()
    {
        $hitProducts = Products::find()->where(['hit' => '1'])->asArray()->limit(6)->all();

        return $this->render('index', compact('hitProducts'));
    }

    /**
     * получаем продукты по выбранной категории
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        // $_GET['id']
        $categoryId = Yii::$app->request->get('id');
        $products = Products::find()->where(['category_id' => $categoryId])->asArray()->all();

        return $this->render('view', compact('products'));
    }
}
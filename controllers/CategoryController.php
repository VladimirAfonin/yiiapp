<?php

namespace app\controllers;

use app\models\Products;

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
}
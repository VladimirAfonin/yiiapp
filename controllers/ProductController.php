<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use yii\web\HttpException;


class ProductController extends AppController
{
    /**
     * показ одного product.
     *
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionView($id)
    {
        $productId = Yii::$app->request->get('id');
        $product = Products::findOne($productId);
        if(empty($product)) throw new HttpException('404', 'Такого продукта нет');

        // второй вариант жадная загрузка
//        $product = Products::find()->with('category')->where(['id' => $productId])->one();

        $hitProducts = Products::find()->where(['hit' => '1'])->limit(12)->all();
        $count = count($hitProducts);

        // set meta
        $this->setMeta('Product details | ' . $product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product', 'hitProducts', 'count'));
    }
}
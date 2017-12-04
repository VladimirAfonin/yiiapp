<?php

namespace app\controllers;

use app\models\Products;
use app\models\Categories;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;
use yii\helpers\Html;

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
        $hitProducts = Products::find()->where(['hit' => '1'])->limit(6)->asArray()->all();

        // set meta data
        $this->setMeta('E_SHOPPER');

        return $this->render('index', compact('hitProducts', 'pages'));
    }

    /**
     * получаем продукты по выбранной категории
     *
     * @param $id
     * @return string
     * @throws HttpException
     */
    public function actionView($id)
    {
        // получаем $_GET['id']
        $categoryId = Yii::$app->request->get('id');
        $category = Categories::findOne($id);
        if(empty($category)) throw new HttpException('404', 'Такой категории нет');

        // pagination
        $query = Products::find()->where(['category_id' => $categoryId]); //->asArray()->all();
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'pageSizeParam' => false,
            'forcePageParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();


        $this->setMeta("Shopper | " . $category->name, $category->keywords, $category->description );

        return $this->render('view', compact('products', 'category', 'pages'));
    }

    /**
     * поиск продуктов
     *
     * @return string
     */
    public function actionSearch()
    {
        $search = Html::encode(trim(Yii::$app->request->get('q')));
        if(empty($search)) return $this->render('search', compact('search'));;

        $query = Products::find()->where(['like', 'name', $search]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'pageSizeParam' => false,
            'forcePageParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();

        return $this->render('search', compact('products', 'pages', 'search'));

    }
}
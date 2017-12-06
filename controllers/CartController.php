<?php

namespace app\controllers;

use app\models\{Cart, Products, OrderItems, Order};
use Yii;


class CartController extends AppController
{
    public $layout = false;

    /**
     * добавление в корзину
     *
     * @return bool|string
     */
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = ( ! $qty) ? 1 : $qty;

        $product = Products::findOne($id);
        if(empty($product)) return false;

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product, $qty);

        // если не работает асинхрон
        if(!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
//        debug($session['cart']);

        return $this->render('cart-modal', compact('session'));
    }

    /**
     * очищаем корзину
     *
     * @return string
     */
    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        return $this->render('cart-modal', compact('session'));
    }

    /**
     * удаление эл-а из корзины
     *
     * @return string
     */
    public function actionDelItem()
    {

        $id = Yii::$app->request->get('id');

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalc($id);

        return $this->render('cart-modal', compact('session'));
    }

    /**
     * показ корзины
     *
     * @return string
     */
    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();

        return $this->render('cart-modal', compact('session'));
    }

    /**
     * вид заказа
     *
     * @return string
     */
    public function actionView()
    {
        $this->layout = 'main';

        $session = Yii::$app->session;
        $session->open();

        $this->setMeta('Корзина');
        $order = new Order();

        if($order->load(Yii::$app->request->post())) {
            // добавляем еще поля
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if($order->save()) {
                OrderItems::saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят.');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при оформлении заказа');
            }
        }

        return $this->render('view', compact('session', 'order'));
    }

};
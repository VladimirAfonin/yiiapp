<?php

namespace app\models;


use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
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
     * добавление товара в корзину
     *
     * @param $product
     * @param int $qty
     */
    public function addToCart($product, $qty = 1)
    {
        if(isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? ($_SESSION['cart.qty'] + $qty) : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? ($_SESSION['cart.sum'] + ($qty * $product->price)) : ($qty * $product->price);
    }

    /**
     * пересчет корзины
     *
     * @param $id
     * @return bool
     */
    public function recalc($id)
    {
        if(!isset($_SESSION['cart'][$id])) return false;

        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $qtySum = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];

        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $qtySum;

        unset($_SESSION['cart'][$id]);
    }
}
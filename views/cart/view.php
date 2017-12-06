<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php if ( ! empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-trash"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><img src="/images/products/<?= $item['img'] ?>" width="70" class="girl img-responsive" alt="" /></td>
                        <td><a href="<?= Url::to(['product/view', 'id' => $id])?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty'] * $item['price'] ?></td>
                        <td>
                            <span class="glyphicon glyphicon-trash text-danger del-item" data-id=<?= $id ?>></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">Итого:</td>
                    <td><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="4">Общая сумма:</td>
                    <td><?= $session['cart.sum'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($order, 'name') ?>
        <?= $form->field($order, 'email') ?>
        <?= $form->field($order, 'phone') ?>
        <?= $form->field($order, 'address') ?>
        <?=Html::submitButton('заказать', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end() ?>

    <?php else: ?>
        <h4>корзина пуста</h4>
    <?php endif; ?>
</div>

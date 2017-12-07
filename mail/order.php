<?php
use yii\helpers\Url;
?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($session['cart'] as $id => $item): ?>
                <tr>
                    <td><img src="/images/products/<?= $item['img'] ?>" width="70" class="girl img-responsive" alt="" /></td>
                    <td><a href="<?= Url::to(['product/view', 'id' => $id, true]) ?>"><?= $item['name'] ?></a></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
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

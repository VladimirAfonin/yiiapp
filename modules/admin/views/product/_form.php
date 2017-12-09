<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\MenuWidget;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this); // избегаем возможных конфликтов с bootstrap

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'category_id')->textInput() ?>

        <div class="form-group field-product-parent_id">
            <label for="product-category_id" class="control-label">Категория</label>
            <select class="form-control" name="Product[category_id]" id="product-category_id">
                <?= MenuWidget::widget(['tpl' => 'product-select', 'model' => $model]) ?>
            </select>
        </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' =>
            ElFinder::ckeditorOptions('elfinder', [ 'preset' => 'full', // basic, standart, full
                'inline' => false,]),
    ]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hit')->checkbox([ '0', '1', ]) ?>

    <?= $form->field($model, 'new')->checkbox([ '0', '1', ]) ?>

    <?= $form->field($model, 'sale')->checkbox([ '0', '1', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

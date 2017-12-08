<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Category;
use app\widgets\MenuWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'parent_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map( Category::find()->all(), 'id', 'name' )) ?>

<!---->
    <div class="form-group field-category-parent_id">
        <label for="category-parent_id" class="control-label">Родительская категория</label>
        <select class="form-control" name="Category[parent_id]" id="category-parent_id">
            <?= MenuWidget::widget(['tpl' => 'select', 'model' => $model]) ?>
        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

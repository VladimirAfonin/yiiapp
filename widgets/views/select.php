<option
    value="<?= $category['id'] ?>"
    <?= ($category['id'] == $this->model->parent_id) ? ' selected' : '' ?>
    <?= ($category['id'] == $this->model->id) ? ' disabled' : '' ?>
>
    <?= $tab . $category['name'] ?>
</option>
<?php if (isset($category['childs'])): ?>
    <?= $this->getMenuHtml($category['childs'], $tab . '-') ?>
<?php endif; ?>

<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
<?php if (isset($category['childs'])) : ?>
    <?php foreach ($category['childs'] as $child): ?>
        <option value="<?= $category['id'] ?>">
            &nbsp;-<?= $child['name'] ?>
        </option>
    <?php endforeach; ?>
<?php endif; ?>

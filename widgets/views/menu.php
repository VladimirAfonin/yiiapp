<li>
    <a href="#">
        <?= $category['name'] ?>
        <?= isset($category['childs']) ? '<span class="badge pull-right"><i class="fa fa-plus"></i></span>' : '' ?>
    </a>
    <?php if(isset($category['childs'])) : ?>
        <ul>
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
    <?php endif; ?>
</li>
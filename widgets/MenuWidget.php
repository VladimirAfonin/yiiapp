<?php

namespace app\widgets;

use yii\base\Widget;
use app\models\Categories;

class MenuWidget extends Widget
{
    public $tpl = 'menu';
    // массив всех категорий
    public $data;
    // дерево после функции lacroix
    public $tree;
    // готовый код
    public $menuHtml;

    public function init()
    {
        parent::init();
        $this->tpl .= '.php';
    }

    public function run()
    {
        $this->data = Categories::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        return $this->menuHtml;
    }

    /**
     * получаем дерево категорий -> lacroix.
     *
     * @return array
     */
    public function getTree()
    {
        $tree = [];
        foreach($this->data as $id => &$node) {
            if($node['parent_id'] == 0) {
                $tree[$id] = &$node;
            } else {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }

    /**
     * формируем меню
     *
     * @param $tree
     * @return string
     */
    protected function getMenuHtml($tree)
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }

    /**
     * отключаем буфер,
     * сбрасываем его и очищаем
     *
     * @param $category
     * @return string
     */
    protected function catToTemplate($category)
    {
        ob_start();
        include __DIR__ .'/views/'.$this->tpl;
        return ob_get_clean();
    }
}
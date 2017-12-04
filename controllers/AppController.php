<?php

namespace app\controllers;

use yii\web\Controller;

class AppController extends Controller
{
    /**
     * устанавливаем мета тэги
     *
     * @param null $title
     * @param null $keywords
     * @param null $desc
     */
    protected function setMeta($title = null, $keywords = null, $desc = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$desc"]);
    }
}
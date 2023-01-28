<?php

namespace app\frontend\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Frontend` module
 */
class SiteController extends Controller
{
    public $layout = '@app/frontend/views/layouts/main';

    public function actionIndex()
    {
        return $this->render('@app/frontend/views/site/index');
    }
}

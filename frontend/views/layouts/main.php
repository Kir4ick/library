<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\frontend\views\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bg-gray-200">
<?php $this->beginBody() ?>

<header class="h-20 border-b-[1px] px-12  bg-white drop-shadow-sm">
    <div class="container flex items-center justify-between h-full relative">
        <div class="main-header flex items-end">
            <a href=""><h1 class="text-2xl font-semibold">MyLibrary</h1></a>
            <nav class="ml-20 flex gap-5">
                <a class="hover:text-cyan-800" href="">Главная</a>
                <a class="hover:text-cyan-800" href="">О нас</a>
            </nav>
        </div>

        <div class="login">
            <a class="" href="">
                <button class="block rounded-xl w-24 h-10 hover:bg-cyan-500
                 text-white bg-cyan-800">Войти</button>
            </a>
        </div>
    </div>
</header>

<main id="main" class="flex-shrink-0" role="main" style="padding-bottom: 100px">
    <?= $content ?>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

use panix\engine\Html;
use panix\engine\widgets\Breadcrumbs;

\app\web\themes\basic\ThemeAsset::register($this);
\panix\engine\assets\ErrorAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap page-error">
    <?= $this->render('partials/_header'); ?>
    <div class="container">
        <?php if (isset($this->params['breadcrumbs'])) {
            echo Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'],
            ]);
        } ?>


        <?php
        echo $content;
        ?>
    </div>
</div>
<?= $this->render('partials/_footer'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

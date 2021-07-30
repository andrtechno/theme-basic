<?php

use yii\helpers\Url;
use yii\helpers\Html;
use panix\mod\shop\widgets\categories\CategoriesWidget;
use panix\mod\shop\widgets\filtersnew2\FiltersWidget;


?>

<div class="container-fluid2 catalog-container">
    <div class="row2">
    <div class="catalog-sidebar">
        <div id="filters-container">
            <a class="d-md-none btn-filter-close close" href="javascript:void(0)"
               onclick="$('#filters-container').toggleClass('open'); return false;">
                <span>&times;</span>
            </a>

            <?php
            echo FiltersWidget::widget([
                'model' => $this->context->dataModel,
                'data' => $this->context->filter,
                'count'=>true
            ]);

            ?>
        </div>
    </div>
    <div class="catalog-content">
        <div class="heading-gradient">
            <h1><?= Html::encode(($this->h1) ? $this->h1 : $this->context->pageName); ?></h1>
        </div>
        <?php echo $this->render('_sorting', ['itemView' => $itemView]); ?>

        <div id="listview-ajax">
            <?php
            echo $this->render('listview', [
                'itemView' => $itemView,
                'provider' => $provider,
            ]);
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>

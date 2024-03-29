<?php

use yii\helpers\Html;
use panix\mod\shop\widgets\filtersnew2\FiltersWidget;

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">

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
        <div class="col-md-8">
            <div class="heading-gradient">
                <h1><?= Html::encode(($this->h1) ? $this->h1 : $this->context->pageName); ?></h1>
            </div>

            <div class="col">

                <?php echo $this->render('@shop/views/catalog/_sorting', ['itemView' => $this->context->itemView]); ?>
                <div id="listview-ajax">
                    <?php
                    echo $this->render('@shop/views/catalog/listview', [
                        'itemView' => $this->context->itemView,
                        'provider' => $provider,
                    ]);
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

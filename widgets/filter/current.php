<?php

use yii\helpers\Html;
use yii\widgets\Menu;

/**
 * @var $dataModel \panix\mod\shop\models\Category
 * @var $active \panix\mod\shop\controllers\CatalogController Method getActiveFilters()
 * @var $url array Route refresh filters
 */

?>


<div class="filter-attribute-container" id="filter-current">
    <div class="filter-current-title"><?= Yii::t('default','SELECTED'); ?>:</div>
    <?php foreach ($active as $key => $items) { ?>
        <?php if ($items['items']) { ?>

            <div class="mb-2 mt-2">
                <div><strong><?= $items['label']; ?></strong></div>
                <?php foreach ($items['items'] as $item) { ?>

                    <?php
                    echo Html::a('<span>' . $item['label'] . '</span>', $item['url'], array_merge($item['options'], ['class' => 'remove-filter mb-2 remove']));
                    ?>

                <?php } ?>
            </div>
        <?php } ?>
    <?php } ?>

    <div class="mt-3">
        <?= Html::a(Yii::t('shop/default', 'RESET_FILTERS_BTN'), $url, ['class' => 'btn btn-sm btn-success']); ?>
    </div>
</div>

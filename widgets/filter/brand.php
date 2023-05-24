<?php

use yii\helpers\Html;

?>
<?php if ($brands['filters'] && count($brands['filters']) > 1) { ?>


    <div class="layer-navigation ">
        <div class="layer-navigation__head layer-filter ">
            <h5><?= Yii::t('shop/default', 'FILTER_BY_BRAND') ?></h5>
        </div>

        <div class="layer-navigation__accordion">

            <?php if (count($brands['filters']) >= 20 && $this->context->searchItem > 0) { ?>
                <input type="text" name="search-filter"
                       onkeyup="filterSearchInput(this,'filter-brand')" class="form-control mb-3"
                       placeholder="<?= Yii::t('shop/default', 'SEARCH_BY', mb_strtolower(Yii::t('shop/default', 'FILTER_BY_BRAND'))); ?>">
            <?php } ?>

            <div class="layer-navigation__content">
                <ul class="filter-list list-unstyled" id="filter-brand">
                    <?php
                    foreach ($brands['filters'] as $filter) {
                        $url = Yii::$app->urlManager->addUrlParam('/' . Yii::$app->requestedRoute, [$filter['key'] => $filter['id']], $brands['selectMany']);
                        $queryData = explode(',', Yii::$app->request->getQueryParam($filter['key']));
                        // Filter link was selected.

                        $checkBoxOptions = [];
                        $checkBoxOptions['class'] = 'custom-control-input';
                        $checkBoxOptions['value'] = $filter['id'];
                        $checkBoxOptions['id'] = 'filter_' . $filter['key'] . '_' . $filter['id'];
                        $disableClass = '';
                        if (in_array($filter['id'], $queryData)) {
                            // Create link to clear current filter
                            $checked = true;

                            $url = Yii::$app->urlManager->removeUrlParam('/' . Yii::$app->requestedRoute, $filter['key'], $filter['id']);
                            //echo Html::a($filter['title'], $url, array('class' => 'active'));
                        } else {

                            $checked = false;
                            //echo Html::a($filter['title'], $url);
                        }
                        if (!$filter['count']) {
                            $disableClass = 'disabled';
                            $checkBoxOptions['disabled'] = 'disabled';
                        }
                        echo Html::beginTag('li', ['class' => 'mb-2 ' . $disableClass]);


                        echo '<div class="custom-control custom-checkbox">';
                        echo Html::checkBox('filter[' . $filter['key'] . '][]', $checked, $checkBoxOptions);
                        echo Html::label($filter['title'] . (($checked) ? '' : $this->context->getCount($filter)), 'filter_' . $filter['key'] . '_' . $filter['id'], ['class' => 'custom-control-label', 'data-search' => $filter['title']]);


                        // echo $this->context->getCount($filter);
                        echo '</div>';
                        echo Html::endTag('li');
                    }
                    ?>
                </ul>


            </div>
        </div>

    </div>

<?php } ?>

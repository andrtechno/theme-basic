<?php

use yii\helpers\Html;

/**
 * @var $attributes array
 */

foreach ($attributes as $attribute_index => $attrData) {

    if (count($attrData['filters']) > 0) {
        //echo Html::hiddenInput('attributes[]', $attribute_key);
        ?>
        <div id="filter-container-<?= $attrData['key']; ?>">
            <a class="filter-header" data-toggle="collapse" href="#filter-collapse-<?= $attrData['key']; ?>" role="button"
               aria-expanded="true" aria-controls="filter-collapse-<?= $attrData['key']; ?>">
                <?= Html::encode($attrData['title']) ?>
            </a>


            <div class="collapse show" id="filter-collapse-<?= $attrData['key']; ?>">
                <?php if ($attrData['filtersCount'] >= $this->context->searchItem && !in_array($attrData['type'], [\panix\mod\shop\models\Attribute::TYPE_COLOR])) { ?>
                    <input type="text" name="search-filter"
                           onkeyup="filterSearchInput(this,'filter-<?= $attrData['key']; ?>');" class="form-control mb-3"
                           placeholder="<?= Yii::t('shop/default', 'SEARCH_BY', mb_strtolower($attrData['title'])); ?>">
                <?php } ?>
                <div class="overflow">
                    <ul class="filter-list list-unstyled filter-attribute" id="filter-<?= $attrData['key']; ?>">
                        <?php

                        foreach ($attrData['filters'] as $filter) {

                            $queryData = explode(',', Yii::$app->request->getQueryParam($attrData['key']));
                            $checkBoxOptions = [];
                            $checkBoxOptions['value'] = $filter['id'];
                            $checkBoxOptions['id'] = 'filter_' . $attrData['key'] . '_' . $filter['id'];
                            $checkBoxOptions['class'] = 'custom-control-input';
                            if (!$filter['count'] && !in_array($filter['id'], $queryData)) {
                                $checkBoxOptions['disabled'] = 'disabled';
                            }

                            //if ($filter['count'] > 0) { //$filter['count'] > 0
                            //$url = Yii::$app->urlManager->addUrlParam('/' . Yii::$app->requestedRoute, [$attrData['key'] => $filter['id']], $attrData['selectMany']);
                            //} else {
                            //     $url = 'javascript:void(0)';
                            //
                            if ($filter['count'] > 0) {
                                $liOptions = [];
                                $liOptions['class'] = '';
                                $liOptions['id'] = 'li-' . $filter['id'];
                                if (!$filter['count']) {
                                    $liOptions['class'] = 'disabled';
                                }
                                echo Html::beginTag('li', $liOptions);
                                // Filter link was selected.
                                //echo Html::a('test', $url);

                                if (in_array($filter['id'], $queryData)) {
                                    $checked = true;
                                    // Create link to clear current filter
                                    $url = Yii::$app->urlManager->removeUrlParam('/' . Yii::$app->requestedRoute, $attrData['key'], $filter['id']);
                                    //echo Html::a($filter['title'], $url, array('class' => 'active'));
                                } else {
                                    $checked = false;
                                    //echo Html::a($filter['title'], $url);
                                }

                                if ($attrData['type'] == \panix\mod\shop\models\Attribute::TYPE_COLOR) {
                                    $css = '';
                                    //print_r($filter);die;
                                    if (isset($filter['data'])) {
                                        $css = $this->context->generateGradientCss($filter['data']);
                                    }
                                    echo '<div class="filter-color2">';
                                    $checkedHtml = '';//($checked) ? '<span class="filter-color-checked"></span>' : '<span></span>';
                                    //echo Html::label(Html::checkBox('filter[' . $attribute_key . '][]', $checked, ['class' => 'color-checker', 'value' => $filter['id'], 'id' => 'filter_' . $attribute_key . '_' . $filter['id']]) . $checkedHtml, 'filter_' . $attribute_key . '_' . $filter['id'], ['class' => 'filter-color', 'title' => $filter['title'] . ' (' . trim(strip_tags($this->context->getCount($attribute_key, $filter))) . ')', 'style' => $css]);
                                    echo Html::checkBox('filter[' . $attrData['key'] . '][]', $checked, ['value' => $filter['id'], 'id' => 'filter_' . $attrData['key'] . '_' . $filter['id']]);
                                    echo Html::label('', 'filter_' . $attrData['key'] . '_' . $filter['id'], ['title' => $filter['title'] . ' (' . trim(strip_tags($this->context->getCount($attrData['key'], $filter))) . ')', 'style' => $css]);

                                    echo '</div>';
                                } else {
                                    //var_dump($checked);


                                    //if ($attrData['selectMany']) {
                                    echo '<div class="custom-control custom-checkbox">';
                                    echo Html::checkBox('filter[' . $attrData['key'] . '][]', $checked, $checkBoxOptions);
                                    //echo Html::label($filter['title'] . (($checked) ? '' : $this->context->getCount($attribute_key, $filter)), 'filter_' . $attribute_key . '_' . $filter['id'], ['class' => 'custom-control-label', 'data-search' => $filter['title']]);
                                    echo Html::label('<span>' . $filter['title'] . ($this->context->getCount($attrData['key'], $filter)) . '</span>', 'filter_' . $attrData['key'] . '_' . $filter['id'], ['class' => 'custom-control-label', 'data-search' => $filter['title']]);

                                    // echo Html::label(Html::checkBox('filter[' . $attrData['key'] . '][]', $checked, $checkBoxOptions) . $filter['title'] . (($checked) ? '' : $this->context->getCount($filter)), 'filter_' . $attrData['key'] . '_' . $filter['id'], ['class' => '', 'data-search' => $filter['title']]);
                                    echo '</div>';
                                    //} else {
                                    //    echo '<div class="radio">';
                                    //    echo Html::label(Html::radio('filter[' . $attribute_key . ']', $checked, ['class' => '', 'value' => $filter['id'], 'id' => 'filter_' . $attribute_key . '_' . $filter['id']]) . $filter['title'] . (($checked) ? '' : $this->context->getCount($filter)), 'filter_' . $attribute_key . '_' . $filter['id'], ['class' => '', 'data-search' => $filter['title']]);
                                    //    echo '</div>';
                                    //}

                                    // $this->context->count=true;

                                }

                                echo Html::endTag('li');
                            }
                            //  }
                        }
                        ?>


                    </ul>
                </div>
            </div>

        </div>


        <?php
    }
}
?>

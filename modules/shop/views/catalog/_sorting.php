<?php

use yii\helpers\Html;

$this->registerJs("
    $(function () {
        $('.ajax-catalog').click(function (e) {
            filter_ajax($(this).attr('href'));
            return false;
        });
    });
", \yii\web\View::POS_END);
echo Html::beginForm($this->context->currentUrl, 'GET', ['id' => 'sorting-form']);
?>


    <div class="row no-gutters">
        <span class="col-6 col-sm-6 d-md-none">
        <a class="btn btn-outline-secondary d-block btn-filter" href="#"
           onclick="$('#filters-container').toggleClass('open'); return false;"><?= Yii::t('shop/default', 'FILTERS'); ?></a>
        </span>
        <div class="col-6 col-sm-6 col-md-5 col-lg-5 mb-3">
            <?php
            $sorter[NULL] = Yii::t('shop/default', 'SORT');
            $sorter['price'] = Yii::t('shop/default', 'SORT_BY_PRICE_ASC');
            $sorter['-price'] = Yii::t('shop/default', 'SORT_BY_PRICE_DESC');
            $sorter['-date_create'] = Yii::t('shop/default', 'SORT_BY_DATE_DESC');
            //  $active = Yii::$app->urlManager->addUrlParam('/' . Yii::$app->requestedRoute, ['sort' => Yii::$app->request->get('sort')]);

            echo Html::dropDownList('sort', Yii::$app->request->get('sort'), $sorter, ['class' => 'custom-select']);
            ?>


        </div>
        <div class="col-6 col-sm-8 col-md-4 col-lg-4 mb-3">


            <?php
            $limits[NULL] = $this->context->allowedPageLimit[0];
            array_shift($this->context->allowedPageLimit);
            foreach ($this->context->allowedPageLimit as $l) {
                $limits[$l] = $l;
            }
            ?>
            <span class="d-none d-sm-inline-block"><?= Yii::t('shop/default', 'OUTPUT_ON'); ?> </span>
            <?= Html::dropDownList('per-page', Yii::$app->request->get('per-page'), $limits, ['class' => 'custom-select', 'style' => 'width:auto;'/*,'prompt'=>$this->context->allowedPageLimit[0]*/]); ?>
            <span><?= Yii::t('shop/default', 'товаров'); ?></span>

        </div>


        <div class="col-6 col-sm-4 col-md-3 col-lg-3 mb-3 text-right">

            <div class="btn-group btn-group-sm">
                <?php
                echo Html::submitButton('<i class="icon-grid"></i>', ['class' => 'btn btn-outline-secondary', 'name' => 'view', 'value' => NULL]);
                echo Html::submitButton('<i class="icon-menu"></i>', ['class' => 'btn btn-outline-secondary', 'name' => 'view', 'value' => 'list']);
                ?>

            </div>
        </div>
    </div>

<?php
echo Html::endForm();
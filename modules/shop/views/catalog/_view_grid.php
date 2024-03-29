<?php

use panix\engine\Html;

$mainImage = $model->getMainImage('340x265');
?>

<div class="product1">
    <div class="product-label-container">
        <?php
        foreach ($model->labels() as $label) {
            echo '<div>';
            echo Html::tag('span', $label['value'], [
                'class' => 'product-label-tag badge badge-' . $label['class'],
                'data-toggle' => 'tooltip',
                // 'title' => $label['tooltip']
            ]);
            echo '</div>';
        }
        ?>
    </div>


    <div class="product-image d-flex justify-content-center align-items-center">
        <?php
        echo Html::a(Html::img($mainImage->url, ['alt' => $model->name, 'class' => 'img-fluid loading']), $model->getUrl(), ['data-pjax'=>0]);
        //echo Html::link(Html::image(Yii::app()->createUrl('/site/attachment',array('id'=>33)), $data->name, array('class' => 'img-fluid')), $data->getUrl(), array());
        ?>
    </div>
    <div class="product-info">
        <?= Html::a(Html::encode($model->name), $model->getUrl(), ['class' => 'product-title','data-pjax'=>0]) ?>
    </div>
    <div class="">

        <?php
       // echo $model->beginCartForm();
        ?>


        <div class="product-data">
            <div class="row no-gutters">
                <div class="col-6 col-sm-6 col-lg-6 d-flex align-items-center">

                    <br/>
                    <span class="product-review">
                <a href="<?= \yii\helpers\Url::to($model->getUrl()) ?>#comments_tab">(<?= Yii::t('app/default', 'REVIEWS', ['n' => $model->reviewsCount]); ?>
                    )</a>
            </span>
                </div>
                <div class="col-6 col-sm-6 col-lg-6 text-right">
                    <?php
                    if (Yii::$app->hasModule('compare')) {
                        echo \panix\mod\compare\widgets\CompareWidget::widget([
                            'model' => $model,
                            'skin' => 'icon',
                            'linkOptions' => ['class' => 'btn btn-compare']
                        ]);
                    }
                    if (Yii::$app->hasModule('wishlist') && !Yii::$app->user->isGuest) {
                        echo \panix\mod\wishlist\widgets\WishListWidget::widget([
                            'model' => $model,
                            'linkOptions' => ['class' => 'btn btn-wishlist']
                        ]);
                    }
                    ?>
                </div>
            </div>
            <div class="row no-gutters mt-2">
                <div class="col-6 col-sm-6 col-lg-7 d-flex align-items-center">
                    <div class="product-price">

                        <?php
                        if (Yii::$app->hasModule('discounts')) {
                            if ($model->hasDiscount) {
                                ?>
                                <span class="price price-discount">
                                <span><?= Yii::$app->currency->number_format(Yii::$app->currency->convert($model->originalPrice)) ?></span>
                                <sub><?= Yii::$app->currency->active['symbol'] ?></sub>
                            </span>
                                <span class="discount-sum">-<?= $model->discountSum; ?></span>
                                <?php
                            }
                        }
                        ?>
                        <div>
                            <span class="price"><span><?= $model->priceRange() ?></span> <sub><?= Yii::$app->currency->active['symbol'] ?></sub></span>
                        </div>


                    </div>
                </div>
                <div class="col-6 col-sm-6 col-lg-5 text-right">
                    <?php
                    if ($model->isAvailable) {
                        echo Html::button(Yii::t('cart/default', 'BUY'), ['onclick'=>'javascript:cart.add(this)', 'class' => 'btn btn-warning btn-buy']);
                    } else {
                        \panix\mod\shop\bundles\NotifyAsset::register($this);
                        echo Html::button(Yii::t('shop/default', 'NOT_AVAILABLE'), ['onclick'=>'javascript:notify(' . $model->id . ');', 'class' => 'text-danger']);
                    }
                    ?>
                </div>
            </div>

        </div>



        <?php //echo $model->endCartForm(); ?>
    </div>
</div>


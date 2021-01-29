<?php
use panix\ext\owlcarousel\OwlCarouselWidget;
use panix\engine\Html;

OwlCarouselWidget::begin([
    'containerOptions' => ['class' => 'owl-banner'],
    'options' => [
        'nav' => true,
        'items' => 1,
        'margin' => 20,
        'navText' => ['', ''],
        'responsiveClass' => true,
        'responsive' => [
            0 => [
                'nav' => false,
                'dots' => true,
                'center' => true,
            ],
            426 => [
                'nav' => false
            ],
            768 => [
                'nav' => false
            ],
            1024 => [
                'nav' => true,
                'dots' => false
            ]
        ]
    ]
]); ?>



<?php OwlCarouselWidget::end(); ?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <p class="lead">Вы успешно создали свое применение.</p>
    </div>
</div>
